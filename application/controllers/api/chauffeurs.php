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
  
        if($r = $this->position_model->update_position($this->post('id'), $this->post('latitude'), $this->post('longitude'))){
            $this->response(array('status' => 'done', 'reservation' => $r, 'action' => 'updatePosition'), 200);
        }else{
            $this->response(array('status' => 'error', 'reservation' => 'empty', 'action' => 'updatePosition'), 200);
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


    
    

}