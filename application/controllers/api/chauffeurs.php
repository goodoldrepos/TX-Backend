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

    //Permet d'athentifier un chauffeur 
	//@return "notAllowed", s'il existe deja un chauffeur qui est connected avec la même licence
	//@return "pending", si le compte n'as pas etait valider par un admin
	//@return "ignored", si un admin a deja verifier le compte et a decider de le rejeter
	//@return "error", si email ou/et mot de passe ne sont pas correctes 
    function connecter_post(){


        if( $this->chauffeur_model->is_not_allowed($this->post('email')) ){
			$this->response(array('status' => 'notAllowed', 'message' => "Il se peut qu'il y a un autre chauffeur qui est connecté avec la même licence que vous."), 200);  
		
		}elseif( $this->chauffeur_model->sign_in($this->post('email'), $this->post('pwd')) ){
			
			//recuperer taxi driver infos
            $r = $this->chauffeur_model->sign_in( $this->post('email'), $this->post('pwd') );
            $this->chauffeur_model->set_online($r->id);

            //make few tests and send response 
			if($r->valide == "pending"){
				$this->response(array('status' => 'pending', 'user_id' => $r->id, 'message' => "Votre compte n'as pas ete active encore"), 200);
			}elseif($r->valide == "ignored"){
				$this->response(array('status' => 'ignored', 'user_id' => $r->id, 'message' => "Votre demande n'etait pas accepter par nos administrateurs"), 200);  
			}else{
				$this->response(array('status' => 'done', 'user_id' => $r->id, 'profil' => $r), 200);  
			}

        }else{
            //send response
            $this->response(array('status' => 'error', 'email' => $this->post('email'), 'pwd' => $this->post('pwd')), 200);
        }
   
    }

	//Assures la deconnexion d'un chauffeur pour qu'il laisse place aux autres chauffeurs qui veulent utiliser le systeme avec la meme licence
	function deconnecter_get(){
		$this->chauffeur_model->set_offline($this->get('idChauffeur'));
		$this->response(array('status' => 'done','id' => $this->get('idChauffeur'), 'action' => 'disconnectChauffeur'), 200);
	}

    //Receive new position from driver and update db
    function position_post(){
  
        if($this->position_model->update_position($this->post('id'), $this->post('latitude'), $this->post('longitude')) != NULL){
            $r = $this->position_model->update_position($this->post('id'), $this->post('latitude'), $this->post('longitude'));
            $this->response(array('status' => 'done', 'reservation' => $r, 'action' => 'updatePosition'), 200);
        }else{
            $this->response(array('status' => 'error', 'reservation' => 'empty', 'action' => 'updatePosition', 'id' => $this->post('id'), 'latitude' => $this->post('latitude'), 'longitude' => $this->post('longitude')), 200);
        }
    
    }


    //Receive accept request from driver and check if that's ok
    function acceptReservation_post(){

        if($this->reservation_model->validate_reservation($this->post('idReservation'), $this->post('idChauffeur'))){

            $this->response(array('status' => 'accepted','id' => $this->post('idReservation'), 'action' => 'confirmationReservation'), 200);

        }else{
            $this->response(array('status' => 'notAccepted', 'id' => $this->post('idReservation'), 'action' => 'confirmationReservation'), 200);
        }


    }

    //Le chauffeur can't make it ! so he gonna let someone else take care of that reservation 
    function cancelReservation_post(){
        if($this->reservation_model->delete($this->post('idReservation'), 'pending' ))
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

	//rappeler client que vous êtes là
    function rappel_post(){

        if( $this->reservation_model->rappel($this->post("idReservation")) ){
            $this->response(array('status' => 'done','action' => 'rappel', 'id' => $this->post('idReservation')), 200);
        }else{
            $this->response(array('status' => 'none','action' => 'rappel', 'id' => $this->post('idReservation')), 200);
        }

    }

	//reservation terminée
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
        $this->apn->payloadMethod = 'enhance'; 
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
	
	//Juste pour tester qu'il n'y a pas d'erreur de syntaxe qlq part dans ce web service
	function test_get(){
		echo "Test Test 1 2 3 " . $this->get("name");
	}


    
    

}