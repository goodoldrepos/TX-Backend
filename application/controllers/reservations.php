<?php  

class Reservations extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('reservation_model');
	}
	
	public function immediate(){

		//recuperer champs formulaire
		$data = array(
				'ville' 		=> $this->input->post('ville'),
				'rue' 			=> $this->input->post('rue'),
				'cp' 			=> $this->input->post('code_postale'),
				'destination' 	=> $this->input->post('destination'),
				'passagers' 	=> $this->input->post('nombre_passagers'),
				'bagages' 		=> $this->input->post('nombre_bagages')
		);

		//stocker les informations du formulaire dans la session
		$this->session->set_userdata('reservation', $data);


		//si utilisateur connecté, afficher homepage sinon page incription. 
		if($this->session->userdata('user_id')){
			redirect('pages/home');
		}else{
			redirect('users/create');
		}
	}

	public function process_immediate(){
		//creer une reservation dans la table
		$this->reservation_model->create_reservation();
		
		//supprimer la reservation de la session
		$this->session->unset_userdata('reservation');

		//redireger vers page d'accueil
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

	public function destroy(){
		
	}

	public function listAll(){
		
	}

	

}