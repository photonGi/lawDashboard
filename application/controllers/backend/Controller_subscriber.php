<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_subscriber extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('ft_userId')!='' && $this->uri->segment(1)!="userlogout" )
        {
          $this->load->model('generic_model');
        }else{
          redirect ('admin');
        }
    }
  
  public function index(){
    $data = array();
    if ($this->session->flashdata('success') != ""){
      $data['success'] = $this->session->flashdata('success');
    }
    if ($this->session->flashdata('errors') != ""){
      $data['errors'] = $this->session->flashdata('errors');
    }
    $data['subscribers'] = $this->generic_model->getAllRecords('subscribers',array('is_deleted'=>0),'subId','ASC');
    $data['heading'] = 'Subscribers';
    $data['title'] = 'Subscribers';
    $data['page'] = 'backend/subscribers/list';
    $this->load->view('backend/main', $data);

  }


  public function delete(){
      $infoId= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;

      $deleted = $this->generic_model->updateRecord("subscribers", $data, array("subId"=>$infoId));
      if ($deleted){

        $this->session->set_flashdata('success', "Subscriber Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/listSubscribers');
    }

public function contactqueries(){
    $data = array();
    if ($this->session->flashdata('success') != ""){
      $data['success'] = $this->session->flashdata('success');
    }
    if ($this->session->flashdata('errors') != ""){
      $data['errors'] = $this->session->flashdata('errors');
    }
    $data['queries'] = $this->generic_model->getAllRecords('contact',array('is_deleted'=>0),'contactId','ASC');
    $data['heading'] = 'Contact Queries';
    $data['title'] = 'Contact Queries';
    $data['page'] = 'backend/subscribers/queries';
    $this->load->view('backend/main', $data);

  }


  public function deleteMessage(){
      $infoId= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;

      $deleted = $this->generic_model->updateRecord("contact", $data, array("contactId"=>$infoId));
      if ($deleted){

        $this->session->set_flashdata('success', "Message Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/contactqueries');
    }
    public function listSweep(){
    $data = array();
    if ($this->session->flashdata('success') != ""){
      $data['success'] = $this->session->flashdata('success');
    }
    if ($this->session->flashdata('errors') != ""){
      $data['errors'] = $this->session->flashdata('errors');
    }
    $data['sweeps'] = $this->generic_model->getAllRecords('sweep',array('is_deleted'=>0),'sweepId','ASC');
    $data['heading'] = 'Sweep Requests';
    $data['title'] = 'Sweep Requests';
    $data['page'] = 'backend/sweep/list';
    $this->load->view('backend/main', $data);

  }


  public function deleteSweep(){
      $infoId= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;

      $deleted = $this->generic_model->updateRecord("sweep", $data, array("sweepId"=>$infoId));
      if ($deleted){

        $this->session->set_flashdata('success', "Sweep Request is Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/listSweep');
    }

}

?>