<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_ajax extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        
        if ($this->session->userdata('tm_userId')!='' && $this->uri->segment(2)!="userlogout")
        { 
            $this->load->model('generic_model');
        }
        else{
            redirect ('');
        }
    }
    public function getCity(){
        if($_POST["data"]=="getCity" && $_POST["country"] != "")
        { 
            $cityArr=$this->generic_model->getAllRecords("city",array("countryId"=>$_POST["country"],"is_deleted"=>0),"city_name","ASC");
            ?>
            <option value="" >Select City</option>
            <?php
            foreach($cityArr as $city)
            {
            ?>
            <option value="<?php echo $city["id"];?>" ><?php echo $city["city_name"];?></option>
            <?php }
        }
    }
}