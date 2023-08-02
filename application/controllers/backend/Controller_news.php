<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_news extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('ft_userId')!='' && $this->uri->segment(1)!="userlogout" ){
          $this->load->model('generic_model'); }
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

      $data['news'] = $this->generic_model->getAllRecords('news',array('is_deleted'=>0),"newsId","DESC");

      $data['heading'] = 'News';
      $data['title'] = 'News';
      $data['page'] = 'backend/news/list';
    $this->load->view('backend/main', $data);
  }

  public function view(){
    $data = array();
    if ($this->session->flashdata('success') != ""){
      $data['success'] = $this->session->flashdata('success');
    }
    if ($this->session->flashdata('errors') != ""){
      $data['errors'] = $this->session->flashdata('errors');
    }
    $data['news']=$this->generic_model->getAllRecords("news",array("status"=>1,"is_deleted" => 0),"newsId","ASC");
    $data['heading'] = 'Add News';
    $data['title'] = 'Add News';
    $data['page'] = 'backend/news/form';
    $this->load->view('backend/main', $data);
  }

    public function add(){
  
    $this->form_validation->set_rules('newsTitle','Title','trim|required');
    $this->form_validation->set_rules('newsDescription','Description','trim|required');
   
    if ($this->form_validation->run()==FALSE) {
      $data = array();
      $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
      redirect('admin/newsList'); 
    }

    $data["newsTitle"]=$this->input->post('newsTitle');
    $data["newsUrl"]=strtolower(trim($this->input->post('newsTitle')));
    $data["newsDescription"]=$this->input->post('newsDescription');
    $data["createdAt"]=date('Y-m-d h:i:sa');
    $data["createdBy"]=$this->session->userdata('ft_userId');
    $data["status"] = 1;
    //image uploading code
        if(isset($_FILES['files'])){
             $extension=array("jpeg","jpg","png","gif");
             $file_name=$_FILES["files"]["name"];
             $file_tmp=$_FILES["files"]["tmp_name"];
             $ext=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
              if(in_array($ext,$extension))
        {
          $file_name=rand(5,100)."_".rand(100000,9999999)."_".rand(100000,9999999).".".$ext;
          $data['nImage']="uploads/news/".$file_name;
          $home_slide="uploads/news/".$file_name;
          home_slider($file_tmp, $home_slide, 1366,841);
        }
}
    $addData = $this->generic_model->insert("news", $data);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }redirect('admin/newsList');
  }

  public function edit(){
    $id= decode_uri($this->uri->segment(3));
    $data['result']=$this->generic_model->getSpecificRecord("news",array("newsId"=>$id));

    $data['heading'] = 'Edit News';
    $data['title'] = 'Edit News';
    $data['page'] = 'backend/news/form';
    $this->load->view('backend/main', $data);
  }

    public function update(){
    $id = decode_uri($this->uri->segment(3));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('newsTitle','Title','trim|required');
    $this->form_validation->set_rules('newsDescription','Description','trim|required');
    
    if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/newsList');
    }
    $record=$this->generic_model->getSpecificRecord('news',array('newsId'=>$id));
    $data["newsTitle"]=$this->input->post('newsTitle');
    $data["newsUrl"]=strtolower(trim($this->input->post('newsTitle')));
    $data["newsDescription"]=$this->input->post('newsDescription');
    $data["modifiedAt"]=date('Y-m-d h:i:sa');
    $data["modifiedBy"]=$this->session->userdata('ft_userId');
    //image uploading code
        if(isset($_FILES['files'])){
             $extension=array("jpeg","jpg","png","gif");
             $file_name=$_FILES["files"]["name"];
             $file_tmp=$_FILES["files"]["tmp_name"];
             $ext=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
              if(in_array($ext,$extension)){
          $file_name=rand(5,100)."_".rand(100000,9999999)."_".rand(100000,9999999).".".$ext;
          $home_slide="uploads/news/".$file_name;
          $this->deleteIt($record['nImage']);
          home_slider($file_tmp, $home_slide, 1366,841);
          $data['nImage']="uploads/news/".$file_name; } }
    $upId = $this->generic_model->updateRecord("news", $data, array("newsId"=>$id));
    if ($upId){
      $this->session->set_flashdata('success', "Updated Successfully.");}
    else {
     $this->session->set_flashdata('errors', "Error While Adding Data");
    }
   redirect('admin/newsList');
  }

  public function delete(){
      $id= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;

      $deleted = $this->generic_model->updateRecord("news", $data, array("newsId"=>$id));
      if ($deleted){
      $deleted_record=$this->generic_model->getSpecificRecord('news',array('newsId'=>$id));

      $this->session->set_flashdata('success', "Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/newsList');
    }
    private function deleteIt($file) {
if(file_exists($file) && is_file($file)) {
unlink($file);
return true;
}}

private function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}



}

?>