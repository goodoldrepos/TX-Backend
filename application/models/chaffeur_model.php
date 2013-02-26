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



}