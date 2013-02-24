<?php  

class Users extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required');
      	$this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required');
      	$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');

      	if ( $this->form_validation->run() !== false ) {
         // then validation passed. Get from db
         	$id = $this
                  ->user_model
                  ->create_user();

         
         	$this->session->set_userdata('user_id', $id);
            redirect('pages/home');
       
      	}	

      	$this->load->view('templates/header');
      	$this->load->view('users/create');
      	$this->load->view('templates/footer');

	}

	public function update(){
		
	}

	public function view(){
		
	}


}