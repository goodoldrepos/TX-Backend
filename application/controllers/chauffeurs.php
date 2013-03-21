<?php 

class Chauffeurs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('chauffeur_model');
	}
	

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		/*$this->form_validation->set_rules('adresse', 'Adresse', 'required');
		$this->form_validation->set_rules('code_postale', 'Code Postale', 'required');
      	$this->form_validation->set_rules('destination', 'Destination', 'required');*/

      	if ( $this->form_validation->run() !== false ) {

			//stocker les informations du formulaire dans la session
			$this->session->set_userdata('role', "chauffeur");

			//insert
			$id = $this->chauffeur_model->create_chauffeur();

			$this->session->set_userdata('user_id', $id);

			redirect('chauffeurs/home');


      	}else{
      		$this->load->view('templates/header');
      		$this->load->view('pages/chauffeurs');
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