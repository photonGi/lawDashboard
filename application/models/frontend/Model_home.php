<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Model_home extends CI_Model {
    function getSlider(){
        $this->db->select('*')
                ->from('slider')
                               
                ->where(array("is_deleted"=>0,"status"=>1))
                ->order_by("orderImage","asc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    
  
  
   
}