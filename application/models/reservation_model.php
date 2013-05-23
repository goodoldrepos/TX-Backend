<?php 
class reservation_model extends CI_Model{
	
	//create new reservation
	public function create_reservation($depart, $destination, $id){
		
		
		$this->load->helper('maps_helper');
		$coord = lookup($depart  . " ,France"); 

		if($coord['latitude'] == NULL){
			$coord['latitude'] = $coord['longitude'] = 0;
		}

		$a_depart = array(
				'adresse' 		=> $depart,
				'latitude'		=> $coord['latitude'],
				'longitude'		=> $coord['longitude']
		);   	

		$this->db->insert('adresses_depart', $a_depart);
		$id_depart = $this->db->insert_id();

		$new_reservation = array(
			'id'				=> $id_depart,
			'id_utilisateur'	=> $id,
			'id_depart'  		=> $id_depart, 
			'destination'		=> $destination,
			'status'			=> 'pending'	
		);

		$this->db->insert('reservations', $new_reservation);

		return array('latitude' => $coord['latitude'], 'longitude' => $coord['longitude']);
	}

	public function get_current_reservation($id){
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->where('id_utilisateur', $id);
		$this->db->where('status !=', 'done');
		$this->db->join('adresses_depart', 'adresses_depart.id = reservations.id_depart');

		$q = $this->db->get();

		if ( $q->num_rows > 0 ) return $q->row();
    	else return false;
	}

	// Check is if there is a reservation currently, return true or false. 
	public function en_cours($id){

		$q = $this->db->where('id_utilisateur',$id)->where('status !=','done')->limit(1)->get('reservations');
		if ( $q->num_rows > 0 ) return $q->row()->status;
    	else return false;
	}



	//get position de depart for a given user_id
	public function get_position_depart($id){

		
		$reservation = $this->db
							->where('id_utilisateur', $id)
							->where('status !=', 'done')
							->limit(1)
							->get('reservations'); 

		if($reservation->num_rows > 0){
			$res = $reservation->row();
			$id_depart = $res->id_depart;
			$q = $this->db->where('id', $id_depart)->limit(1)->get('adresses_depart');

			if( $q->num_rows > 0 ) {
         		return $q->row();
      		}else{ 
	      		return NULL; 
	      	}

		}else{
			return NULL;
		}
			
	}

	//cancel a reservation
	//$id : reservation id 
	public function delete($id, $status = "done"){
		$data = array( 'status' => $status );
		$this->db->where('id', $id);
		$this->db->update('reservations', $data);
		return true;
	}


	//get all reservations (active + archive)
	public function get_all(){
		$this->db->select('	reservations.id, 
							reservations.destination, 
							adresses_depart.adresse, 
							utilisateurs.nom,
							utilisateurs.prenom,
							reservations.status
						');
		$this->db->from('reservations');
		$this->db->join('utilisateurs', 'utilisateurs.id = reservations.id_utilisateur');
		$this->db->join('adresses_depart', 'adresses_depart.id = reservations.id_depart');

	 	$q = $this->db->order_by('reservations.id','desc')->get();


		if($q->num_rows > 0 ){
			return $q->result();	
		}else{
			return null;
		}
	}

	//un chauffeur accepte une reservation, faut lui confirmer. 
	public function validate_reservation($id_reservation, $id_chauffeur){

		$qreservation = $this->db->where('id', $id_reservation)->limit(1)->get('reservations'); 

		//if there is actually a reservation with that number
		if($qreservation->num_rows > 0 ){
			$reservation = $qreservation->row();

			//if that reservation is still pending, than make it accepted and send push notification/email 
			if( $reservation->status == 'pending'){
				$data = array(
               		'status' => 'accepted', 
               		'id_chauffeur' => $id_chauffeur
            	);

            	$quser = $this->db->where('id', $reservation->id_utilisateur)->limit(1)->get('utilisateurs');
            	if($quser->num_rows > 0){
            		$user = $quser->row();
            		$dtype = $user->device_type; 
            		$apn = $user->apn_token;

            		//if the user is logged in on a smartphone then send him push notification
            		if($apn != 'unknown'){

						$message = "Votre Taxi #" . $id_chauffeur . " est en route";
						
						if($dtype == "ios"){
							
							//send iOS notification
							$this->load->library('apn');
	        				$this->apn->payloadMethod = 'enhance'; // you can turn on this method for debugging purpose
	        				$this->apn->connectToPush();
	        				$send_result = $this->apn->sendMessage($apn, $message, /*badge*/ 1, /*sound*/ 'default'  );
	        				$this->apn->disconnectPush();
		
						}elseif($dtype == "android"){
							
							//send android notification 
					        $this->load->library('gcm');
					        $this->gcm->setMessage($message);
					        $this->gcm->addRecepient($apn);
					        /*$this->gcm->setData(array(
					            'some_key' => 'some_val'
					        ));*/
												
					       	$this->gcm->send();
					           
					        //print_r($this->gcm->status);
							//print_r($this->gcm->messagesStatuses);

						}
            			
            		}else{
            			$this->load->library('email');
						$this->email->from('taxi@braksa.com', 'Taxi Parisien');
						$this->email->to('qmathematical@gmail.com'); 
						$this->email->cc('zakaria@braksa.com'); 
						$this->email->subject('Taxi Paris');
						$this->email->message('Votre taxi est en route.');	
						$this->email->send(); 
            		}		
            	}

				$this->db->where('id', $id_reservation);
				$this->db->update('reservations', $data);

				return true;

			}else{
				return false; 
			}
		}else{
			return false;
		}
	}

	function rappel($id_reservation){

		$qreservation = $this->db->where('id', $id_reservation)->limit(1)->get('reservations'); 
		if($qreservation->num_rows > 0){

			/*$data = array(
               		'status' => 'feedback', 
            );

            $this->db->where('id', $id_reservation);
			$this->db->update('reservations', $data);*/

			$reservation = $qreservation->row();
			$quser = $this->db->where('id', $reservation->id_utilisateur)->limit(1)->get('utilisateurs');

			if($quser->num_rows > 0){
        		$user = $quser->row();
        		$dtype = $user->device_type; 
        		$apn = $user->apn_token;


        		//if the user is logged in on a smartphone then send him push notification
        		if($apn != 'unknown'){
        			if($dtype == "ios"){
						$message = "Votre Taxi est là !" ;
						//send iOS notification
						$this->load->library('apn');
        				$this->apn->payloadMethod = 'enhance'; // you can turn on this method for debugging purpose
        				$this->apn->connectToPush();
        				$send_result = $this->apn->sendMessage($apn, $message, /*badge*/ 1, /*sound*/ 'default'  );
        				$this->apn->disconnectPush();
	
					}elseif($dtype == "android"){
						$message = "Votre Taxi est la !" ;
						//send android notification 
				        $this->load->library('gcm');
				        $this->gcm->setMessage($message);
				        $this->gcm->addRecepient($apn);										
				       	$this->gcm->send();

					}
        		}else{
        			//send an email to the user if he doesn't have our mobile app 
        		}		
           	}

           	return TRUE;

		}else{
			return FALSE;
		}
	}

	function terminer($id_reservation){

		$qreservation = $this->db->where('id', $id_reservation)->limit(1)->get('reservations'); 
		if($qreservation->num_rows > 0){

			$data = array(
               		'status' => 'done', 
            );

            $this->db->where('id', $id_reservation);
			$this->db->update('reservations', $data);

           	return TRUE;

		}else{
			return FALSE;
		}
	}

	public function push($id_chaffeur){

	}

}