<?php  

class Position_model extends CI_Model {
	
	public function update_position($id, $lat, $long){
		$data = array(
			'latitude' 	=> $lat, 
			'longitude' 	=> $long,
			'id_chaffeur' 	=> $id
		);

		$this->db->insert('positions', $data);
	}


}