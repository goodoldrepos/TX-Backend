<?php 

class reservation_model extends CI_Model{
	

	public function create_reservation(){
		$r = $this->session->userdata('reservation');
		$this->load->helper('maps_helper');
		$coord = lookup($r['rue'] . ", " . $r['ville'] . " ,France"); 

		$a_depart = array(
				'ville' 		=> $r['ville'],
				'rue' 			=> $r['rue'],
				'code_postale' 	=> $r['cp'],
				'latitude'		=> $coord['latitude'],
				'longitude'		=> $coord['longitude']
		);

		   	

		$this->db->insert('adresses_depart', $a_depart);
		$id_depart = $this->db->insert_id();

		$new_reservation = array(
			'id_utilisateur'	=> $this->session->userdata('user_id'),
			'id_depart'  		=> $id_depart, 
			'destination'		=> $r['destination'],
			'statut'			=> 'disponible'	
		);

		$this->db->insert('reservations',$new_reservation);
	}

	public function en_cours($id){

		$q = $this->db->where('id_utilisateur',$id)->where('statut','disponible')->limit(1)->get('reservations');
		if ( $q->num_rows > 0 ) return true;
    	else return false;
	}

	public function get_position_depart(){
		$id = $this->session->userdata('user_id');
		$reservation = $this->db->where('id_utilisateur', $id)->limit(1)->get('reservations'); 

		if($reservation->num_rows > 0){
			$res = $reservation->row();
			$id_depart = $res->id_depart;
			$q = $this->db->where('id', $id_depart)->limit(1)->get('adresses_depart');

			if( $q->num_rows > 0 ) {
         		return $q->row();
      		}else{ 
	      		return NULL; 
	      	}

		}else{
			return NULL;
		}
			
	}

	public function get_all(){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->join('utilisateurs', 'utilisateurs.id = reservations.id_utilisateur');
		$this->db->join('adresses_depart', 'adresses_depart.id = reservations.id_depart');

		$q = $this->db->get();

		if($q->num_rows > 0 ){
			return $q->result();	
		}else{
			return null;
		}
	}


}