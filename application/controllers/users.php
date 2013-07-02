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
      	$this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required|is_unique[utilisateurs.email]');
      	$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[6]');

      	if ( $this->form_validation->run() !== false ) {
         // then validation passed. Insert to DB
         	$id = $this
                  ->user_model
                  ->create_user($this->input->post('nom'),
                  				$this->input->post('prenom'),
                  				$this->input->post('telephone'),
                  				$this->input->post('email'),
                  				$this->input->post('motdepasse')
               	  );

         	$this->session->set_userdata('role', "client");
         	$this->session->set_userdata('user_id', $id);
         	$this->session->set_userdata('username', $this->input->post('nom') . " " . $this->input->post('prenom'));
            redirect('pages/home');
      	}	

      	$this->load->view('templates/header');
      	$this->load->view('users/create');
      	$this->load->view('templates/footer');

	}

	//modifier le mot de passe depuis la page "gestion du compte"
	public function password($id){

		$feedback = NULL;

		if($this->session->userdata('user_id') !== $id){
			redirect('users/update/' . $this->session->userdata('user_id'));
		}

		$this->load->library('form_validation');
      	$this->form_validation->set_rules('ancien_motdepasse', 'Ancien Mot de passe', 'required|min_length[4]|callback_password_check');
      	$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');
      	$this->form_validation->set_rules('confirmation_motdepasse', 'Confirmation Mot de passe', 'required|matches[motdepasse]');

		if( $this->form_validation->run() !== false ){

			$data = array(
               'motdepasse' => sha1($this->input->post('motdepasse'))
        	);

        	$this->db->where('id', $id);
			$this->db->update('utilisateurs', $data);

			$this->session->set_userdata('feedback', 'Votre mot de passe a été modifie avec success.');

		}else{
			
		}

		$u = $this->user_model->get_user($id);
			if($u){
				$data = array(
					'nom' => $u->nom,
					'prenom' => $u->prenom,
					'email' => $u->email,
					'telephone' => $u->telephone,
					'id' => $id,
				);
			}
			
			$this->load->view('templates/header');
			$this->load->view('users/update', $data);
			$this->load->view('templates/footer');
		
	}

	//afficher le profil de l'utilisateur
	public function show($id){
			
		$user = $this->user_model->get_user($id);

		$data = array(
				'nom' => $user->nom,
				'prenom' => $user->prenom,
				'email' => $user->email
		);

		$this->load->view('templates/header');
		$this->load->view('users/show', $data);
		$this->load->view('templates/footer');


	}

	//modifier le profil utilisateur depuis la page "gestion du compte" (sans modifier le mot de passe)
	public function update($id = NULL){

		$this->session->set_userdata('feedback', NULL);

		// si utilisateur pas connecté, redirigé vers page inscription
		if(!$this->session->userdata('user_id') || $id == NULL){
			redirect('sessions/create');
		}

		if( $this->session->userdata('user_id') != $id){
			redirect('users/update/' . $this->session->userdata('user_id'));
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required|numeric');
      	$this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required|callback_email_check');

		if( $this->form_validation->run() !== false ){

			$data = array(
               'nom' => $this->input->post('nom'),
               'prenom' => $this->input->post('prenom'),
               'email' => $this->input->post('email'),
               'telephone' => $this->input->post('telephone'),
        	);

        	$this->db->where('id', $id);
			$this->db->update('utilisateurs', $data);

			$this->session->set_userdata('feedback', 'Votre profil a été modifie avec success.');

		}

			$u = $this->user_model->get_user($id);
			if($u){
				$data = array(
					'nom' => $u->nom,
					'prenom' => $u->prenom,
					'email' => $u->email,
					'telephone' => $u->telephone,
					'id' => $id,
				);
			}
		
			$this->load->view('templates/header');
			$this->load->view('users/update', $data);
			$this->load->view('templates/footer');
		
	}

	//verifier si l'email est valide
	public function email_check($email)
	{

		if (!$this->user_model->email_check($email))
		{
			$this->form_validation->set_message('email_check', 'The %s field is incorrect');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	//verifier que le mot de passe est valide
	public function password_check($pwd)
	{

		if (!$this->user_model->password_check($pwd))
		{
			$this->form_validation->set_message('password_check', 'La valeur du champ %s est incorrecte');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	//recuperer une liste de tous les utilisateurs inscris
	public function all(){
		$users= $this->user_model->get_all();
		$data = array( 'users' => $users);

		$this->load->view('templates/header');
		$this->load->view('users/list', $data);
		$this->load->view('templates/footer');
	}

	//supprimer un utilisateur
	public function destroy($id){
		$this->user_model->delete($id);
		redirect('pages/admin');
	}

	//grant to a user admin role
	public function admin($id){
		//$this->user_model->make_admin($id);
	}
	



}