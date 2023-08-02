<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controller_events extends CI_Controller {
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

      $data['events'] = $this->generic_model->getAllRecords('events',array('is_deleted'=>0),"eId","DESC");

      $data['heading'] = 'Events';
      $data['title'] = 'Events';
      $data['page'] = 'backend/events/list';
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
    $data['courses']=$this->generic_model->getAllRecords("courses",array("status"=>1,"is_deleted" => 0),"courseId","ASC");
    $data['heading'] = 'Add Event';
    $data['title'] = 'Add Event';
    $data['page'] = 'backend/events/form';
    $this->load->view('backend/main', $data);
  }

  public function addEvent(){
    
    $this->load->library('form_validation');
    $this->form_validation->set_rules('course','Course','trim|required');
    $this->form_validation->set_rules('company','Company','trim|required');
    $this->form_validation->set_rules('city','City','trim|required');
    $this->form_validation->set_rules('event_country','Event Country','trim|required');
    $this->form_validation->set_rules('course_lang','Course Language','trim|required');
    $this->form_validation->set_rules('instructions_lang','Instructions Language','trim|required');
    $this->form_validation->set_rules('from_','From','trim|required');
    $this->form_validation->set_rules('to_','To','trim|required');
    $this->form_validation->set_rules('event_status','Event Status','trim|required');
    /*$this->form_validation->set_rules('detail','Detail','trim|required');*/
    
    if ($this->form_validation->run()==FALSE) {
                $data = array();
                $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/eventsList'); }

    $data["course"]=$this->input->post('course');
    $data["company"]=$this->input->post('company');
    $data["city"]=$this->input->post('city');
    $data["event_country"]=$this->input->post('event_country');
    $data["course_lang"]=$this->input->post('course_lang');
    $data["instructions_lang"]=$this->input->post('instructions_lang');
    $data["from_"]=$this->input->post('from_');
    $data["to_"]=$this->input->post('to_');
    $data["event_status"]=$this->input->post('event_status');
    /*$data["detail"]=$this->input->post('detail');*/

    $data["createdAt"]=date('Y-m-d h:i:sa');
    $data["createdBy"]=$this->session->userdata('ft_userId');
    $data["modifiedAt"]=date('Y-m-d h:i:sa');
    $data["modifiedBy"]=$this->session->userdata('ft_userId');
    $data["status"] = 1;
    
    $addData = $this->generic_model->insert("events", $data);
    if ($addData){
      $this->session->set_flashdata('success', "Added Successfully.");
    } else {
     $this->session->set_flashdata('error', "Error While Adding Data");
    }redirect('admin/eventsList');
  }

  public function edit(){
    $id= decode_uri($this->uri->segment(3));
    $data['result']=$this->generic_model->getSpecificRecord("events",array("eId"=>$id));

    $data['crs']=$this->generic_model->getAllRecords("courses",array("status"=>1,"is_deleted" => 0),"courseId","ASC");

    $data['courses']=$this->generic_model->getAllRecords("courses",array("status"=>1,"is_deleted" => 0),"courseId","ASC");

    $data['heading'] = 'Edit Event';
    $data['title'] = 'Edit Event';
    $data['page'] = 'backend/events/form';
    $this->load->view('backend/main', $data);
  }

  public function update(){
    $id = decode_uri($this->uri->segment(3));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('course','Course','trim|required');
    $this->form_validation->set_rules('company','Company','trim|required');
    $this->form_validation->set_rules('city','City','trim|required');
    $this->form_validation->set_rules('event_country','Event Country','trim|required');
    $this->form_validation->set_rules('course_lang','Course Language','trim|required');
    $this->form_validation->set_rules('instructions_lang','Instructions Language','trim|required');
    $this->form_validation->set_rules('from_','From','trim|required');
    $this->form_validation->set_rules('to_','To','trim|required');
    $this->form_validation->set_rules('event_status','Event Status','trim|required');
    /*$this->form_validation->set_rules('detail','Detail','trim|required');*/
   
    
    if ($this->form_validation->run()==FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/eventsList');
    }
    
    $record=$this->generic_model->getSpecificRecord('events',array('eId'=>$id));

    $data["course"]=$this->input->post('course');
    $data["company"]=$this->input->post('company');
    $data["city"]=$this->input->post('city');
    $data["event_country"]=$this->input->post('event_country');
    $data["course_lang"]=$this->input->post('course_lang');
    $data["instructions_lang"]=$this->input->post('instructions_lang');
    $data["from_"]=$this->input->post('from_');
    $data["to_"]=$this->input->post('to_');
    $data["event_status"]=$this->input->post('event_status');
    $data["modifiedAt"]=date('Y-m-d h:i:sa');
    $data["modifiedBy"]=$this->session->userdata('ft_userId');

    $upId = $this->generic_model->updateRecord("events", $data, array("eId"=>$id));
    if ($upId){
      $this->session->set_flashdata('success', "Updated Successfully.");}
    else {
     $this->session->set_flashdata('errors', "Error While Adding Data");
    }
   redirect('admin/eventsList');
  }

  public function delete(){
      $id= decode_uri($this->uri->segment(3));

      $data['is_deleted'] = 1;

      $deleted = $this->generic_model->updateRecord("events", $data, array("eId"=>$id));
      if ($deleted){
      $deleted_record=$this->generic_model->getSpecificRecord('events',array('eId'=>$id));
      
      //$this->deleteIt("assets/slides/latest_news_slides/".$deleted_record['image']);
      //$this->deleteIt("assets/slides/detail_slides/".$deleted_record['image']);

      $this->session->set_flashdata('success', "Event Deleted Successfully");
      }else {
        $this->session->set_flashdata('error', "An Error Occured");
      }
      redirect('admin/eventsList');
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