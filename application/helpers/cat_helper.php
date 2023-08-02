<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getCategories')){

    function getCategories()
    {
        $CI = & get_instance();
        $CI->load->model('generic_model');
        $CI->load->model('backend/model_services');
       
            $modules=$CI->generic_model->getAllRecords("categories",array(
            "parentId"=>"0",
            "status"=>"1"
            ),"catId","asc");
        

       
        return $modules;
    }
}
if(!function_exists('getSubCategories')){
    function getSubCategories($id)
	{
        $CI = & get_instance();
        $CI->load->model('generic_model');
        $CI->load->model('backend/model_services');
         //if($CI->session->userdata('tm_roleId')==1)
       		
        $submodules=$CI->generic_model->getAllRecords("categories",array(
		"parentId"=>$id,
		"status"=>"1"
		),"catId","asc");
        
        
        return $submodules;
        }
} ?>
