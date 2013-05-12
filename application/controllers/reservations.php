<?php  

class Reservations extends CI_Controller{ 

	public function __construct(){
		parent::__construct();
		$this->load->model('reservation_model');
	}
	
	public function immediate(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('depart', 'Départ', 'required');
      	$this->form_validation->set_rules('destination', 'Destination', 'required');

      	if ( $this->form_validation->run() !== false ) {

      		//recuperer champs formulaire
			$data = array(
				'depart' 		=> $this->input->post('depart'),
				'destination' 	=> $this->input->post('destination'),
				'ville'			=> "Paris",
				'passagers' 	=> $this->input->post('nombre_passagers'),
				'bagages' 		=> $this->input->post('nombre_bagages')
			);

			//stocker les informations saisi dans la session pour les re-utiliser plus tard
			$this->session->set_userdata('reservation', $data);


			//verifier si l'utilisteur est connecte ou pas
			if($this->session->userdata('user_id')){
				redirect('pages/home');
			}else{
				//afficher la page d'inscription
				redirect('users/create');
			}

      	}else{
      		$this->load->view('templates/header');
      		$this->load->view('pages/home');
      		$this->load->view('templates/footer');
      	}
		
	}

	public function process_immediate(){

		$r = $this->session->userdata('reservation');

		//creer une reservation dans la table
		$this->reservation_model->create_reservation($r['depart'], $r['destination'], $this->session->userdata('user_id'));
		
		//supprimer la reservation de la session
		$this->session->unset_userdata('reservation');


		/*$this->load->library('email');

		$this->email->from('taxi@braksa.com', 'Taxi Parisien');
		$this->email->to('qmathematical@gmail.com'); 
		$this->email->cc('zakaria@braksa.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		$this->email->send();*/

		//rediriger vers page d'accueil
		redirect('pages/home');
	}

	public function annuler(){
		$this->session->unset_userdata('reservation');
		redirect('pages/home');
	}

	public function view(){
		
	}

	public function update(){
		
	}

	public function destroy($id){
		$this->reservation_model->delete($id);
		redirect('pages/admin');
	}

	public function listAll(){
		
	}

	

}