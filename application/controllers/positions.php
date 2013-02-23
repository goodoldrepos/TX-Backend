<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Positions extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('position_model');
	}
	
	public function update($id = NULL, $lat = NULL, $long = NULL){

		if($id != NULL && $lat != NULL && $long != NULL){
			$this->position_model->update_position($id, $lat, $long);
		}else{
			echo "format: id lat long";
		}
		
	}


}