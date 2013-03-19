<?php  

class Chaffeur_model extends CI_Model {
	
	public function create_chaffeur(){
		
		$data = array(
				'email' 		=>	  $this->input->post('email'), 
                'motdepasse' 	=>    sha1($this->input->post('motdepasse')),
                'nom' 			=>    $this->input->post('nom'),
                'prenom' 		=>    $this->input->post('prenom'),
                'telephone' 	=>    $this->input->post('telephone'),
		);

		$this->db->insert('chaffeurs', $data);

		return $this->db->insert_id();

	}

	public function sign_in($email, $password){

		$q = $this
            ->db
            ->select('date_created, nom, prenom, telephone, email, id')
            ->where('email', $email)
            ->where('motdepasse', $password)
            ->limit(1)
            ->get('chaffeurs');

      if ( $q->num_rows > 0 ) {
         return $q->row();
      }
      
      return false;
		
	}


}