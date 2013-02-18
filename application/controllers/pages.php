<?php 

class Pages extends CI_Controller{
	

	public function home(){
		$this->load->view("templates/header");
		if($this->session->userdata('username')){
			$this->load->view("pages/maps");
		}else{
			$this->load->view("pages/home");
		}
		$this->load->view("templates/footer");
	}

	public function maps(){
		$this->load->view('templates/header');
		$this->load->view('pages/maps');
		$this->load->view('templates/footer');
	}

	public function fetch(){
		/*$myFile = "records.txt";
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
		list($lat,$long) = explode(" ",$theData);*/

		$lat = 33.5380426;
    	$long = -7.6044972;

		echo $lat . " " . $long;
	}

}