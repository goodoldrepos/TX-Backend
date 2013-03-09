<?php 

class reservation_model extends CI_Model{
	


	//create new reservation
	public function create_reservation($depart, $destination, $id){
		
		
		$this->load->helper('maps_helper');
		$coord = lookup($depart  . " ,France"); 

		$a_depart = array(
				'adresse' 		=> $depart,
				'code_postale' 	=> $depart,
				'latitude'		=> $coord['latitude'],
				'longitude'		=> $coord['longitude']
		);   	

		$this->db->insert('adresses_depart', $a_depart);
		$id_depart = $this->db->insert_id();

		$new_reservation = array(
			'id'				=> $id_depart,
			'id_utilisateur'	=> $id,
			'id_depart'  		=> $id_depart, 
			'destination'		=> $destination,
			'status'			=> 'pending'	
		);

		$this->db->insert('reservations', $new_reservation);

		return array('latitude' => $coord['latitude'], 'longitude' => $coord['longitude']);
	}

	public function get_current_reservation($id){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->where('id_utilisateur', $id);
		$this->db->where('status !=', 'done');
		$this->db->join('adresses_depart', 'adresses_depart.id = reservations.id_depart');

		$q = $this->db->get();

		if ( $q->num_rows > 0 ) return $q->row();
    	else return false;
	}

	// Check is if there is a reservation currently, return true or false. 
	public function en_cours($id){

		$q = $this->db->where('id_utilisateur',$id)->where('status','pending')->limit(1)->get('reservations');
		if ( $q->num_rows > 0 ) return true;
    	else return false;
	}



	//get position de depart for a given user_id
	public function get_position_depart(){
		$id = $this->session->userdata('user_id');
		$reservation = $this->db
							->where('id_utilisateur', $id)
							->where('status', 'pending')
							->limit(1)
							->get('reservations'); 

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

	//cancel a reservation (not actually delete it yet)
	public function delete($id){
		$data = array( 'status' => 'done' );
		$this->db->where('id', $id);
		$this->db->update('reservations', $data);
	}

	//get all reservations (active + archive)
	public function get_all(){
		$this->db->select('	reservations.id, 
							reservations.destination, 
							adresses_depart.adresse, 
							utilisateurs.nom,
							utilisateurs.prenom,
							reservations.status
						');
		$this->db->from('reservations');
		$this->db->join('utilisateurs', 'utilisateurs.id = reservations.id_utilisateur');
		$this->db->join('adresses_depart', 'adresses_depart.id = reservations.id_depart');

	 	$q = $this->db->order_by('reservations.id','desc')->get();


		if($q->num_rows > 0 ){
			return $q->result();	
		}else{
			return null;
		}
	}


}