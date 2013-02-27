<?php  

class User_model extends CI_Model{
	

	public function create_user(){
		
		$data = array(
				'email' 		=>	  $this->input->post('email'), 
                'motdepasse' 	=>    sha1($this->input->post('motdepasse')),
                'nom' 			=>    $this->input->post('nom'),
                'prenom' 		=>    $this->input->post('prenom'),
                'telephone' 	=>    $this->input->post('telephone'),
		);

		$this->db->insert('utilisateurs', $data);

		return $this->db->insert_id();

	}

	public function sign_in($email, $password){

		$q = $this
            ->db
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

	public function email_check(){
		$q = $this->db->where('id', $id)->limit(1)->get('utilisateurs');

		if($q->num_rows > 0 && $q->row()->motdepasse == sha1($pwd)){
			return true;	
		}else{
			return false;
		}
	}

	public function isAdmin(){
		
	}

}