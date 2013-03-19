<?php  

class Position_model extends CI_Model {
	
	public function update_position($id, $lat, $long){
		$data = array(
			'latitude' 		=> $lat, 
			'longitude' 	=> $long,
			'id_chaffeur' 	=> $id
		);


		$q = $this->db->where('id_chaffeur', $id)->get('positions');
		if($q->num_rows > 0){
			$this->db->update('positions', $data); 
		}else{
			$this->db->insert('positions', $data); 
		}

		$this->db->select('reservations.id, 
						reservations.destination, 
						reservations.date, 
						reservations.status,
						adresses_depart.latitude,
						adresses_depart.longitude, 
						adresses_depart.adresse');
		$this->db->from('reservations');
		$this->db->where('status', 'pending');
		$this->db->order_by('date', 'asc');
		$this->db->join('adresses_depart', 'adresses_depart.id = reservations.id_depart');

		$r = $this->db->get();

		if ( $r->num_rows > 0 ) return $r->result_array();
    	else return false;

	}

	public function allPositions(){
		$q = $this->db->get('positions');
		return $q;
	}


}