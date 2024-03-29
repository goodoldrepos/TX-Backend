<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function reservation_encours($id){
	$CI = get_instance();
    $CI->load->model('reservation_model');
    $cond = $CI->reservation_model->en_cours($id); 

	if($cond && $cond == "pending"){
		return "Votre réservation est en cours de traitement. Vous allez recevoir une confirmation par e-mail d'ici quelques minutes.";
		
	}elseif($cond && $cond == "accepted" ) {
		return "Votre taxi est en route ! Vous allez recevoir une notification dés que votre taxi est arrivé";

	}elseif($cond && $cond == "feedback"){
		return "Comment vous avez trouvé votre dernière réservation ?";
	}else{
		return null;
	}
}