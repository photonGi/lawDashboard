<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Model_permissions extends CI_Model {
    function hasModulePermission($functionName,$userId) {
        $this->db
                ->select('system_modules.id,system_modules.moduleName,permissions.*')
                ->from('system_modules')
                ->join('permissions','permissions.moduleId=system_modules.id')
                ->where(array(
                    'system_modules.functionName'=>$functionName,
                    'permissions.userId'=>$userId
                ));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result=$query->result_array();
            $result=$result[0];
            $this->session->set_userdata("tm_moduleId",$result["id"]);
            if($result["add_permission"]==1 || $result["edit_permission"]==1 || $result["delete_permission"]==1 || $result["all_permission"]==1){
            
               return TRUE; 
            }
            else{
                return FALSE;
            }
        }
        else 
        {
            return FALSE;
        }
        
    }
    function hasFunctionPermission($moduleId,$userId,$permission) {
        
        $this->db->select('')
                ->from('permissions')
                ->where(array(
                    'moduleId'=>$moduleId,
                    'userId'=>$userId
                ));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result=$query->result_array();
            $result=$result[0];
            $this->session->set_flashdata('moduleId',$result["moduleId"]);
            if($result[$permission]==1 or $result["all_permission"]){            
               return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else 
        {
            return FALSE;
        }
    }
    function getParentRecords() {
        
        $this->db->select()
                ->from('system_modules as m')
                ->join ("permissions as p" ,"p.moduleId=m.id")
                ->where(array(
                    'p.userId'=>$this->session->userdata('ft_userId'),
                    'm.status'=>1,
                ))
                ->order_by("serialNo","asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else 
        {
            return FALSE;
        }
    }
    function getSubModules($id) {
        
        $this->db->select()
                ->from('system_modules as m')
                ->join ("permissions as p" ,"p.moduleId=m.id")
                ->where(array(
                    'p.userId'=>$this->session->userdata('ft_userId'),
                    'm.parentId'=>$id,
                    'm.status'=>1,
                ))
                ->order_by("serialNo","asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else 
        {
            return FALSE;
        }
    }
}