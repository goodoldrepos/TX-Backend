<?php  

class chauffeur_model extends CI_Model {
	
	public function create_chauffeur($data){
		
		

		$this->db->insert('chauffeurs', $data);

		return $this->db->insert_id();

	}
	
	public function is_not_allowed($email){
		
		//get the user licence number
		$user = $this
            	->db
            	->select('licence')
           		->where('email', $email)
           		->get('chauffeurs');

		if($user->num_rows > 0){
			$res = $user->row();
			$licence = $res->licence;
		}else{
			return true;
		}
		
		$secure =  $this
            		->db
            		->select('licence')
            		->where('email !=', $email)
            		->where('online', 1)
            		->where('licence', $licence)
            		->get('chauffeurs');

		if($secure->num_rows > 0){
			return true; //chauffeur not allowed because there is someone else who's connected too
		}else{
			return false;
		}
	}
	
	public function set_online($id){
		$data = array( 'online' => 1 );
		$this->db->where('id', $id);
		$this->db->update('chauffeurs', $data);
		return true;
	}
	
	public function set_offline($id){
		$data = array( 'online' => 0 );
		$this->db->where('id', $id);
		$this->db->update('chauffeurs', $data);
		return true;
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