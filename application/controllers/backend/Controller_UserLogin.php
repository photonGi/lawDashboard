<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_UserLogin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('generic_model');
    
    }

    public function index()
    {
         $data = array();
        if ($this->session->flashdata('success') != ""){
           $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
           $data['errors'] = $this->session->flashdata('errors');
        }

        $data['title'] = 'Login | IRCA';
        $this->load->view('frontend/pages/login',$data);
    }

    public function signup()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fname','First Name','trim|required');
        $this->form_validation->set_rules('lname','Last Name','trim|required');
        $this->form_validation->set_rules('email','Email Address','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('phone','Phone Number','trim|required');
        
        if ($this->form_validation->run()==FALSE) {
                    $data = array();
                    $data['errors'] = $this->session->set_flashdata('errors', validation_errors());
                    redirect('register'); }

        $data["fname"]=$this->input->post('fname');
        $data["lname"]=$this->input->post('lname');
        $data["email"]=$this->input->post('email');
        $data["password"]=$this->input->post('password');
        $data["phone"]=$this->input->post('phone');

        $data["createdAt"]=date('Y-m-d h:i:sa');
        $data["createdBy"]=$this->session->userdata('ft_id');
        $data["modifiedAt"]=date('Y-m-d h:i:sa');
        $data["modifiedBy"]=$this->session->userdata('ft_id');
        $data["status"] = 1;
        
        $addData = $this->generic_model->insert("appUsers", $data);
        
        if ($addData){
          $this->session->set_flashdata('success', "Registered Successfully.");
        } else {
         $this->session->set_flashdata('error', "Error While Adding Data");
        }redirect('register');
    }

    public function checkLogin()
     {
         
          $this->form_validation->set_rules("email","Email Address","trim|required|valid_email");
          $this->form_validation->set_rules("password","Password","trim|required");
            if ($this->form_validation->run() === false)
             {
                $this->session->set_flashdata('error', validation_errors());
                redirect('login');
             }
            else {

               $pass=$this->input->post("password");
               $email=$this->input->post("email");

               $userDetail=$this->generic_model->getSpecificRecord("appUsers",array('email'=>$email,'password'=>$pass));
              
                 if(empty($userDetail) or $userDetail==FALSE)
                 {
                     $errors=$this->session->set_flashdata('error',"Wrong Email or Password");
                     redirect('login');
                 }
                 else {
                     if($userDetail["status"]== 0 or $userDetail["is_deleted"]== 1)
                     {
                         $errors=$this->session->set_flashdata('error',"Your account is deactivated.");
                         redirect('login');
                     }
                     else {
                        $newdata = array(
                                'email'     => $email,
                                'logged_in' => TRUE
                        );

                        $this->session->set_userdata($newdata);

                        if (!empty($newdata)) {
                            redirect('dashboard');
                        }
                        else{
                            redirect('login');
                        }
                    }
                 }
             }
    }

    public function logout()
    {
        if ($this->session->userdata($newdata)) {
          // echo "user id";die();
            $this->session->sess_destroy();
            redirect('login');
        }
        else {
          // echo "Not user id";die();
            redirect('login');
        }
    }

    public function reset_pass()
    {
        $this->load->view('backend/appUser/resetPassword');
    }

    public function resetPassword()
    {
        $id=  $this->uri->segment(3);
        $pass=$this->input->post("password");
        
        if(!empty($pass)){
            $this->generic_model->updateRecord('appUsers',array('password'=>$pass,array('uId'=>$id)));
            $this->session->set_flashdata('success', "Password has been changed successfully,login!");
            redirect('user/login');
        }
        else{
                $this->session->set_flashdata('errors', "Password and confirm passed should be same");
                redirect('reset_pass/'.$uId);
        }
    }

    public function clients(){

        $data = array();
        if ($this->session->flashdata('success') != ""){
          $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
          $data['errors'] = $this->session->flashdata('errors');
        }

          $data['clients'] = $this->generic_model->getAllRecords('appUsers',array('status'=> 1, 'is_deleted'=>0),"uId","DESC");

          $data['heading'] = 'Clients';
          $data['title'] = 'Clients';
          $data['page'] = 'backend/clients/list';
        $this->load->view('backend/main', $data);
    }
    
}

