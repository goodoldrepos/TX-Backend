<?php  

class position_model extends CI_Model {
	
	public function update_position($id, $lat, $long){
		$data = array(
			'latitude' 		=> $lat, 
			'longitude' 	=> $long,
			'id_chauffeur' 	=> $id
		);


		$q = $this->db->where('id_chauffeur', $id)->get('positions');

		if($q->num_rows > 0){
			$this->db->where('id_chauffeur', $id);
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
		if($q->num_rows > 0) return $q;
		else return NULL;	
	}

	public function nearestPositions($latitude, $longitude, $distance){

		$query = "SELECT *,(((acos(sin((" . $latitude . "*pi()/180)) * sin((`latitude`*pi()/180))+cos((" . $latitude. "*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((" . $longitude . "- `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) AS distance FROM `positions` Having distance <= " . $distance . " order by distance" ;

		

		$q = $this->db->query($query);	
		
		if($q->num_rows > 0) return $q;
		else return NULL;
	}


}