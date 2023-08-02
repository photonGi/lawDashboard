<?php
if (!defined('BASEPATH'))
    exit('No direct script  allow');
class Model_events extends CI_Model {
    function getAllEvents($mode) {
      $this->db->select('events.*,status.name');
      $this->db->from('events');
      $this->db->join('status','status.id=events.status','left');
        if ($mode=="upcoming") {
            $this->db->where(array('events.createdAt>='=>date('Y-m-d'),'events.is_deleted'=>0));
        }else{
            $this->db->where(array('events.createdAt<'=>date('Y-m-d'),'events.is_deleted'=>0));
        }
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        $result=$query->result_array();
            return $result;
      }else{
      return FALSE;
    }
   }
   function getSpecificEvents($eventId) {
      $this->db->select('events.*,status.name');
      $this->db->from('events');
      $this->db->join('status','status.id=events.status','left');
        $this->db->where(array('events.id'=>$eventId,'events.is_deleted'=>0));
        
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        $result= $query->result_array();
            return $result[0];
      }else{
      return FALSE;
    }
   }
   function getNotifications($noteType) {
        $in=explode(',',$noteType);
        $this->db->select('distinct(notif.type_id) as types,count(notif.id) as total,n_type.name as noteName,n_type.note_url,n_type.icon')
                 ->from('notifications as notif')
                 ->join('notification_types as n_type','notif.type_id = n_type.id','left outer')
                 ->join('events as ev','notif.event_id = ev.id')
                 ->where(array(
                   'notif.status'=>1 ))
                ->where_in ("notif.type_id",$in)
                ->group_by('notif.type_id');
        $query = $this->db->get();
                    $result= $query->result_array();
                    return $result; }
}