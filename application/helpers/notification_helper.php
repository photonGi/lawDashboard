<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getNotifications')){
    function getNotifications()
    {
        $CI = & get_instance();
        $CI->load->model('backend/model_notification');
        $notifications=array();
        if($CI->session->userdata('microfinance_roleId')==3)
        {
            $notification_type="1";
            $notifications=$CI->model_notification->getNotifications($notification_type);
        }
        return $notifications;
    }
}


?>
