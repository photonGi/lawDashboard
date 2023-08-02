<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_customer extends CI_Controller {

    protected $page = 'backend/customer/';

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('ft_userId') != '' && $this->uri->segment(2) != "userlogout") {
            
            $this->load->model('generic_model');
             $this->load->model('backend/admin_model');
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
        $data['dataArr'] = $this->generic_model->getAllRecords('customers', array('is_deleted' => 0), "id", "desc");
        $data['title'] = 'Customer';
        $data['heading'] = 'Customer';
        $data['page'] = $this->page . 'list';
        $this->load->view('backend/main', $data);
    }
     public function viewCustomer()            
    {
        
        $customerId=decode_uri($this->uri->segment(3));
        if(is_numeric($customerId) && !empty($customerId))
        {
        
            $data['title'] = 'Edit Customer Information';
            $data['heading'] = 'Edit Customer Information:';
            $data["page"]='backend/customer/form';
             $data["result"]=  $this->admin_model->getSpecificCustomer($customerId);
             $data['countries'] = $this->generic_model->getAllRecords('countries', array(), "id", "asc");
       $data['states'] = $this->generic_model->getAllRecords('states', array(), "id", "asc");
            $this->load->view('backend/main',$data);
        }
        else {$this->session->set_flashdata('errors', 'Refference Error, Please try again later');
        redirect('admin/listCustomers');
        }
    }
    
    public function update()            
    {
        $customerId = decode_uri($this->uri->segment(3));
       
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        
       
        if ($this->form_validation->run() == FALSE)
        {        
            $data = array();
            $data['errors'] = validation_errors();
            redirect("admin/viewCustomer/".$this->uri->segment(3));
        }
        else
        {
            //No Errors
            
            date_default_timezone_set("Asia/Karachi");
            $data["firstName"]=$this->input->post('firstName');
            $data["lastName"]=$this->input->post('lastName');
            $data["email"]=$this->input->post('email');
            $data["phone"]=$this->input->post('phone');
            $data["address"]=$this->input->post('address');
            $data["city"]=$this->input->post('city');
            $data["country"]=$this->input->post('province');
            $data["country"]=$this->input->post('country');
            $data["status"]=$this->input->post('status');
            $data["modifiedBy"]=$this->session->userdata("ft_userId");
            $data["modifiedAt"]=date("Y-m-d h:i:sa");
            $this->generic_model->updateRecord("customers",$data, array("id"=>$customerId));
            $this->session->set_flashdata('success', "Customer has been updated successfully.");
        }
        
        redirect("admin/viewCustomer/".$this->uri->segment(3));
    }
    
}