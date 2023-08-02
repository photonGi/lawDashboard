<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Model_dashboard extends CI_Model {
    
    function graph()
    {  
        $this->db->select('count(*) as count, DATE(n.added_at) as date')
                ->from('news as n')
                ->where(array(
                    "n.is_deleted"=>0,
                    'n.added_at >='=> "DATE(NOW()) - INTERVAL 7 DAY",
                    ))
                ->group_by('DATE(n.added_at)');
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
            return $result;
        } else {
            return FALSE;
        }
    }
}