<?php  

class Users extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required');
      	$this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required');
      	$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');

      	if ( $this->form_validation->run() !== false ) {
         // then validation passed. Get from db
         	$id = $this
                  ->user_model
                  ->create_user();

         	$this->session->set_userdata('user_id', $id);
            redirect('pages/home');
      	}	

      	$this->load->view('templates/header');
      	$this->load->view('users/create');
      	$this->load->view('templates/footer');

	}

	public function update($id){

		$feedback = NULL;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required|numeric');
      	$this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required');
      	$this->form_validation->set_rules('ancien_motdepasse', 'Mot de passe', 'required|min_length[4]');
      	$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');
      	$this->form_validation->set_rules('confirmation_motdepasse', 'Confirmation Mot de passe', 'required|matches[motdepasse]');

		if( $this->form_validation->run() !== false && $this->user_model->is_valid_password($id, $this->input->post('ancien_motdepasse')) ){

			$data = array(
               'nom' => $this->input->post('nom'),
               'prenom' => $this->input->post('prenom'),
               'email' => $this->input->post('email'),
               'telephone' => $this->input->post('telephone'),
               'motdepasse' => sha1($this->input->post('motdepasse'))
        	);

        	$this->db->where('id', $id);
			$this->db->update('utilisateurs', $data);

			$feedback = 'Votre profil a été modifie avec success.';

		}

			$u = $this->user_model->get_user($id);
			if($u){
				$data = array(
					'nom' => $u->nom,
					'prenom' => $u->prenom,
					'email' => $u->email,
					'telephone' => $u->telephone,
					'id' => $id,
					'feedback' => $feedback
				);
			}
			
			$this->load->view('templates/header');
			$this->load->view('users/update', $data);
			$this->load->view('templates/footer');
		

		
		
	}


}