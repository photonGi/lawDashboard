<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_profile extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('ft_userId')!='' && $this->uri->segment(2)!="userlogout")
        { 
            $this->load->model('generic_model');
        }
        else{
            redirect ('');
        }
    }
     public function editProfile()
    {
        if ($this->session->flashdata('success') != ""){
           $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
           $data['errors'] = $this->session->flashdata('errors');
        }
        $data["result"]=$this->generic_model->getSpecificRecord("users", array("id"=>$this->session->userdata("ft_userId")));
        $data['title'] = 'Update Profile';
        $data['heading'] = 'Update Profile';
        $data["page"]='backend/editProfile';
        $this->load->view('backend/main',$data);
    }
    public function updateProfile()
    {
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        
        if ($this->form_validation->run() == FALSE)
        {   
            $data = array();
            $data['errors'] = validation_errors();
            redirect('admin/editProfile');
        }
        else
        {
            //No Errors
            date_default_timezone_set("Asia/Karachi");
            $data["firstName"]=$this->input->post('firstName');
            $data["lastName"]=$this->input->post('lastName');
            $data["email"]=$this->input->post('email');
            $data["address"]=$this->input->post('address');
            $data["phone"]=$this->input->post('phone');
            $data["modifiedBy"]=$this->session->userdata("ft_userId");
            $data["modifiedAt"]=date("Y-m-d h:i:sa");
	    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                $userInfo=$this->generic_model->getSpecificRecord("users",array("id" =>$this->session->userdata("ft_userId")));
                if(!empty($userInfo["profile_pic"])){unlink($userInfo["profile_pic"]);}
                
                $fileName = uniqid();
                $ext= explode('.', $_FILES['image']['name']);
                $ext = end($ext);
                upload_image("uploads/admin", "gif|jpg|png|jpeg", "image", $fileName);
                $profile_pic= "uploads/admin/" . $fileName . ".$ext";
                $this->generic_model->updateRecord("users",array("profile_pic"=>$profile_pic),array('id'=>$this->session->userdata("ft_userId")));
                $this->session->set_userdata('pen_app_profilePic', $profile_pic);
            }
            $id=$this->generic_model->updateRecord("users",$data, array("id"=>$this->session->userdata("ft_userId")));
            //update Session
            $userDetail=$this->generic_model->getSpecificRecord("users", array("id"=>$this->session->userdata("ft_userId")));
            $this->session->set_userdata('pen_app_firstName', $userDetail["firstName"]);
            $this->session->set_userdata('pen_app_lastName', $userDetail["lastName"]);
            $this->session->set_flashdata('success', "Profile has been updated successfully");
        }
        redirect('admin/editProfile');
    }
    public function editPassword()
    {
        if ($this->session->flashdata('success') != ""){
           $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
           $data['errors'] = $this->session->flashdata('errors');
        }
        $data["userInfo"]=$this->generic_model->getSpecificRecord("users", array("id"=>$this->session->userdata("ft_userId")));
        $data['title'] = 'Change Password';
        $data['heading'] = 'Change Password';
        $data["page"]='backend/changePassword';
        $this->load->view('backend/main',$data);
    }
    public function updatePassword()
    {
        
        $this->form_validation->set_rules('oldpass', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {        
            //show errors
            $this->session->set_flashdata('errors', validation_errors());
            $data = array();
     
            $data['errors'] = validation_errors();
        
            
            redirect('admin/editPassword');
        }
        else
        {
            $userInfo=$this->generic_model->getSpecificRecord("users", array("id"=>$this->session->userdata("ft_userId")));
            if($userInfo["password"]==$this->input->post('password'))
            {
                if($this->input->post('password')==$this->input->post('password2'))
                {
                    //No Errors
                    date_default_timezone_set("Asia/Karachi");
                    $data["password"]=$this->input->post('password');
                    $data["modifiedBy"]=$this->session->userdata("ft_userId");
                    $data["modifiedAt"]=date("Y-m-d h:i:sa");
                    $id=$this->generic_model->updateRecord("users",$data, array("id"=>$this->session->userdata("ft_userId")));

                    $this->session->set_flashdata('success', "Password has been changed successfully");
                }
                else {
                    $this->session->set_flashdata('errors', "New password dosn't match with Confirm password");
                    redirect('admin/editPassword');
                }
            }
            else {
                $this->session->set_flashdata('errors', "Old Password is wrong! Please type correct one");
                redirect('admin/editPassword');
            }
        }
        redirect('admin/editPassword');
    }
}