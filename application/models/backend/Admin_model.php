<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class admin_model extends CI_Model {
    
    function getAdmins()
    {  
        $this->db->select('u.id,u.firstName,u.lastName,u.email,u.phone,u.address,u.status')
                ->from('users as u')
                ->where(array("u.roleId != "=>1,"u.is_deleted"=>0))
                 ;
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
            return $result;
        } else {
            return FALSE;
        }
    }
    function getSpecificAdmin($adminId)
    {  
        $this->db->select('u.*')
                ->from('users as u')
                ->where(array("u.roleId != "=>1,"u.is_deleted"=>0,"u.id"=>$adminId))
                 ;
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
            return $result[0];
        } else {
            return FALSE;
        }
    }
     function getSpecificCustomer($adminId)
    {  
        $this->db->select('u.*')
                ->from('customers as u')
                ->where(array("u.id"=>$adminId))
                 ;
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
            return $result[0];
        } else {
            return FALSE;
        }
    }
    function getAllAdminNews($userId)
    {  
        $this->db->select('n.*,u.firstName,u.lastName,r.designation')
                ->from('news as n')
                ->join("users as u","u.id=n.added_by")
                ->join("roles as r","r.id=u.roleId")
                ->where(array("n.is_deleted"=>0,"u.roleId !="=>"1","n.added_by"=>$userId))
                 ;
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
            return $result;
        } else {
            return FALSE;
        }
    }
     
}