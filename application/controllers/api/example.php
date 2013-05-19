<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('position_model');
        $this->load->model('reservation_model');
    }

    //verifies if the login/password are correct
    function login_post(){

        if(!$this->post('email') || !$this->post('pwd'))
        {
            $this->response(array('status' => 'Erreur Format'), 200);
        }

        if($this->user_model->sign_in($this->post('email'), $this->post('pwd'))){
            
            $r = $this->user_model->sign_in( $this->post('email'), $this->post('pwd') );
            $this->user_model->add_apn($r->id, $this->post('apn'));
            $this->user_model->device_type($r->id, $this->post('devicetype'));

            //send response
            $this->response(array('status' => 'done', 'user_id' => $r->id, 'profil' => $r, 'apn' => $this->post('apn'), 'device_type'=> $this->post('devicetype')), 200);

        }else{
            //send response
            $this->response(array('status' => 'Error Auth'), 200);
        }
       
    }

    //sign out
    function logout_post(){
        $this->user_model->remove_apn($this->post('id'));
        $this->response(array('status' => 'done', 'action' => 'removeAPNToken'), 200);
    }


    function apnToken_post(){
        $this->response(array('status' => 'done', 'action' => 'addAPNToken'), 200);
    }

    //fetch les positions des taxis
    function chauffeurs_get(){
        $c = $this->position_model->allPositions();
        if($c != NULL){
            $this->response(array('action' => 'getChauffeurs', 'chauffeurs' => $c->result_array(), 'status' => 'done' ) ,200);  
        }else{
            $this->response(array('action' => 'getChauffeurs', 'chauffeurs' => NULL, 'status' => 'error' ) ,200);  
        }
    }
    
    //create a new user and return it's id. (for now ... a token later)
    function user_post()
    {   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('prenom', 'Prenom', 'required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required');
        $this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required|is_unique[utilisateurs.email]');
        $this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');

        if ($this->form_validation->run()) {
            $message = $this->user_model->create_user( $this->post('nom'),
                                                    $this->post('prenom'), 
                                                    $this->post('telephone'),
                                                    $this->post('email'),
                                                    $this->post('motdepasse')
                                                    );
        
            $this->response(array('status' => "done"), 200); // 200 being the HTTP response code
        }else{
            $this->response(array('status' => "error"), 200);
        }

        
    }

    //get any current reservation (if there is one)
    function reservation_get(){

        $r = $this->reservation_model->get_current_reservation($this->get('id'));

        if($r){
            $this->response(array('action' => 'getReservation', 'reservation' => $r, 'status' => 'done'), 200);
        }else{
            $this->response(array('action' => 'getReservation', 'status' => 'none'), 200);

        }

    }

    //user can cancel reservation
    function cancelReservation_get(){
        $this->reservation_model->delete($this->get('id'));
        $this->response(array('action' => 'cancelReservation', 'status' => 'done'), 200);
    }

    //create reservation
    function reservation_post()
    {  
        $this->load->library('form_validation');
        $this->form_validation->set_rules('depart', 'Depart', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');

        if ( $this->form_validation->run() !== false ) {
            $r = $this->reservation_model->create_reservation($this->post('depart'), 
                                                            $this->post('destination'), 
                                                            $this->post('id'));
            $depart = array( 'latitude' => $r['latitude'], 'longitude' => $r['longitude'] );                                              
            $this->response(array('action' => 'createReservation', 'status' => 'done', 'depart' => $depart), 200);
        }else{
            $this->response(array('action' => 'createReservation', 'status' => "error"), 200);
        }
        
    }
    
    function test_get()
    {
        $this->response("Up", 200); 
    }

}