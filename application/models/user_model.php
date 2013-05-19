<?php  

class User_model extends CI_Model{

	public function create_user($nom, $prenom, $telephone, $email, $motdepasse){

		$device_token = sha1($email . sha1($motdepasse));

		$data = array(
				'email' 		=>	  $email, 
                'motdepasse' 	=>    sha1($motdepasse),
                'nom' 			=>    $nom,
                'prenom' 		=>    $prenom,
                'telephone' 	=>    $telephone,
                'device_token'	=> 	  $device_token,
                'apn_token'		=> 	  'unknown'	
		);

		$this->db->insert('utilisateurs', $data);

		return $this->db->insert_id();
	}

	public function sign_in($email, $password){

		$q = $this
            ->db
            ->select('date_created, device_token, apn_token, nom, prenom, telephone, email, id')
            ->where('email', $email)
            ->where('motdepasse', sha1($password))
            ->limit(1)
            ->get('utilisateurs');

      if ( $q->num_rows > 0 ) {
         return $q->row();
      }
      
      return false;
		
	}

	public function get_user($id){
		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');
		if ( $q->num_rows > 0 ) {
         return $q->row();
      }
      
      return false;
	}

	public function is_valid_password($id, $pwd){
		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');

		if($q->num_rows > 0 && $q->row()->motdepasse == sha1($pwd)){
			return true;	
		}else{
			return false;
		}
	}

	public function password_check($pwd){

		$q = $this->db->where('id', $this->session->userdata('user_id'))->limit(1)->get('utilisateurs');

		if($q->num_rows > 0 && $q->row()->motdepasse == sha1($pwd)){
			return TRUE;	
		}else{
			return FALSE;
		}
	}

	public function email_check($email){
		$q = $this->db->where('id !=', $this->session->userdata('user_id'))
					->where('email', $email)
					->limit(1)
					->get('utilisateurs');

		if($q->num_rows > 0){
			return false;	
		}else{
			return true;
		}
	}

	public function get_all(){
		$q = $this->db->get('utilisateurs');
		if($q->num_rows > 0 ){
			return $q->result();	
		}else{
			return null;
		}
	}


	public function is_admin($id){

		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');
		if($q->num_rows > 0 && $q->row()->admin == 1){
			return TRUE;	
		}else{
			return FALSE;
		}
		
	}

	public function delete($id){
		$this->db->delete('utilisateurs', array('id' => $id));
	}

	public function make_admin($id){
		$data = array(
               'admin' => 1
            );
		$this->db->where('id', $id);
		$this->db->update('utilisateurs', $data);
	}

	public function remove_apn($id){
		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');
		if($q->num_rows > 0){
			$r = $q->row();
			if($r->apn_token != NULL){
				$data = array(
               		'apn_token' => 'unknown'
            	);

				$this->db->where('id', $id);
				$this->db->update('utilisateurs', $data); 
			}
		}
	}

	public function add_apn($id, $apn_token){
		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');
		if($q->num_rows > 0){
			$data = array(
            	'apn_token' => $apn_token
            );

			$this->db->where('id', $id);
			$this->db->update('utilisateurs', $data); 
			
		}
	}
	
	public function device_type($id, $device_type){
		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');
		if($q->num_rows > 0){
			$data = array(
            	'device_type' => $device_type
            );

			$this->db->where('id', $id);
			$this->db->update('utilisateurs', $data); 
			
		}
	}
	
	

}