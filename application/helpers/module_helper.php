<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getModules')){

    function getModules()
    {
        $CI = & get_instance();
        $CI->load->model('generic_model');
        $CI->load->model('backend/model_permissions');
        if($CI->session->userdata('ft_userId')==1)
        {
            $modules=$CI->generic_model->getAllRecords("system_modules",array(
            "parentId"=>"0",
            "status"=>"1"
            ),"serialNo","asc");
        }

        else
        {
            $permissions=$CI->model_permissions->getParentRecords();
            
            $modules=array();
            $parentIds=array();
            if($permissions){
                //prtm_r($permissions);exit;
                foreach($permissions as $pr){
                    if($pr["parentId"]==0){
                        array_push($modules, $pr);
                    }
                    else{
                        
                        if(in_array($pr["parentId"], $parentIds)){continue;}
                        else{
                            $result=$CI->generic_model->getSpecificRecord("system_modules",array("id"=>$pr["parentId"]));
                            array_push($modules, $result);
                            array_push($parentIds, $pr["parentId"]);
                        }
                    }
                }
            }
        }        
        return $modules;
    }
}
if(!function_exists('getSubModules')){
    function getSubModules($id)
	{
        $CI = & get_instance();
        $CI->load->model('generic_model');
        $CI->load->model('backend/model_permissions');
         //if($CI->session->userdata('tm_roleId')==1)
        if(1)
        {		
        $submodules=$CI->generic_model->getAllRecords("system_modules",array(
		"parentId"=>$id,
		"status"=>"1"
		),"serialNo","asc");
        }
        else{
            $submodules=$CI->model_permissions->getSubModules($id);
        }
        return $submodules;
        }
} ?>
