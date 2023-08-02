<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('checkModulePermission'))
{
    function checkModulePermission(){
        $CI = & get_instance();
        $CI->load->model('backend/model_permissions');
        //The login user is not superadmin than
        
        if($CI->session->userdata('ft_roleId')!=1){
            $rights=$CI->model_permissions->hasModulePermission($CI->uri->segment(1)."/".$CI->uri->segment(2),$CI->session->userdata('ft_userId'));
            if($rights==TRUE){
                return TRUE;
            }
            else {
                $CI->load->view("backend/error_404");
            }
        }
        else{
            return TRUE;
        }
      }
}
if (!function_exists('checkFunctionPermission'))
{   
    function checkFunctionPermission($permission){
        $CI = & get_instance();
        $CI->load->model('backend/model_permissions');
        
        $moduleId=$CI->session->userdata('tm_moduleId');
        //The login user is not superadmin than
        //return $moduleId;
        if($CI->session->userdata('ft_roleId')!=1){
            $rights=$CI->model_permissions->hasFunctionPermission($moduleId,$CI->session->userdata('ft_userId'),$permission);
            if($rights==TRUE){
                return TRUE;
            }
            else {
                $CI->load->view("backend/error_404");
            }
        }
        else{
            return TRUE;
        }
      }
}