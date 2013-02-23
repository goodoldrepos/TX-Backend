<?php 

class reservation_model extends CI_Model{
	

	public function create_reservation(){
		$r = $this->session->userdata('reservation');

		$a_depart = array(
				'ville' => $r['ville'],
				'rue' 	=> $r['rue'],
				'code_postale' => $r['cp']
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


}