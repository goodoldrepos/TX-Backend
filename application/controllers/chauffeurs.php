<?php 

class Chauffeurs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('chauffeur_model');
	}
	

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		//$this->form_validation->set_rules('adresse', 'Adresse', 'required');

      	if ( $this->form_validation->run() !== false ) {

			//stocker les informations du formulaire dans la session
			$this->session->set_userdata('role', "chauffeur");

			$data = array(
				'email' 		=>	  $this->input->post('email'), 
                'motdepasse' 	=>    sha1($this->input->post('motdepasse')),
                'nom' 			=>    $this->input->post('nom'),
                'prenom' 		=>    $this->input->post('prenom'),
                'telephone' 	=>    $this->input->post('telephone'),
			);

			//créer nouveau profil chauffeur
			$id = $this->chauffeur_model->create_chauffeur($data);

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

	public function signup(){
		$this->load->view('templates/header');
      	$this->load->view('chauffeurs/create');
      	$this->load->view('templates/footer');	
	}

	public function update(){
		
	}

	public function destroy(){
		
	}

	public function listAll(){
		
	}





}