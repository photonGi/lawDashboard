<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_certificate extends CI_Controller {

    protected $page = 'backend/certificate/';

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('ft_userId') != '' && $this->uri->segment(2) != "userlogout") {
            $this->load->model('generic_model');
                                         
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
        $data['dataArr'] = $this->generic_model->getAllRecords('categories', array('is_deleted' => 0), "catId", "desc");
        $data['title'] = 'Categories';
        $data['heading'] = 'Categories';
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
        $data['heading'] = 'Add Category';
        $data['title'] = 'Add Category';
        $data['page'] = 'backend/certificate/form';
        $this->load->view('backend/main', $data);
    }

    public function add(){
  
    $this->form_validation->set_rules('catTitle','Title','trim|required');
   
    if ($this->form_validation->run()==FALSE) {
                $data = array();
                $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listCategories'); }
    $data["catTitle"]=strtoupper(trim($this->input->post('catTitle')));
    $data["catUrl"]=strtolower(str_replace(" ","-",$this->input->post('catTitle')));
    $data["createdAt"]=date('Y-m-d h:i:sa');
    $data["createdBy"]=$this->session->userdata('ft_userId');
    $data["status"] = $this->input->post('status');
    
    $addData = $this->generic_model->insert("categories", $data);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }redirect('admin/listCategories');
  }

  public function edit() {
        $id = decode_uri($this->uri->segment("3"));
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        if ($id) {
            $data['result'] = $this->generic_model->getSpecificRecord('categories', array('catId' => $id));
            $data['heading'] = 'Category - Edit';
            $data['title'] = 'Category - Edit';
            $data['page'] = 'backend/certificate/form';
            $this->load->view('backend/main', $data);
        } else {
            $data['errors'] = $this->session->set_flashdata('errors', "Reference Error");
            redirect("admin/listCategories");
        }
    }

    public function update(){
    $id = decode_uri($this->uri->segment(3));
    
    $this->form_validation->set_rules('catTitle','Title','trim|required');
    
    if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listCategories');
    }
   
    $data["catTitle"]=strtoupper(trim($this->input->post('catTitle')));
    $data["catUrl"]=strtolower(str_replace(" ","-",$this->input->post('catTitle')));
    $data["modifiedAt"]=date('Y-m-d h:i:sa');
    $data["modifiedBy"]=$this->session->userdata('ft_userId');
    $data["status"] = $this->input->post('status');
    
    $upId = $this->generic_model->updateRecord("categories", $data, array("catId"=>$id));
    if ($upId){
      $this->session->set_flashdata('success', "Updated Successfully.");}
    else {
     $this->session->set_flashdata('errors', "Error While Adding Data");
    }
   redirect('admin/listCategories');
  }

  public function delete(){
      $id= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;
      $data["modifiedAt"]=date("Y-m-d h:i:sa");
      $data['modifiedBy'] = $this->session->userdata('ft_userId');

      $deleted = $this->generic_model->updateRecord("categories", $data, array("catId"=>$id));
      if ($deleted){
     
      $this->session->set_flashdata('success', "Category Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/listCategories');
    }
     public function certificates() {
        $id = decode_uri($this->uri->segment("3"));
       
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        $cat = decode_uri($this->uri->segment(3));
        $data['dataArr'] = $this->generic_model->getAllRecords('certificates', array('is_deleted' => 0,'catId'=>$cat), "cid", "desc");
        $data['title'] = strtoupper(str_replace("-"," ",$this->uri->segment(4)));
        $data['heading'] = strtoupper(str_replace("-"," ",$this->uri->segment(4)));
        $data['page'] = $this->page . 'certificates';
        $this->load->view('backend/main', $data);
    }
      public function addCertificate() {
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        $data['heading'] = 'Add Certificate';
        $data['title'] = 'Add Certificate';
        $data['page'] = 'backend/certificate/formCertificate';
        $this->load->view('backend/main', $data);
    }
      public function saveCertificate(){
  
   
    $this->form_validation->set_rules('cTitle','Title','trim|required');
     $this->form_validation->set_rules('shortDescription','Title','trim|required');
    
   
    if ($this->form_validation->run()==FALSE) {
                $data = array();
                $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4)); }
    $data["cTitle"]=strtoupper(trim($this->input->post('cTitle')));
    $data["cUrl"]=strtolower(str_replace(" ","-",$this->input->post('cTitle')));
     $data["catId"]=decode_uri($this->uri->segment(3));
     $data["shortDescription"]=$this->input->post('shortDescription');
      $data["cDescription"]=$this->input->post('cDescription');
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
          $data['cImage']="uploads/certificates/".$file_name;
          $home_slide="uploads/certificates/".$file_name;
          home_slider($file_tmp, $home_slide, 300,300);
        }
}

    $addData = $this->generic_model->insert("certificates", $data);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }
     redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
  }

  public function editCertificate() {
        $id = decode_uri($this->uri->segment("5"));
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        if ($id) {
            $data['result'] = $this->generic_model->getSpecificRecord('certificates', array('cid' => $id));
            $data['heading'] = 'Certificate - Edit';
            $data['title'] = 'Certificate - Edit';
            $data['page'] = 'backend/certificate/formCertificate';
            $this->load->view('backend/main', $data);
        } else {
            $data['errors'] = $this->session->set_flashdata('errors', "Reference Error");
             redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
        }
    }

    public function updateCertificate(){
    $id = decode_uri($this->uri->segment(5));
    
    $this->form_validation->set_rules('cTitle','Title','trim|required');
     $this->form_validation->set_rules('shortDescription','Title','trim|required');
    
    if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
    }
     $record=$this->generic_model->getSpecificRecord('certificates',array('cid'=>$id));
    $data["cTitle"]=strtoupper(trim($this->input->post('cTitle')));
    $data["cUrl"]=strtolower(str_replace(" ","-",$this->input->post('cTitle')));
     $data["catId"]=decode_uri($this->uri->segment(3));
     $data["shortDescription"]=$this->input->post('shortDescription');
      $data["cDescription"]=$this->input->post('cDescription');
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
          $home_slide="uploads/certificates/".$file_name;
          $this->deleteIt($record['cImage']);
          home_slider($file_tmp, $home_slide, 400,400);
          $data['cImage']="uploads/certificates/".$file_name; } }
    $upId = $this->generic_model->updateRecord("certificates", $data, array("cid"=>$id));
    if ($upId){
      $this->session->set_flashdata('success', "Updated Successfully.");}
    else {
     $this->session->set_flashdata('errors', "Error While Adding Data");
    }
   redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
  }

  public function deleteCertificate(){
     $id= decode_uri($this->uri->segment(5));

      $data['is_deleted'] = 1;
      $data["modifiedAt"]=date("Y-m-d h:i:sa");
      $data['modifiedBy'] = $this->session->userdata('ft_userId');

      $deleted = $this->generic_model->updateRecord("certificates", $data, array("cid"=>$id));
      if ($deleted){
      $deleted_record=$this->generic_model->getSpecificRecord('certificates',array('cid'=>$id));
      
      $this->deleteIt($deleted_record['cImage']);
      $this->session->set_flashdata('success', " Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
       redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
    }
     public function listCourses() {
        $id = decode_uri($this->uri->segment("3"));
       
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        $cat = decode_uri($this->uri->segment(3));
        $data['dataArr'] = $this->generic_model->getAllRecords('courses', array('is_deleted' => 0,'courseId'=>$cat), "cid", "desc");
        $data['title'] = strtoupper(str_replace("-"," ",$this->uri->segment(4)));
        $data['heading'] = strtoupper(str_replace("-"," ",$this->uri->segment(4)));
        $data['page'] = $this->page . 'courses';
        $this->load->view('backend/main', $data);
    }
      public function addCourse() {
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        $data['heading'] = 'Add Certificate';
        $data['title'] = 'Add Certificate';
        $data['page'] = 'backend/certificate/formCertificate';
        $this->load->view('backend/main', $data);
    }
      public function saveCourse(){
  
   
    $this->form_validation->set_rules('cTitle','Title','trim|required');
     $this->form_validation->set_rules('shortDescription','Title','trim|required');
    
   
    if ($this->form_validation->run()==FALSE) {
                $data = array();
                $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4)); }
    $data["cTitle"]=strtoupper(trim($this->input->post('cTitle')));
    $data["cUrl"]=strtolower(str_replace(" ","-",$this->input->post('cTitle')));
     $data["catId"]=decode_uri($this->uri->segment(3));
     $data["shortDescription"]=$this->input->post('shortDescription');
      $data["cDescription"]=$this->input->post('cDescription');
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
          $data['cImage']="uploads/certificates/".$file_name;
          $home_slide="uploads/certificates/".$file_name;
          home_slider($file_tmp, $home_slide, 300,300);
        }
}

    $addData = $this->generic_model->insert("certificates", $data);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }
     redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
  }

  public function editCourse() {
        $id = decode_uri($this->uri->segment("5"));
        $data = array();
        if ($this->session->flashdata('success') != "") {
            $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != "") {
            $data['errors'] = $this->session->flashdata('errors');
        }
        if ($id) {
            $data['result'] = $this->generic_model->getSpecificRecord('certificates', array('cid' => $id));
            $data['heading'] = 'Certificate - Edit';
            $data['title'] = 'Certificate - Edit';
            $data['page'] = 'backend/certificate/formCertificate';
            $this->load->view('backend/main', $data);
        } else {
            $data['errors'] = $this->session->set_flashdata('errors', "Reference Error");
             redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
        }
    }

    public function updateCourse(){
    $id = decode_uri($this->uri->segment(5));
    
    $this->form_validation->set_rules('cTitle','Title','trim|required');
     $this->form_validation->set_rules('shortDescription','Title','trim|required');
    
    if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
    }
     $record=$this->generic_model->getSpecificRecord('certificates',array('cid'=>$id));
    $data["cTitle"]=strtoupper(trim($this->input->post('cTitle')));
    $data["cUrl"]=strtolower(str_replace(" ","-",$this->input->post('cTitle')));
     $data["catId"]=decode_uri($this->uri->segment(3));
     $data["shortDescription"]=$this->input->post('shortDescription');
      $data["cDescription"]=$this->input->post('cDescription');
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
          $home_slide="uploads/certificates/".$file_name;
          $this->deleteIt($record['cImage']);
          home_slider($file_tmp, $home_slide, 400,400);
          $data['cImage']="uploads/certificates/".$file_name; } }
    $upId = $this->generic_model->updateRecord("certificates", $data, array("cid"=>$id));
    if ($upId){
      $this->session->set_flashdata('success', "Updated Successfully.");}
    else {
     $this->session->set_flashdata('errors', "Error While Adding Data");
    }
   redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
  }

  public function deleteCourse(){
     $id= decode_uri($this->uri->segment(5));

      $data['is_deleted'] = 1;
      $data["modifiedAt"]=date("Y-m-d h:i:sa");
      $data['modifiedBy'] = $this->session->userdata('ft_userId');

      $deleted = $this->generic_model->updateRecord("certificates", $data, array("cid"=>$id));
      if ($deleted){
      $deleted_record=$this->generic_model->getSpecificRecord('certificates',array('cid'=>$id));
      
      $this->deleteIt($deleted_record['cImage']);
      $this->session->set_flashdata('success', " Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
       redirect('admin/listCertificates/'.$this->uri->segment(3)."/".$this->uri->segment(4));
    }
  private function deleteIt($file) {
  if(file_exists($file) && is_file($file)) {
   unlink($file);
   return true;
  }}
  

}