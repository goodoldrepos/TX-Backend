<?php  

class User_model extends CI_Model{

	public function create_user($nom, $prenom, $telephone, $email, $motdepasse){

		$data = array(
				'email' 		=>	  $email, 
                'motdepasse' 	=>    sha1($motdepasse),
                'nom' 			=>    $nom,
                'prenom' 		=>    $prenom,
                'telephone' 	=>    $telephone
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

}