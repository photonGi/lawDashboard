<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('upload_resize_image'))
{
    function upload_resize_image($uploadPath, $allowedTypes, $name, $fileName) {
        $CI = & get_instance();
        $config['file_name'] = $fileName;
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = $allowedTypes;        
        $config['max_size'] = '9000000000';
        
         $CI->load->library('upload', $config);
        if (!$CI->upload->do_upload($name)) {
            return $CI->upload->display_errors();
        } else {
            $errors=array();
            $sizesArr=array('636x370','248x159','210x130','182x88','87x73');
            $config['source_image'] = "uploads/news/orignal/".$CI->upload->file_name;
            $CI->load->library('image_lib');
            foreach($sizesArr as $size){
                $config['image_library'] = 'gd2';
                $dimentions=explode('x',$size);
                $config['new_image'] = "uploads/news/".$size."/".$CI->upload->file_name;
                $config['maintain_ratio'] = TRUE;
                $config['quality']=100;
                $config['width'] = $dimentions[0];
                $config['height'] = $dimentions[1];
                $CI->image_lib->initialize($config);
                if ( ! $CI->image_lib->resize()){
                    array_push($errors,$CI->image_lib->display_errors('', ''));
                }
            }
            return $errors;
          }        
    }
}
if (!function_exists('upload_image'))
{
    function upload_image($uploadPath, $name, $fileName) {
        $CI = & get_instance();
        
        $config['file_name'] = $fileName;
        $config['upload_path'] = $uploadPath;
      //  $config['allowed_types'] = $allowedTypes;        
        $config['max_size'] = '9000000000';

        $CI->load->library('upload', $config);

        if (!$CI->upload->do_upload($name)) {
            return $CI->upload->display_errors();
             echo "come here";
            die;
        } else {
            return array('upload_data' => $CI->upload->data());
             echo "come here2";
            die;
        }
        
    }
}
if (!function_exists('upload_video_file'))
{
    function upload_video_file($uploadPath, $allowedTypes, $name, $fileName)
    {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = $allowedTypes;
            $config['max_size'] = '6400000000';
            $config['max_filename'] = '255';
            $config['file_name'] = $fileName;
            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            
            $CI = & get_instance();
            $CI->load->library('upload');
            
            $CI->upload->initialize($config);

            if (!$CI->upload->do_upload($name))
            {
                
                return array('error' => $CI->upload->display_errors());
            }
            else
            {
                return $CI->upload->data();
            }
    }
}
if (!function_exists('upload_pdf_file'))
{
    function upload_pdf_file($uploadPath, $allowedTypes, $name, $fileName)
    {
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = $allowedTypes;
            $config['max_size'] = '640000000000';
            $config['max_filename'] = '255';
            $config['file_name'] = $fileName;
            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            
            $CI = & get_instance();
            $CI->load->library('upload');
            
            $CI->upload->initialize($config);

            if (!$CI->upload->do_upload($name))
            {
                
                return array('error' => $CI->upload->display_errors());
            }
            else
            {
                return $CI->upload->data();
            }
    }
}
if (!function_exists('upload_audio_file'))
{
    function upload_audio_file($input_name, $path)
    {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'mp3';
            $config['max_size'] = '6400000000';
            $config['max_filename'] = '255';
            $config['file_name'] = time();
            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            
            $CI = & get_instance();
            $CI->load->library('upload');
            
            $CI->upload->initialize($config);

            if (!$CI->upload->do_upload($input_name))
            {
                
                return array('error' => $CI->upload->display_errors());
            }
            else
            {
                return $CI->upload->data();
            }
    }
}


if (!function_exists('getImageCount')){
    function getImageCount($galleryId)
    {
        $CI = & get_instance();
        $CI->load->model('generic_model');
        $full_content=array();
        $counter=0;
        $content=$CI->generic_model->getSpecificRecordOrder('campaign_gallery',array('status'=>1,'id'=>$galleryId),"id","ASC");
        for($i=1; $i<=9; $i++)
        {            
            if($content['img'.$i] !=""){
               $counter++; 
            }
        }
        return $counter;
    }
}

if (!function_exists('upload_image2'))
{
    function upload_image2($uploadPath, $allowedTypes, $name, $fileName) {
        $CI = & get_instance();
        $config['file_name'] = $fileName;
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] ="*";
        $config['max_size'] = '6400000000';
        $config['max_filename'] = '255';
        $config['file_name'] = $fileName;
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = FALSE;

//        $unlink=base_url()."/$uploadPath/$fileName";
//        unlink($unlink);

        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($name)) {
            
            return $CI->upload->display_errors();
           
        } else {
            return array('upload_data' => $CI->upload->data());
             
        }
    }
}



if (!function_exists('resize_image'))
{
    function resize_image($source,$destination,$width,$height)
    {
        $CI = & get_instance();
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        if ($width!=0) {
            $config['width'] = $width;            
        }
        if ($height!=0) {
            $config['height'] = $height;
        }

        $config['quality'] = "80%";

        $CI->image_lib->initialize($config);
        if ( ! $CI->image_lib->resize())
{        return array('error' => $CI->image_lib->display_errors());}
else{    return true;  }
}}

if (!function_exists('resize_slider_image'))
{
    function resize_slider_image($source,$destination,$width,$height)
    {
        $CI = & get_instance();
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        //$config['quality'] = "80%";

        $CI->image_lib->initialize($config);
        if ( ! $CI->image_lib->resize())
{        return array('error' => $CI->image_lib->display_errors());}
else{    return true;  }
}}
if (!function_exists('home_slider'))
{
    function home_slider($source,$destination,$width,$height)
    {
        $CI = & get_instance();
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['quality'] = 100;

        $CI->image_lib->initialize($config);
        if ( ! $CI->image_lib->resize())
{        return array('error' => $CI->image_lib->display_errors());

}
else{    return true;  }
}}

if (!function_exists('resize_slide_image'))
{
    function resize_slide_image($source,$destination)
    {
        $CI = & get_instance();
        $CI->load->library('image_lib');

        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['create_thumb'] = FALSE; 
        $config['maintain_ratio'] = TRUE;
        $config['quality'] = "90%";
        $config['width']         = 650;
        $config['height']        = 800;

        $CI->image_lib->initialize($config);
        if ( ! $CI->image_lib->resize())
{        
    return array('error' => $CI->image_lib->display_errors());
}else{    return true;  }
}}
?>