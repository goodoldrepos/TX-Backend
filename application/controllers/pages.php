<?php 

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('reservation_model');
		$this->load->model('position_model');
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


	//show a map
	public function maps(){
		$this->load->view('templates/header');
		$this->load->view('pages/maps');
		$this->load->view('templates/footer');
	}


	//fetch data from a file and return it.
	public function fetchClient(){

    	$coord = $this->reservation_model->get_position_depart();
    	
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
    		//default values (Tour Eiffel)
    		$lat = 48.85902;
    		$long = 2.29332;
    	}
		

		echo $lat . " " . $long;
	}

	public function fetchChauffeurs(){
		$c = $this->position_model->allPositions();
		$str = " ";

		foreach ($c->result_array() as $row)
		{
    		$str .= $row['latitude'] . " ";
		}

		echo json_encode($c->result_array());
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
			//$chauffeurs = $this->chauffeur_model->get_all();
			$data = array( 'users' => $users, 'reservations' => $reservations);

			$this->load->view('templates/header');
			$this->load->view('pages/admin', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('sessions/create');
		}
		
	}

}