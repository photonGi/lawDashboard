<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_admin extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('ft_userId')!='' && $this->uri->segment(2)!="userlogout")
        { 
            $result=checkModulePermission(1);
            if($result==TRUE){
                $this->load->model('generic_model');
                $this->load->model('backend/admin_model');
            }
        }
        else{
            redirect ('');
        }
    }

    public function index()            
    { 
        if ($this->session->flashdata('success') != ""){
        $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
           $data['errors'] = $this->session->flashdata('errors');
        }
        $data["dataArr"]=$this->admin_model->getAdmins();
        $data['title'] ='Administration';
        $data['heading'] ='Administration :';
        $data["page"]='backend/admin/list';
        $this->load->view('backend/main',$data);
        
    }
    
    public function view()            
    {
        if ($this->session->flashdata('success') != ""){
        $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
           $data['errors'] = $this->session->flashdata('errors');
        }
        $data['roleArr']=$this->generic_model->getAllRecords("roles",array("status"=>1,"id !="=>1),"id","ASC");
        $data['heading'] = 'Create Admin:';
        $data["page"]='backend/admin/form';
        $this->load->view('backend/main',$data);
        
    }
    
    public function add()            
    {
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password','Password', 'trim|required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required');
        
       
        if ($this->form_validation->run() == FALSE)
        {   
            $data = array();
            $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
            $data['result']=$this->input->post();
            redirect("admin/addAdmin");
        }
        else
        {
            if($this->_checkEmail($this->input->post('email'))== FALSE)
            {
                $data = array();
                $email=$this->input->post('email');
                $data['errors'] = $this->session->set_flashdata('errors', $this->input->post('email').", This Email Address Already exists, Try Another one");
                $data['result']=$this->input->post();
                redirect('admin/addAdmin');
            
            }
            
            $email = strtolower($this->input->post('email'));
            
            //No Errors
            date_default_timezone_set("Asia/Karachi");
            $data["roleId"]=2;
            $data["firstName"]=$this->input->post('firstName');
            $data["lastName"]=$this->input->post('lastName');
            $data["email"]=$email;
            $data["password"]=md5($this->input->post('password'));
            $data["phone"]=$this->input->post('phone');
            $data["status"]=$this->input->post('status');
            $data["createdAt"]=date("Y-m-d h:i:sa");
            $data["createdBy"]=$this->session->userdata("ft_userId");
            $data["modifiedAt"]=date("Y-m-d h:i:sa");
            $id=$this->generic_model->insert("users",$data);
            //Upload Image
            if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $fileName = uniqid();
                $ext= explode('.', $_FILES['image']['name']);
                $ext = end($ext);
                upload_image("uploads/admin", "gif|jpg|png|jpeg", "image", $fileName);
                $profile_pic= "uploads/admin/" . $fileName . ".$ext";
                $this->generic_model->updateRecord("users",array("profile_pic"=>$profile_pic),array('id'=>$id));
            }
            $this->_addPermissions($id);
            $this->session->set_flashdata('success', "Admin has been added successfully.");
        }
        redirect('admin/listAdmin');
    }
    
    public function edit()            
    {
        
        $adminId=decode_uri($this->uri->segment(3));
        if(is_numeric($adminId) && !empty($adminId))
        {
        
            $data['title'] = 'Edit Admin Information';
            $data['heading'] = 'Edit Admin Information:';
            $data["page"]='backend/admin/form';
             $data["result"]=  $this->admin_model->getSpecificAdmin($adminId);
            $this->load->view('backend/main',$data);
        }
        else {$this->session->set_flashdata('errors', 'Refference Error, Please try again later');
        redirect('admin/addAdmin');
        }
    }
    
    public function update()            
    {
        $adminId = decode_uri($this->uri->segment(3));
       
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        
       
        if ($this->form_validation->run() == FALSE)
        {        
            $data = array();
            $data['errors'] = validation_errors();
            redirect("admin/editAdmin/".$this->uri->segment(3));
        }
        else
        {
            //No Errors
            
            date_default_timezone_set("Asia/Karachi");
            $data["firstName"]=$this->input->post('firstName');
            $data["lastName"]=$this->input->post('lastName');
            $data["email"]=$this->input->post('email');
            $data["phone"]=$this->input->post('phone');
            $data["status"]=$this->input->post('status');
            $data["modifiedBy"]=$this->session->userdata("ft_userId");
            $data["modifiedAt"]=date("Y-m-d h:i:sa");
            $this->generic_model->updateRecord("users",$data, array("id"=>$adminId));
            if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $userInfo=$this->generic_model->getSpecificRecord("users",array("id" =>$adminId));
                if(!empty($userInfo["profile_pic"])){unlink($userInfo["profile_pic"]);}
                
                $fileName = uniqid();
                $ext= explode('.', $_FILES['image']['name']);
                $ext = end($ext);
                upload_image("uploads/admin", "gif|jpg|png|jpeg", "image", $fileName);
                $profile_pic= "uploads/admin/" . $fileName . ".$ext";
                $this->generic_model->updateRecord("users",array("profile_pic"=>$profile_pic),array('id'=>$adminId));
            }
            $this->_addPermissions($adminId);
            $this->session->set_flashdata('success', "Admin has been updated successfully.");
        }
        
        redirect("admin/listAdmin");
    }
    
    public function delete()             
    {
            
           
           $adminId = decode_uri($this->uri->segment(3));
           
           if (is_numeric($adminId) && !empty($adminId))
           {
             //  $delete = $this->generic_model->delete("users", array("id"=>$adminId));
               $delete = $this->generic_model->updateRecord("users", array('is_deleted'=>1,'status'=>0),array("id"=>$adminId));
              
               if ($delete)
               {
                   $this->session->set_flashdata('success', "Admin has been removed successfully.");
               }
               else 
               {
                   $this->session->set_flashdata('errors', 'An error occurred, try later.');
              
               }
               redirect('admin/listAdmin');
           }
           else{
               $this->session->set_flashdata('errors', 'Refference Error, try later.');
           redirect('admin/listAdmin');}
        
    }
    
    private function _addPermissions($userId)
    {
        $id=$this->generic_model->delete("permissions",array("userId"=>$userId));
        $moduleArr=$this->_getModule();
        foreach($moduleArr as $module)
        {
            $add=$edit=$delete=$all="";
            $moduleId=$module["id"];
           
            $this->input->post("add_$moduleId")==1?$add=1:$add=0;
            $this->input->post("edit_$moduleId")==1?$edit=1:$edit=0;
            $this->input->post("delete_$moduleId")==1?$delete=1:$delete=0;
            $this->input->post("all_$moduleId")==1?$all=1:$all=0;
           
            if($add==1 || $edit==1 || $delete==1 || $all==1)
            {
                
                $data=array();
                $data["userId"]=$userId;
                $data["moduleId"]=$moduleId;
                $data["add_permission"]=$add;
                $data["edit_permission"]=$edit;
                $data["delete_permission"]=$delete;
                $data["all_permission"]=$all;
                $id=$this->generic_model->insert("permissions",$data);
            }
        }
       
    }
    
    private function _checkEmail($email)            
    {
        $result=$this->generic_model->getSpecificRecord("users",array("email"=>$email));
        if($result == FALSE){return TRUE;}
        else {return FALSE;}
    }
    
     private function _getModule()             
    {
        return $this->generic_model->getAllRecords("system_modules",array(
          //  "has_dropdown"=>"0",
            "status"=>"1"
            ),"id","asc");
    }
    
     private function _getsubModule($parent)
    {
        return $this->generic_model->getAllRecords("system_modules",array(
           "parentId"=>$parent,
            "status"=>"1"
            ),"id","asc");
    }
    
    
    public function changeStatus()
    {
    	$iId = decode_uri($this->uri->segment(3));
    	$status = decode_uri($this->uri->segment(4));
    	 
    	$data["status"]=$status;
    	$id=$this->generic_model->updateRecord("users",$data, array("id"=>$iId));
    
    	redirect("admin/listAdmin");
    }
    
   
    
}
