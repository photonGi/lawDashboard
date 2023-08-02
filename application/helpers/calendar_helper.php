<?php
if (!function_exists('getModules')){
   
    function getUpcommingEvents()
    {   
        $CI = & get_instance();
        $CI->load->model('generic_model');
        $calArr=$CI->generic_model->getAllRecordsbyLimit("calendar",array(
                            "date >="=>date("Y-m-d"),
                            "is_deleted"=>0,
                            "status"=>1
                        ),"date","ASC","4","0");
        return $calArr;
    }
}

