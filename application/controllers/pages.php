<?php 

class Pages extends CI_Controller{
	

	public function home(){

		$this->load->view("templates/header");

		//si l'utilisateur est connecté
		if($this->session->userdata('user_id')){

			//si l'utilisateur a remplie le formulaire sur la page d'accueil
			if($this->session->userdata('reservation')){

				$data = $this->session->userdata('reservation');
				$this->load->view("reservations/valider_reservation", $data);

			}
			//sinon
			else{
				$this->load->view("pages/home_in"); 	
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
	public function fetch(){
		/*$myFile = "records.txt";
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
		list($lat,$long) = explode(" ",$theData);*/


    	$this->load->helper('maps_helper');
    	$r = $this->session->userdata('reservation');
    	$place = lookup($r['rue'] . ", " . $r['ville'] . " ,France");

    	//$lat = 33.5380426;
    	//$long = -7.6044972;
    	
		$lat = $place['latitude'];
		$long = $place['longitude'];

		echo $long . " " . $lat;
	}

}