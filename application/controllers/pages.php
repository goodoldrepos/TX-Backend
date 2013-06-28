<?php 

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('reservation_model');
		$this->load->model('position_model');
		$this->load->model('chauffeur_model');

	}
	

	public function home(){

		$this->load->view("templates/header");

		//si l'utilisateur est connecté
		if($this->session->userdata('user_id')){
			//si l'utilisateur a remplie le formulaire sur la page d'accueil
			if($this->session->userdata('reservation')){
				$data = $this->session->userdata('reservation');
				$this->load->view("reservations/valider_reservation", $data);
			}
			elseif($this->session->userdata('role') == 'client'){
				$this->load->view("pages/home_in"); 	
			}elseif($this->session->userdata('role') == 'chauffeur'){
                $this->load->view("chauffeurs/home");
            }

		//sinon
		}else{
			$this->load->view("pages/home");
		}

		
		$this->load->view("templates/footer");
	}


	public function fetchClient(){

		$id = $this->session->userdata('user_id');
    	$coord = $this->reservation_model->get_position_depart($id);
    	
    	if($coord != NULL){
    		$lat = $coord->latitude;
			$long = $coord->longitude;
    	}else if($this->session->userdata('reservation')){
    		$r = $this->session->userdata('reservation');
    		$this->load->helper('maps_helper');
			$coord = lookup($r['depart'] . " ,France"); 
			$lat = $coord['latitude'];
			$long = $coord['longitude'];
    	}else{
    		//default values when here is location for user
    		$lat = -10;
    		$long = -10;
    	}
		

		echo $lat . " " . $long;
	}

	public function fetchChauffeurs(){

		$id = $this->session->userdata('user_id');
    	$coord = $this->reservation_model->get_position_depart($id);
    	
    	if($coord != NULL){
    		$lat = $coord->latitude;
			$long = $coord->longitude;
			$c = $this->position_model->nearestPositions($lat, $long, 200);
		}else{
			$c = $this->position_model->allPositions();
		}

		if($c != NULL){
			echo json_encode($c->result_array());
		}else{
			echo json_encode("Nothing");	
		}


		
	}

	public function chauffeurs(){
		$this->load->view('templates/header');
		$this->load->view('pages/chauffeurs');
		$this->load->view('templates/footer');
	}

	public function admin(){
		if($this->session->userdata('user_id') && is_admin($this->session->userdata('user_id'))){
			$this->load->model('user_model');
			$users= $this->user_model->get_all();
			$reservations = $this->reservation_model->get_all();
			$chauffeurs = $this->chauffeur_model->get_all();
			$data = array( 'users' => $users, 'reservations' => $reservations, 'chauffeurs' => $chauffeurs);

			$this->load->view('templates/header');
			$this->load->view('pages/admin', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('sessions/create');
		}
		
	}

	public function test(){
		$c = $this->position_model->nearestPositions(48.8564026,2.2770679,4);
		if($c != NULL){
			echo json_encode($c->result_array());
		}
	}

}