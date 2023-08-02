<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_slider extends CI_Controller {

    protected $page = 'backend/slider/';

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('ft_userId') != '' && $this->uri->segment(2) != "userlogout") {
            $this->load->model('generic_model');
              $this->load->library('form_validation');                                    
        } else {
            redirect('admin/login');
        }
    }

    public function index() {
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        $data['dataArr'] = $this->generic_model->getAllRecords('slider', array('is_deleted' => 0), "slideId", "desc");
        $data['title'] = 'Slider';
        $data['heading'] = 'Slider';
        $data['page'] = $this->page . 'list';
        $this->load->view('backend/main', $data);
    }

    public function view() {
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        $data['heading'] = 'Add Slides';
        $data['title'] = 'Slides';
        $data['page'] = 'backend/slider/form';
        $this->load->view('backend/main', $data);
    }

    public function add(){
  
    $this->form_validation->set_rules('alterText','Alt Text','trim|required');
   
    if ($this->form_validation->run()==FALSE) {
                $data = array();
                $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listSliders'); }
    $data["alterText"]=strtolower(trim($this->input->post('alterText')));
    $data["orderImage"]=$this->input->post('orderImage');
    $data["createdAt"]=date('Y-m-d h:i:sa');
    $data["createdBy"]=$this->session->userdata('ft_userId');
    $data["status"] = $this->input->post('status');
    //image uploading code
        if(isset($_FILES['files'])){
             $extension=array("jpeg","jpg","png","gif");
             $file_name=$_FILES["files"]["name"];
             $file_tmp=$_FILES["files"]["tmp_name"];
             $ext=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
              if(in_array($ext,$extension))
        {
          $file_name=rand(5,100)."_".rand(100000,9999999)."_".rand(100000,9999999).".".$ext;
          $data['slideImage']="uploads/slider/".$file_name;
          $home_slide="uploads/slider/".$file_name;
          home_slider($file_tmp, $home_slide, 1366,841);
        }
}
    $addData = $this->generic_model->insert("slider", $data);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }redirect('admin/listSliders');
  }

  public function edit() {
        $columnID = decode_uri($this->uri->segment("3"));
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        if ($columnID) {
            $data['result'] = $this->generic_model->getSpecificRecord('slider', array('slideId' => $columnID));
            $data['heading'] = 'Slider- Edit';
            $data['title'] = 'Slider- Edit';
            $data['page'] = 'backend/slider/form';
            $this->load->view('backend/main', $data);
        } else {
            $data['errors'] = $this->session->set_flashdata('errors', "Reference Error");
            redirect("admin/listSliders");
        }
    }

    public function update(){
    $id = decode_uri($this->uri->segment(3));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('alterText','Alter Text','trim|required');
    
    if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listSliders');
    }
    $record=$this->generic_model->getSpecificRecord('slider',array('slideId'=>$id));
     $data["alterText"]=strtolower(trim($this->input->post('alterText')));
     $data["orderImage"]=$this->input->post('orderImage');
    $data["modifiedAt"]=date('Y-m-d h:i:sa');
    $data["modifiedBy"]=$this->session->userdata('ft_userId');
    $data["status"] = $this->input->post('status');
    //image uploading code
        if(isset($_FILES['files'])){
             $extension=array("jpeg","jpg","png","gif");
             $file_name=$_FILES["files"]["name"];
             $file_tmp=$_FILES["files"]["tmp_name"];
             $ext=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
              if(in_array($ext,$extension)){
          $file_name=rand(5,100)."_".rand(100000,9999999)."_".rand(100000,9999999).".".$ext;
          $home_slide="uploads/slider/".$file_name;
          $this->deleteIt($record['image']);
          home_slider($file_tmp, $home_slide, 1366,841);
          $data['slideImage']="uploads/slider/".$file_name; } }
    $upId = $this->generic_model->updateRecord("slider", $data, array("slideId"=>$id));
    if ($upId){
      $this->session->set_flashdata('success', "Updated Successfully.");}
    else {
     $this->session->set_flashdata('errors', "Error While Adding Data");
    }
   redirect('admin/listSliders');
  }

  public function delete(){
      $id= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;
      $data["modifiedAt"]=date("Y-m-d h:i:sa");
      $data['modifiedBy'] = $this->session->userdata('ft_userId');

      $deleted = $this->generic_model->updateRecord("slider", $data, array("slideId"=>$id));
      if ($deleted){
      $deleted_record=$this->generic_model->getSpecificRecord('slider',array('slideId'=>$id));
      
      $this->deleteIt($deleted_record['sliderImage']);
      $this->session->set_flashdata('success', "Slide Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/listSliders');
    }

  private function deleteIt($file) {
  if(file_exists($file) && is_file($file)) {
   unlink($file);
   return true;
  }}

}