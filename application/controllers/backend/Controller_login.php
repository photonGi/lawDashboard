<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_login extends CI_Controller {
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
        $this->load->view('backend/pages/auth-login',$data);
    }

    public function dashboard()
    {
        if ($this->session->userdata('ft_userId')!='' && $this->uri->segment(2)!="userlogout")
        { 
            $data = array();
            if ($this->session->flashdata('success') != ""){
               $data['success'] = $this->session->flashdata('success');
            }
            if ($this->session->flashdata('errors') != ""){
               $data['errors'] = $this->session->flashdata('errors');
            }
            
  //  $data["totalProperties"] =  $this->generic_model->getCount("properties","pid", array("is_deleted" => 0));
   // $data["totalUsers"] =  $this->generic_model->getCount("users","id", array("is_deleted" => 0,"status" => 1));
    $year = date("Y")."-";
            $data['title'] = 'Dashboard | IRCA';
            $data['page'] = 'backend/dashboard';
            $data['heading'] = 'Dashboard';

            $this->load->view('backend/main',$data);
        }
        else{
            redirect ('');
        }
    }

    public function checkLogin()
     {

        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
          $this->form_validation->set_rules("email","Email","trim|required|valid_email");
          $this->form_validation->set_rules("password","Password","trim|required");
            if ($this->form_validation->run() === false)
             {
                $this->session->set_flashdata('errors', validation_errors());
                redirect('admin/login');
             }
            else {

               $pass=MD5($this->input->post("password"));              
               $email=$this->input->post("email");                 
               
               $userDetail=$this->generic_model->getSpecificRecord("users",array('email'=>$email,'password'=>$pass));
              
                 if(empty($userDetail) or $userDetail==FALSE)
                 {
                     $errors=$this->session->set_flashdata('errors',"Wrong Email or Password");
                     redirect('admin/login');
                 }
                 else {
                     if($userDetail["status"]== 0 or $userDetail["is_deleted"]== 1)
                     {
                         $errors=$this->session->set_flashdata('errors',"Your account is deactivated or deleted by Admin.");
                         redirect('admin/login');
                     }
                     else{
                            $this->generic_model->insert("login_history", array(
                            "userId"=>$userDetail["id"],
                            "roleId"=>$userDetail["roleId"],
                            "login_date_time" =>date("Y-m-d h:i:sa"),
                            "ip_address"=> $this->get_ip()
                        ));
                       
                        date_default_timezone_set("Asia/Karachi");
                        $time=date("H:i");
                        $this->session->set_userdata('ft_userId', $userDetail["id"]);
                        $this->session->set_userdata('ft_roleId', $userDetail["roleId"]);
                        $this->session->set_userdata('ft_address', $userDetail["address"]);
                        $this->session->set_userdata('ft_firstName', $userDetail["firstName"]);
                        $this->session->set_userdata('ft_lastName', $userDetail["lastName"]);
                        $this->session->set_userdata('ft_email', $userDetail["email"]);
                        $this->session->set_userdata('ft_loginTime', $time);                        
                            redirect('admin/dashboard');
                                                
                     }
                 }
             }
       }
    }

    public function logout()
    {

        if ($this->session->userdata('ft_userId')) {
          // echo "user id";die();
            $this->session->sess_destroy();
            redirect('admin/login');
        }
        else {
          // echo "Not user id";die();
            redirect('admin/login');
        }
    }
    public function mailPassword()
    {
        $data = array();
        if ($this->session->flashdata('success') != ""){
           $data['success'] = $this->session->flashdata('success');
        }
        if ($this->session->flashdata('errors') != ""){
           $data['errors'] = $this->session->flashdata('errors');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            
            $data['errors'] = $this->session->set_flashdata('errors',"Enter correct email address");
            redirect('admin/login');
        }
        else{
            $userDetail=$this->generic_model->getSpecificRecord("users", array("email"=>$this->input->post('email')));
            if($userDetail["email"]==$this->input->post('email'))
            {
                if($userDetail["status"]==0 or $userDetail["is_deleted"]==1)
                {
                    $this->session->set_flashdata('errors',"Account is deactivated or deleted by Admin");
                    redirect('admin/login');
                }
                else
                {
                    $token = md5(uniqid(rand(), true));
                    $this->generic_model->updateRecord("users",array('password_reset_token'=>$token), array("id"=>$userDetail['id']));
                    $link= base_url()."restPasswordPage/".encode_url($userDetail['id'])."/".$token;
                    $sub ="Reset Your Password (Truth Meter)";
                    $message ='<table><tr>'."<p>Hello,</p> ";
                    $message.="Click the link below to change your password ";
                    $message.= "<a href=$link>Click Me</a>";
                    $config['useragent']="jagheer";
                    $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                    $config['protocol'] = "smtp";
                    $config['smtp_host'] = "mail.jagheer.com";
                    $config['smtp_user'] = "123@jagheer.com";
                    $config['smtp_pass'] = "";
                    $config['smtp_port'] = "587";
                    $config['mailtype'] = 'html';
                    $config['charset'] = 'utf-8';
                    $config['newline'] = "\r\n";
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from('123@irca.com', 'Jagheer');
                    $this->email->to($userDetail["email"]);
                    //$this->email->cc('asif.cyan.nawaz@outlook.com');
                    //$this->email->bcc('');
                    $this->email->subject($sub);
                    $this->email->message($message);
                    if ($this->email->send()){

                         $this->session->set_flashdata('success',"Mail has been sent successfully.");
                        redirect('admin/login');
                    }
                    else {


                        $this->session->set_flashdata('errors',$this->email->prtm_debugger());
                        redirect('admin/login');
                    }
                }
            }
            else
            {
                $this->session->set_flashdata('errors',"This email account does not exist.");
                redirect('admin/login');
            }
        }

    }

    public function get_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            return $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            return $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $ip = $_SERVER['REMOTE_ADDR'];
        }
    }
    public function restPasswordPage()
    {
        $id = decode_uri($this->uri->segment(2));
    	$token = $this->uri->segment(3);
        
        if (empty($id) && empty($token))
        {        
             $this->load->view('errors/html/error_access',array('heading'=>'Error','message'=>"you did'nt have permission to access this page"));
        }
        else
        {
            $userInfo=$this->generic_model->getSpecificRecord('users',array('id'=>$id,'password_reset_token'=>$token));
            if($userInfo){
                $data=array();
                 if ($this->session->flashdata('success') != ""){
                    $data['success'] = $this->session->flashdata('success');
                 }
                 if ($this->session->flashdata('errors') != ""){
                    $data['errors'] = $this->session->flashdata('errors');
                 }
                $this->load->view('backend/resetPassword',$data);
            }
            else{
                $this->load->view('errors/html/error_access',array('heading'=>'Error','message'=>"you did'nt have permission to access this page"));
            }
        }
    }
    public function restPassword()
    {
        $pass=$this->input->post("password");              
        $conPass=$this->input->post("conPassword");  
        $userId=  decode_uri($this->input->post("userId"));  
        if (empty($userId) || $this->input->post("token")!="")
        {        
            $this->session->set_flashdata('success', "Unauthentic submission");
            redirect('restPasswordPage/'.$this->input->post("userId")."/".$this->input->post("token"));
        }
        else
        {
            if(!empty($pass) && !empty($conPass) && $pass==$conPass){
                $this->generic_model->updateRecord('users',array('password'=>$pass,'password_reset_token'=>0),array('id'=>$userId));
                $this->session->set_flashdata('success', "Password has been changed successfully,login!");
                redirect('admin/login');
            }
            else{
                 $this->session->set_flashdata('errors', "Password and confirm passed should be same");
                redirect('restPasswordPage/'.$this->input->post("userId")."/".$this->input->post("token"));
            }
            
        }
    }

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
