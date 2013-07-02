<?php  

class chauffeur_model extends CI_Model {
	
	public function create_chauffeur($data){
		
		

		$this->db->insert('chauffeurs', $data);

		return $this->db->insert_id();

	}

	public function sign_in($email, $password){
		$q = $this
            ->db
            ->select('date_created, nom, prenom, telephone, email, id, valide, num_carte_pro, licence')
            ->where('email', $email)
            ->where('motdepasse', sha1($password))
            ->limit(1)
            ->get('chauffeurs');

      if ( $q->num_rows > 0 ) {
        return $q->row();
      }else{
        return false;
      }	
	}

	public function get_all(){
		$q = $this->db->get('chauffeurs');
		if($q->num_rows > 0 ){
			return $q->result();	
		}else{
			return null;
		}
	}


}