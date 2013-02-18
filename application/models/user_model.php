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

		return $this->db->insert('utilisateurs', $data);

	}

	public function signIn($email, $password){

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

	public function isAdmin(){
		
	}

}