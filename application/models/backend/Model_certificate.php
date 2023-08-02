<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Model_blogs extends CI_Model {
    
   
   function getAllBlogs(){
       $this->db->select('b.*,u.firstName,u.lastName,bc.bcTitle')
                ->from('blogs as b')
                ->join('users as u','u.id=b.createdBy')
                ->join('blogCategories as bc','bc.bcid=b.bcid')
                ->where(array("b.is_deleted"=>0))
                ->group_by("b.blogId")
                ->order_by("b.blogId","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
      function getCategories(){
       $this->db->select('bcId,bcTitle')
                ->from('blogCategories')
               
                ->where(array("is_deleted"=>0))
                ->order_by("bcId","asc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getSpecificBlog($blog){
       $this->db->select('b.*')
                ->from('blogs as b')
                ->where(array("b.blogId"=>$blog));
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
  
      
}