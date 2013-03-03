<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function is_admin($id){
	$CI = get_instance();
    $CI->load->model('user_model');
	return $CI->user_model->is_admin($id);
}