<?php

if (!defined('BASEPATH'))    exit('No direct script  allow');

class Model_notification extends CI_Model {
    function getNotifications($noteType) {
        $in=explode(',',$noteType);
        $this->db->select('distinct(notif.notification_type) as types,count(notif.id) as total,n_type.name as noteName, n_type.detail as detail,n_type.icon')
                 ->from('notifications as notif')
                 ->join('notification_types as n_type','notif.notification_type = n_type.id','left outer')
                 ->join('subjects as subj','notif.subjectId = subj.id')
                 ->where(array(
                   'subj.status'=>1,
                   'subj.is_deleted'=>0,
                   'notif.status'=>1
                ))
                ->where_in ("notif.notification_type",$in)
                ->group_by('notif.notification_type');
        $query = $this->db->get();
                    $result= $query->result_array();
                    return $result;

}

    function getspecificNotifications($noteType,$addedBy) {
        $in=explode(',',$noteType);
        $this->db->select('distinct(notif.notification_type) as types,count(notif.id) as total,n_type.name as noteName, n_type.detail as detail,n_type.icon')
                 ->from('notifications as notif')
                 ->join('notification_types as n_type','notif.notification_type = n_type.id','left outer')
                 ->join('subjects as subj','notif.subjectId = subj.id')
                 ->where(array(
                    'subj.addedBy'=>$addedBy,
                    'subj.status'=>1,
                    'subj.is_deleted'=>0,
                    'notif.status'=>1
                ))
                ->where_in ("notif.notification_type",$in)
                ->group_by('notif.notification_type');
        $query = $this->db->get();
                    $result= $query->result_array();
                    return $result;

}

    function getNotificationCalls() {

        $this->db->select('s.id as subId,s.name as sName,s.phone as sPhone,ref.name as refName,ref.phone as refPhone,n_type.name as nType,n_type.id as n_typeId,notif.installmentId as insId,sch.month as month,sch.year as year,sch.due_date as due_date,notif.id as noteId')
                ->from('notifications_calls as notif')
                ->join('payment_schedule as sch','notif.installmentId = sch.id',"left outer")
                ->join('notification_types as n_type','notif.notification_type = n_type.id','left outer')
                ->join('subjects as s','notif.subjectId = s.id')
                ->join('subject_reference as ref','s.referenceId = ref.id')
                ->where(array(
                    'notif.robo_call' => '1',
                    'notif.status'=>1,
                    's.status'=>1,
                    's.is_deleted'=>0,
                ));

        $query = $this->db->get();
        $result= $query->result_array();
        return $result;

}

    function subjectNotificationHistory($subjectId) {

        $this->db->select('notif.comments as comment,notif.response_date,n_type.name as nType,notif.installmentId as insId,sch.month as month,sch.year as year,notif.id as noteId')
                ->from('notification_history as notif')
                ->join('payment_schedule as sch','notif.installmentId = sch.id',"left outer")
                ->join('notification_types as n_type','notif.notification_type = n_type.id','left outer')
                ->join('subjects as s','notif.subjectId = s.id')
                ->where(array(
                    's.id'=>$subjectId,
                    's.status'=>1,
                    's.is_deleted'=>0,
                ));

        $query = $this->db->get();
        $result= $query->result_array();
        return $result;

    }
    function getAllRecords($notification_id) {
    $this->db->select('sbj.*,st.name as state,us.firstName,us.lastName')

             ->from('notifications as notif')
             ->join('subjects as sbj','sbj.id=notif.subjectId',"left outer")
             ->join('subject_state as st','sbj.state = st.id')
             ->join('subject_activity as sact','sbj.id = sact.subjectId ','left outer')
             ->join('users as us','sact.done_by = us.id ','left outer')

             ->where(array(
               'sbj.is_deleted'=>0,
                'notif.status'=>1,
                'notif.notification_type'=>$notification_id

            ));
    $query = $this->db->get();
                return $query->result_array();

}

    function getExtension(){

    }


}
