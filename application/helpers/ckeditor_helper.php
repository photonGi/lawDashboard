<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function cke_initialize($data = array()) {
	
	$return = '';
	
	if(!defined('CI_CKEDITOR_HELPER_LOADED')) {
		
		define('CI_CKEDITOR_HELPER_LOADED', TRUE);
		$return =  '<script type="text/javascript" src="'.base_url(). $data['path'] . '/ckeditor.js"></script>';
		$return .=	"<script type=\"text/javascript\">CKEDITOR_BASEPATH = '" . base_url() . $data['path'] . "/';</script>";
	} 
	
	return $return;
	
}

/**
 * This function create JavaScript instances of CKEditor
 * @author Samuel Sanchez 
 * @access private
 * @param array $data (default: array())
 * @return string
 */
function cke_create_instance($data = array()) {
	
    $return = "<script type=\"text/javascript\">
     	CKEDITOR.replace('" . $data['id'] . "', {";
    
    		//Adding config values
    		if(isset($data['config'])) {
	    		foreach($data['config'] as $k=>$v) {
	    			
	    			// Support for extra config parameters
	    			if (is_array($v)) {
	    				$return .= $k . " : [";
	    				$return .= config_data($v);
	    				$return .= "]";
	    				
	    			}
	    			else {
	    				$return .= $k . " : '" . $v . "'";
	    			}
                                $a=array_keys($data['config']);
	    			if($k !== end($a)) {
						$return .= ",";
					}		    			
	    		} 
    		}   			
    				
    $return .= '});</script>';	
    
    return $return;
	
}

/**
 * This function displays an instance of CKEditor inside a view
 * @author Samuel Sanchez 
 * @access public
 * @param array $data (default: array())
 * @return string
 */
function display_ckeditor($id)
{
    $data=init_ckeditor($id);
    // Initialization
    $return = cke_initialize($data);

    // Creating a Ckeditor instance
    $return .= cke_create_instance($data);
	

    // Adding styles values
    if(isset($data['styles'])) {
    	
    	$return .= "<script type=\"text/javascript\">CKEDITOR.addStylesSet( 'my_styles_" . $data['id'] . "', [";
   
    	
	    foreach($data['styles'] as $k=>$v) {
	    	
	    	$return .= "{ name : '" . $k . "', element : '" . $v['element'] . "', styles : { ";

	    	if(isset($v['styles'])) {
	    		foreach($v['styles'] as $k2=>$v2) {
	    			
	    			$return .= "'" . $k2 . "' : '" . $v2 . "'";
	    			$b=array_keys($data['styles']);
					if($k2 !== end($b)) {
						 $return .= ",";
					}
	    		} 
    		} 
	    
	    	$return .= '} }';
	    	$c=array_keys($data['styles']);
	    	if($k !== end($c)) {
				$return .= ',';
			}	    	
	    	

	    } 
	    
	    $return .= ']);';
		
		$return .= "CKEDITOR.instances['" . $data['id'] . "'].config.stylesCombo_stylesSet = 'my_styles_" . $data['id'] . "';
		</script>";		
    }   

    return $return;
}

/**
 * config_data function.
 * This function look for extra config data
 *
 * @author ronan
 * @link http://kromack.com/developpement-php/codeigniter/ckeditor-helper-for-codeigniter/comment-page-5/#comment-545
 * @access public
 * @param array $data. (default: array())
 * @return String
 */
function config_data($data = array())
{
	$return = '';
	foreach ($data as $key)
	{
		if (is_array($key)) {
			$return .= "[";
			foreach ($key as $string) {
				$return .= "'" . $string . "'";
				if ($string != end(array_values($key))) $return .= ",";
			}
			$return .= "]";
		}
		else {
			$return .= "'".$key."'";
		}
		if ($key != end(array_values($data))) $return .= ",";

	}
	return $return;
}

function init_ckeditor($id) 
    {
        //$this->load->helper('ckeditor');
        return array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	$id,
			'path'	=>	'assets/ckeditor',
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"auto",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
					
			),
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
			
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Blue',
						'font-weight' 		=> 	'bold'
					)
				),
				
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 		=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		);
    }