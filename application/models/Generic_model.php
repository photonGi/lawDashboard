<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Generic_model extends CI_Model {
    
    

    function insert($table, $data) {
        $this->db->insert($table, $data);
        if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
    }
    function getResults($query) {
        $query = $this->db->query($query);

        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }

    function getAllRecords($table,$where,$by,$order) {
        $this->db->select()->from($table)->where($where)->order_by($by,$order);
        $query=$this->db->get();

        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }

    function getAllRecordsLike($table,$where,$colm,$like,$by,$order) {
        $this->db->select()->from($table)->where($where)->like($colm,$like)->order_by($by,$order);
        $query=$this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    function getAllRecordsbyLimit($table,$where,$by,$order,$limit,$start) {
        $this->db->select()->from($table)->where($where)->order_by($by,$order)->limit($limit , $start);
        $query=$this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    function getSpecificRecord($table,$where) {
        $this->db->select()->from($table)->where($where);
        $query=$this->db->get();
        if ($query->num_rows() > 0)
        {
            $result= $query->result_array();
            return $result[0];
        }
        else
        {return FALSE;}

    }
    function getSpecificRecordOrder($table,$where,$by,$order) {
        $this->db->select()->from($table)->where($where)->order_by($by,$order);
        $query=$this->db->get();
        if ($query->num_rows() > 0)
        {
            $result= $query->result_array();
            return $result[0];
        }
        else
        {return FALSE;}

    }
    public function updateRecord($table,$set, $where) {
        $this->db->update($table, $set, $where);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

   function updateCustom($query) {
        $query = $this->db->query($query);

        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }
    

    public function delete($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }
    public function getMaxId($table){
       $query=$this->db->query("SELECT max(id) as max FROM $table ");

        if ($query->num_rows() > 0){
             $result= $query->result_array();
            return $result[0];
        }
        else{
            return FALSE;
    }
    }
    public function getCount($table,$field,$where){
         $this->db->select('count('.$field.') as count')
         ->from($table)
         ->where($where);
         $query=$this->db->get();

        if ($query->num_rows() > 0){
             $result= $query->result_array();
            return $result[0];
        }
        else{
            return FALSE;
    }

    }
    public function getSum($table,$field,$where){
      $this->db->select('sum('.$field.') as sum')
         ->from($table)
         ->where($where);
         $query=$this->db->get();

        if ($query->num_rows() > 0){
             $result= $query->result_array();
            return $result[0];
        }
        else{
            return FALSE;
    }

    }
    function getSpecificMaxId($table,$where,$coloumn)
    {
        $this->db->select_max("$coloumn")
        ->from($table)->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $result= $query->result_array();
            return $result[0];
        }
        else
        {
            return FALSE;
        }
    }

    function get_distinct($table,$field)
    {
        $this->db->select("DISTINCT($field)")->from($table)->order_by($field,"ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }

    function get_distinctwhere($table,$field,$where)
    {
        $this->db->select("DISTINCT($field)")->from($table)->where($where)->order_by($field,"ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    function getData($table,$fields,$where,$by)
    {
        $this->db->select("$fields")->from($table)->where($where)->order_by($by,"ASC");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }

   

}


