<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Mymodel extends CI_Model {

    // Public function getProductDetail($productId){
    //      $this->db->select('p.*,p.id as productId,p.name as productName,cat_1.id as businessId,'
    //                         . 'cat_2.id as catId,'
    //                         . 'cat_3.id as subCatId,'
    //                         . 'cat_1.name as businessCatName ,cat_2.name as categoryName,'
    //                         . ' cat_3.name as subCategoryName'
    //                  )
    //             ->from('product as p')
    //             ->join('category_relation As cat_r','cat_r.id=p.category_id')
    //             ->join('cat_first_level As cat_1','cat_1.id=cat_r.cat_first_level')
    //             ->join('cat_second_level As cat_2','cat_2.id=cat_r.cat_second_level')
    //             ->join('cat_third_level As cat_3','cat_3.id=cat_r.cat_third_level',"left")
    //             ->where(array("p.id"=>$productId))
    //              ;
                
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         $result= $query->result_array();
    //         return $result[0];
    //     } else {
    //         return FALSE;
    //     }
    // }


    Public function getAllRecords(){
         $this->db->select( 'bcl.*,bct.name as type' )
                
                ->from('bottom_content_list as bcl')
                ->join('bottom_content_types as bct','bcl.type=bct.id')
                
                ->where(array("bcl.is_deleted"=>0)) ;
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           $result=  $query->result_array();
            return $result;
        } else {
            return FALSE;
        }
    }

    







}
