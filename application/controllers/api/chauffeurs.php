<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class chauffeurs extends REST_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('chauffeur_model');
        $this->load->model('user_model');
        $this->load->model('position_model');
        $this->load->model('reservation_model');
    }

    //verifies if the login/password are correct
    function connecter_post(){


        if($this->chauffeur_model->sign_in($this->post('email'), $this->post('pwd'))){
            $r = $this->chauffeur_model->sign_in( $this->post('email'), $this->post('pwd') );
            //send response
            $this->response(array('status' => 'done', 'user_id' => $r->id, 'profil' => $r), 200);

        }else{
            //send response
            $this->response(array('status' => 'Error Auth', 'email' => $this->post('email'), 'pwd' => $this->post('pwd')), 200);
        }
   
    }



    //receive new position from driver and update db
    function position_post(){
  
        if($this->position_model->update_position($this->post('id'), $this->post('latitude'), $this->post('longitude')) != NULL){
            $r = $this->position_model->update_position($this->post('id'), $this->post('latitude'), $this->post('longitude'));
            $this->response(array('status' => 'done', 'reservation' => $r, 'action' => 'updatePosition'), 200);
        }else{
            $this->response(array('status' => 'error', 'reservation' => 'empty', 'action' => 'updatePosition', 'id' => $this->post('id'), 'latitude' => $this->post('latitude'), 'longitude' => $this->post('longitude')), 200);
        }
    
    }


    //receive accept request from driver and check if that's ok
    function acceptReservation_post(){

        if($this->reservation_model->validate_reservation($this->post('idReservation'), $this->post('idChauffeur'))){

            $this->response(array('status' => 'accepted','id' => $this->post('idReservation'), 'action' => 'confirmationReservation'), 200);

        }else{
            $this->response(array('status' => 'notAccepted', 'id' => $this->post('idReservation'), 'action' => 'confirmationReservation'), 200);
        }


    }

    //ask to cancel reservation 
    function cancelReservation_post(){
        if($this->reservation_model->delete($this->post('idReservation'), 'accepted' ))
        {
            $this->response(array('status' => 'done','id' => $this->post('idReservation'), 'action' => 'cancelReservation'), 200);
        }
        else
        {
            $this->response(array('status' => 'error','id' => $this->post('idReservation'), 'action' => 'cancelReservation'), 200);
        }
    }

    function users_get()
    {
        $users = $this->user_model->get_all();
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('status' => 'Couldn\'t find any users!'), 404);
        }
    }

    function rappel_post(){

        if( $this->reservation_model->rappel($this->post("idReservation")) ){
            $this->response(array('status' => 'done','action' => 'rappel', 'id' => $this->post('idReservation')), 200);
        }else{
            $this->response(array('status' => 'none','action' => 'rappel', 'id' => $this->post('idReservation')), 200);
        }

    }

    function terminer_post(){

        if( $this->reservation_model->terminer($this->post("idReservation")) ){
            $this->response(array('status' => 'done','action' => 'terminer', 'id' => $this->post('idReservation')), 200);
        }else{
            $this->response(array('status' => 'none','action' => 'terminer', 'id' => $this->post('idReservation')), 200);
        }

    }


    function ios_get(){
        $apn = "28b8d54cac775b507d8a51c46424b1c12361cd153dfed4442821d3e50a92ca77";
        $this->load->library('apn');
        $this->apn->payloadMethod = 'enhance'; // you can turn on this method for debugging purpose
        $this->apn->connectToPush();
        $message = "Testing Push Notification !" ;
        $send_result = $this->apn->sendMessage($apn, $message, /*badge*/ 1, /*sound*/ 'default'  );
        $this->apn->disconnectPush();
        $this->response(array('status' => 'Up and Running', 'result' => $send_result), 200);

    }

	function android_get(){
		$this->load->library('gcm');
        $this->gcm->setMessage('Test 1 2 3');
        $this->gcm->addRecepient($this->get("apn"));
        /*$this->gcm->setData(array(
            'some_key' => 'some_val'
        ));*/
							
        if ($this->gcm->send())
            echo 'Success for all messages';
        else
            echo 'Some messages have errors';

    // and see responses for more info
        print_r($this->gcm->status);
		print_r($this->gcm->messagesStatuses);
	}


    
    

}