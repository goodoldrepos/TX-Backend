<?php 

class Chauffeurs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('chauffeur_model');
	}


	//le chauffeur est redirigé quand il est identifie correctement 
    public function home(){
        $this->load->view('templates/header');
        $this->load->view('chauffeurs/home');
        $this->load->view('templates/footer');
    }

	//logique pour authentifier un chauffeur (email + mot de passe )
    public function auth(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Adresse Email', 'valid_email|required');
        $this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[4]');

        if ( $this->form_validation->run() !== false ) {
	
            //then validation passed
            $res = $this
                ->chauffeur_model
                ->sign_in(
                    $this->input->post('email'),
                    $this->input->post('motdepasse')
                );

            if ( $res !== false ) {
				if($res->valide == "pending"){
					echo "Vous allez recevoir un mail une fois votre compte activé";
				}elseif($res->valide == "ignored"){
					echo "Vous allez recevoir un mail une fois votre compte activé";
				}elseif($res->valide == "active"){
					$this->session->set_userdata('user_id', $res->id);
	                $this->session->set_userdata('username', $res->nom . " " . $res->prenom);
	                $this->session->set_userdata('role','chauffeur');
	                redirect('pages/home');
				}      
            }

        }else{
			redirect("chauffeurs/signin");
		}
    }

	public function create(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prénom', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('motdepasse', 'Mot de passe', 'required|min_length[6]');
		$this->form_validation->set_rules('telephone', 'Téléphone', 'required');
		$this->form_validation->set_rules('adresse', 'Adresse', 'required');
		$this->form_validation->set_rules('num_carte_pro', 'Numéro Carte Pro', 'required');
		$this->form_validation->set_rules('licence', 'Licence Taxi', 'required');
		

      	if ( $this->form_validation->run() !== false ) {

			$data = array(
				'email' 		=>	  $this->input->post('email'), 
                'motdepasse' 	=>    sha1($this->input->post('motdepasse')),
                'nom' 			=>    $this->input->post('nom'),
                'prenom' 		=>    $this->input->post('prenom'),
                'telephone' 	=>    $this->input->post('telephone'),
                'adresse' 		=>    $this->input->post('adresse'),
                'num_carte_pro' =>    $this->input->post('num_carte_pro'),
                'smartphone' 	=>    $this->input->post('smartphone'),
                'licence' 		=>    $this->input->post('licence'),
                'valide' 		=>    "pending"
			);

			//créer nouveau profil chauffeur
			$id = $this->chauffeur_model->create_chauffeur($data);
			$this->session->set_userdata('user_id', $id);
         	$this->session->set_userdata('role', "chauffeur");
         	$this->session->set_userdata('username', $this->input->post('nom') . " " . $this->input->post('prenom'));
			redirect('chauffeurs/home');

      	}else{
      		$this->load->view('templates/header');
      		$this->load->view('chauffeurs/create');
      		$this->load->view('templates/footer');
      	}
		
	}

	//consulter profil du chauffeur
	public function view(){
			
	}

	//quand l'utilisateur clique sur le bouton s'inscrire (tant que chauffeur)
	public function signup(){
		$this->load->view('templates/header');
      	$this->load->view('chauffeurs/create');
      	$this->load->view('templates/footer');	
	}

	//quand l'utilisateur clique sur le bouton s'identifier (tant que chauffeur)
    public function signin(){
        $this->load->view('templates/header');
        $this->load->view('chauffeurs/signin');
        $this->load->view('templates/footer');
    }

	public function activer($id){
		if(is_admin($this->session->userdata('user_id'))){
			$data = array(
	           'valide' => "active"
	    	);
	    	$this->db->where('id', $id);
			$this->db->update('chauffeurs', $data);

			redirect("pages/admin");
		}else{
			echo "Vous avez pas le droit de faire ça.";
		}

	}
	
	public function ignorer($id){
		
		if(is_admin($this->session->userdata('user_id'))){
			$data = array(
	           'valide' => "ignored"
	    	);
	    	$this->db->where('id', $id);
			$this->db->update('chauffeurs', $data);

			redirect("pages/admin");
		}else{
			echo "Vous avez pas le droit de faire ça.";
		}
		
			
	}

	//le chauffeur mets a jour son profil 
	public function update(){
		
	}

	//supprimer un chauffeur 
	public function destroy(){
		
	}

	//lister tous les chauffeurs
	public function listAll(){
		
	}

}