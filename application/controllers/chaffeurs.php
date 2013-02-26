<?php 

class Chaffeurs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('chaffeur_model');
	}
	

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		/*$this->form_validation->set_rules('adresse', 'Adresse', 'required');
		$this->form_validation->set_rules('code_postale', 'Code Postale', 'required');
      	$this->form_validation->set_rules('destination', 'Destination', 'required');*/

      	if ( $this->form_validation->run() !== false ) {

			//stocker les informations du formulaire dans la session
			$this->session->set_userdata('role', "chaffeur");

			//insert
			$id = $this->chaffeur_model->create_chaffeur();

			$this->session->set_userdata('user_id', $id);

			redirect('chaffeurs/home');


      	}else{
      		$this->load->view('templates/header');
      		$this->load->view('pages/chaffeurs');
      		$this->load->view('templates/footer');
      	}
		
	}

	public function view(){
		
	}

	public function update(){
		
	}

	public function destroy(){
		
	}

	public function listAll(){
		
	}





}