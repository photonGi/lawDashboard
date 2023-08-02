<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_enrollments extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('ft_userId')!='' && $this->uri->segment(1)!="userlogout" ){
          $this->load->model('generic_model'); 
        }
        else{ redirect ('admin'); }
    }

  public function index(){
    $data = array();
    if ($this->session->flashdata('success') != ""){
      $data['success'] = $this->session->flashdata('success');
    }
    if ($this->session->flashdata('errors') != ""){
      $data['errors'] = $this->session->flashdata('errors');
    }

      $data['enrollments'] = $this->generic_model->getResults("Select * from event_enrollment");

      $data['heading'] = 'Enrollments';
      $data['title'] = 'Enrollments';
      $data['page'] = 'backend/enrollments/list';
    $this->load->view('backend/main', $data);
  }

    public function enrollments(){

/*      echo "Usman"; die();*/

      $data['event'] = $this->generic_model->getAllRecords('events',array('is_deleted'=>0),"eId","DESC");
      $data['user'] = $this->generic_model->getAllRecords('appUsers',array('is_deleted'=>0),"uId","DESC");

        $d = date('Y-m-d H:i:s');

        $arr["eeid"]=1;
        $arr["userId"]=1;
        $arr["registrationDate"]= $d;

      $addData = $this->generic_model->insert("event_enrollment", $arr);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }redirect('trainingevents');
  }
}