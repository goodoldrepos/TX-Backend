<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function reservation_encours($id){
	$CI = get_instance();
    $CI->load->model('reservation_model');
	return $CI->reservation_model->en_cours($id);
}