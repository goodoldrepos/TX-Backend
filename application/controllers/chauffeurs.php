<?php 

class Chauffeurs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('chauffeur_model');
	}


    public function home(){
        $this->load->view('templates/header');
        $this->load->view('chauffeurs/home');
        $this->load->view('templates/footer');
    }

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		//$this->form_validation->set_rules('adresse', 'Adresse', 'required');

      	if ( $this->form_validation->run() !== false ) {

			//stocker les informations du formulaire dans la session
			$this->session->set_userdata('role', "chauffeur");

			$data = array(
				'email' 		=>	  $this->input->post('email'), 
                'motdepasse' 	=>    sha1($this->input->post('motdepasse')),
                'nom' 			=>    $this->input->post('nom'),
                'prenom' 		=>    $this->input->post('prenom'),
                'telephone' 	=>    $this->input->post('telephone'),
			);

			//créer nouveau profil chauffeur
			$id = $this->chauffeur_model->create_chauffeur($data);

			$this->session->set_userdata('user_id', $id);
         	$this->session->set_userdata('role', "chauffeur");

			redirect('chauffeurs/home');


      	}else{
      		$this->load->view('templates/header');
      		$this->load->view('pages/chauffeurs');
      		$this->load->view('templates/footer');
      	}
		
	}

	public function view(){
			
	}

	public function signup(){
		$this->load->view('templates/header');
      	$this->load->view('chauffeurs/create');
      	$this->load->view('templates/footer');	
	}

    public function signin(){
        $this->load->view('templates/header');
        $this->load->view('chauffeurs/signin');
        $this->load->view('templates/footer');
    }

    public function auth(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required');
        $this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');

        if ( $this->form_validation->run() !== false ) {
            // then validation passed.
            $res = $this
                ->chauffeur_model
                ->sign_in(
                    $this->input->post('email'),
                    $this->input->post('motdepasse')
                );

            if ( $res !== false ) {
                $this->session->set_userdata('user_id', $res->id);
                $this->session->set_userdata('username', $res->nom . " " . $res->prenom);
                $this->session->set_userdata('role','chauffeur');
                redirect('pages/home');
            }

        }

        redirect("chauffeurs/signin");
    }

	public function update(){
		
	}

	public function destroy(){
		
	}

	public function listAll(){
		
	}





}