<?php 

class Sessions extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function create(){
		$this->load->library('form_validation');
      	$this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required');
      	$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');

      if ( $this->form_validation->run() !== false ) {
         // then validation passed. Get from db
         $res = $this
                  ->user_model
                  ->sign_in(
                     $this->input->post('email'), 
                     $this->input->post('motdepasse')
                  );

         if ( $res !== false ) {
            $this->session->set_userdata('user_id', $res->id);
            redirect('pages/home');
         }

      }
      
      $this->load->view('templates/header');
      $this->load->view('sessions/create');
      $this->load->view('templates/footer');
	}


	public function destroy(){
		$this->session->unset_userdata('user_id');
		redirect('pages/home');
	}


}