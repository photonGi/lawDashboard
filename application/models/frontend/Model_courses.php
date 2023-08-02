<?php

if (!defined('BASEPATH'))
    exit('No direct script  allow');

class Model_courses extends CI_Model {
    function getCategories(){
        $this->db->select('*')
                ->from('categories')
               
                ->where(array("is_deleted"=>0,"status"=>1))
                ->order_by("catId","asc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getCertificates($catId){
        $this->db->select('*')
                ->from('certificates')
               
                ->where(array("is_deleted"=>0,"status"=>1,"catId"=>$catId))
                ->order_by("cid","asc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getSpecificCourses($certificate){
        
       $this->db->select('c.*')
                ->from('certificates as cer')
                ->join('courses as c','c.cid=cer.cid')
                
                ->where(array("cer.cUrl"=>$certificate));
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    // old code
     function titaniumAgencies(){
        
       $this->db->select('a.*')
                ->from('agencies as a')
               
                ->where(array("a.is_deleted"=>0,"a.is_titanium"=>1))
                ->order_by("a.aid","a.desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function featuredAgencies(){
        
       $this->db->select('a.*')
                ->from('agencies as a')
               
                ->where(array("a.is_deleted"=>0,"a.is_featured"=>1))
                ->order_by("a.aid","a.desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getAllagencies(){
        
       $this->db->select('a.*')
                ->from('agencies as a')
               
                ->where(array("a.is_deleted"=>0,"a.is_featured"=>1))
                ->order_by("a.aid","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getAllMaps(){
        
       $this->db->select('m.*')
                ->from('maps as m')
               
                ->where(array("m.is_deleted"=>0))
                ->order_by("m.mapId","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getAllProjects(){
        
       $this->db->select('p.*')
                ->from('projects as p')
               
                ->where(array("p.is_deleted"=>0))
                ->order_by("p.proId","p.desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function luxuryProjects(){
        
       $this->db->select('p.*')
                ->from('projects as p')
               
                ->where(array("p.is_deleted"=>0,"p.is_luxury"=>1))
                ->limit(4)
                ->order_by("p.proId","p.desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function newProjects(){
        
       $this->db->select('p.*')
                ->from('projects as p')
               
                ->where(array("p.is_deleted"=>0))
                ->limit(2)
                ->order_by("p.proId","p.desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function latestBlogs(){
        
       $this->db->select('b.*')
                ->from('blogs as b')
               
                ->where(array("b.is_deleted"=>0))
                ->limit(10)
                ->order_by("b.blogId","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
   
    function getAllBlogs(){
        
       $this->db->select('b.*')
                ->from('blogs as b')
               
                ->where(array("b.is_deleted"=>0))
               
                ->order_by("b.blogId","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
      function getlatestBlogs($blog){
        
       $this->db->select('b.*')
                ->from('blogs as b')
               
                ->where(array("b.is_deleted"=>0,"b.blogUrl !="=>$blog))
               ->limit(4)
                ->order_by("b.blogId","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getBlog($blog){
        
       $this->db->select('b.*')
                ->from('blogs as b')
               
                ->where(array("b.blogUrl"=>$blog))
               
                ;
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
    function getProject($project){
        
       $this->db->select('p.*')
                ->from('projects as p')
               
                ->where(array("p.proUrl"=>$project))
               
                ;
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
    function getMap($map){
        
       $this->db->select('m.*')
                ->from('maps as m')
               
                ->where(array("m.mapUrl"=>$map))
               
                ;
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
     function getlatestProjects($project){
        
        $this->db->select('p.*')
                ->from('projects as p')
               
                ->where(array("p.is_deleted"=>0,"p.proUrl !="=>$project))
               ->limit(4)
                ->order_by("p.proId","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getPropertyUrl($uniqueId){
        
       $this->db->select('p.propertyUrl')
                ->from('properties as p')
                ->where(array("p.uniqueid"=>$uniqueId));
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
      function getProperty($property){
        
       $this->db->select('p.*,c.catTitle,cities.city,a.title as agency,a.aImage as agencyLogo,a.contact as agecnyContact,a.is_featured as afeatured,a.is_titanium as atitanium')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('agencies as a','a.aid=p.agencyId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.propertyUrl"=>$property));
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
     function relativeProperties($property){
        
       $this->db->select('p.catId,p.propertyType,p.city,p.propertylocation')
                ->from('properties as p')
               
                ->where(array("p.pid"=>$property));
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                $results = $result[0];
                $catId = $results["catId"];  $propertyType = $results["propertyType"]; $city = $results["city"]; $propertylocation = $results["propertylocation"];               
             $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$catId,"p.propertyType"=>$propertyType,"p.city"=>$city,"p.propertylocation"=>$propertylocation))
                 ->limit(10)
                 ->order_by("p.pid","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
        } else {
            return FALSE;
        }
    }
    function lahoreProperties(){
        
       $this->db->select('COUNT(p.pid) as lahoreProperties')
                ->from('properties as p')
               
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.city"=>2))
               
                ->group_by("p.city");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result[0];
        } else {
            return FALSE;
        }
    }
      function getHomeProperties(){
        
       $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"c.parentId"=>1))
                ->order_by("p.pid","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
  function getfeaturedHomes(){
        $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.is_featured"=>1,"c.parentId"=>1))
                ->order_by("p.pid","desc")
                ->limit(10);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
   function getPlotProperties(){
        
       $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"c.parentId"=>2))
                ->order_by("p.pid","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
  function getfeaturedPlots(){
        $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.is_featured"=>1,"c.parentId"=>2))
                ->order_by("p.pid","desc")
                ->limit(10);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getCommercialProperties(){
        
       $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"c.parentId"=>3))
                ->order_by("p.pid","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
  function getfeaturedCommercials(){
        $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.is_featured"=>1,"c.parentId"=>3))
                ->order_by("p.pid","desc")
                ->limit(10);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function areaWiseHomes(){
        
       $this->db->select('COUNT(p.pid) as pids,cities.city,p.city as cityId')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"c.parentId"=>1))
                ->group_by("p.city")
                ->limit(6);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function areaWiseplots(){
        
       $this->db->select('COUNT(p.pid) as pids,cities.city,p.city as cityId')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"c.parentId"=>2))
                 ->group_by("p.city")
                 ->limit(6);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function areaWiseCommercial(){
        
       $this->db->select('COUNT(p.pid) as pids,cities.city,p.city as cityId')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"c.parentId"=>3))
                 ->group_by("p.city")
                 ->limit(6);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getPopularProperties($type,$city){
        
         
       $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.city"=>$city,"c.parentId"=>$type))
                ->order_by("p.pid","desc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getfeaturedProperties($type,$city){
        $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.is_featured"=>1,"p.city"=>$city,"c.parentId"=>$type))
                ->order_by("p.pid","desc")
                ->limit(10);
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function searchProperty($propertyType,$city,$location,$subType,$areaFrom,$areaTo,$areaUnit,$priceFrom,$priceTo){
        
      if($areaFrom!="" and $areaTo!="" and $priceFrom!="" and $priceTo!=""){
       $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$subType,
                "p.city"=>$city,"p.propertylocation"=>$location,"p.propertyType"=>$propertyType,"p.sizeUnit"=>$areaUnit,
                "p.size >="=>$areaFrom,"p.size <="=>$areaTo,"p.demand >="=>$priceFrom,"p.demand <="=>$priceTo))
                ->order_by('p.pid','desc');
          }else if($areaFrom!="" and $areaTo!="" and $priceFrom=="" ){
            $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$subType,
                "p.city"=>$city,"p.propertylocation"=>$location,"p.propertyType"=>$propertyType,"p.sizeUnit"=>$areaUnit,
                "p.size >="=>$areaFrom,"p.size <="=>$areaTo))
                ->order_by('p.pid','desc');
          }    
          else if($areaFrom=="" and $priceFrom!="" and $priceTo!=""){
            $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$subType,
                "p.city"=>$city,"p.propertylocation"=>$location,"p.propertyType"=>$propertyType,"p.demand >="=>$priceFrom,"p.demand <="=>$priceTo))
                ->order_by('p.pid','desc');
          }else{
            $this->db->select('p.*,cities.city')
                ->from('properties as p')
                ->join('categories as c','c.catId=p.catId')
                ->join('cities','cities.id=p.city')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$subType,
                "p.city"=>$city,"p.propertylocation"=>$location,"p.propertyType"=>$propertyType))
                ->order_by('p.pid','desc');
          }      
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
     function getCities(){
        
       $this->db->select('*')
                ->from('cities')
                ->order_by('city','asc');
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getLocations($city){
        
       $this->db->select('distinct(propertylocation) as location')
                ->from('properties')
                ->where(array("city"=>$city))
                ->order_by('propertylocation','asc');
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    function getSubCategories($cat){
        
       $this->db->select('catId,catTitle')
                ->from('categories')
                ->where(array("parentId"=>$cat))
                ->order_by('catTitle','asc');
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    // used in frontend
   
  
        function getFilteredProducts($cat,$price){
       $storeId = $this->session->userdata('store');
    if($cat!="" and $price==""){
        $this->db->select('p.*,GROUP_CONCAT(s.sizeId SEPARATOR ",") as sizeId,
       GROUP_CONCAT(s.size SEPARATOR ",") as size,GROUP_CONCAT(pq.quantity SEPARATOR ",") as quantity')
                ->from('products as p')
                ->join('proquantity as pq','p.productId=pq.productId')
                ->join('sizes as s','s.sizeId=pq.sizeId')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$cat,"pq.is_deleted"=>0))
                ->like('p.storeId',$storeId)
                ->group_by("p.productId")
                ->order_by("p.productId","desc");
             } 
    if($cat=="" and $price!=""){
        if($price==1){
             $this->db->select('p.*,GROUP_CONCAT(s.sizeId SEPARATOR ",") as sizeId,
       GROUP_CONCAT(s.size SEPARATOR ",") as size,GROUP_CONCAT(pq.quantity SEPARATOR ",") as quantity')
                ->from('products as p')
                ->join('proquantity as pq','p.productId=pq.productId')
                ->join('sizes as s','s.sizeId=pq.sizeId')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"pq.is_deleted"=>0))
                ->like('p.storeId',$storeId)
                 ->group_by("p.productId")
                ->order_by("p.pPrice","asc");
        }
        if($price==2){
            $this->db->select('p.*,GROUP_CONCAT(s.sizeId SEPARATOR ",") as sizeId,
       GROUP_CONCAT(s.size SEPARATOR ",") as size,GROUP_CONCAT(pq.quantity SEPARATOR ",") as quantity')
                ->from('products as p')
                ->join('proquantity as pq','p.productId=pq.productId')
                ->join('sizes as s','s.sizeId=pq.sizeId')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"pq.is_deleted"=>0))
                ->like('p.storeId',$storeId)
                 ->group_by("p.productId")
                ->order_by("p.pPrice","desc"); 
        }
       
             } 
        if($cat!="" and $price!=""){
    
       if($price==1){
            $this->db->select('p.*,GROUP_CONCAT(s.sizeId SEPARATOR ",") as sizeId,
       GROUP_CONCAT(s.size SEPARATOR ",") as size,GROUP_CONCAT(pq.quantity SEPARATOR ",") as quantity')
                ->from('products as p')
                ->join('proquantity as pq','p.productId=pq.productId')
                ->join('sizes as s','s.sizeId=pq.sizeId')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$cat,"pq.is_deleted"=>0))
                ->like('p.storeId',$storeId)
                 ->group_by("p.productId")
                ->order_by("p.pPrice","asc");
        }
        if($price==2){
            $this->db->select('p.*,GROUP_CONCAT(s.sizeId SEPARATOR ",") as sizeId,
       GROUP_CONCAT(s.size SEPARATOR ",") as size,GROUP_CONCAT(pq.quantity SEPARATOR ",") as quantity')
                ->from('products as p')
                ->join('proquantity as pq','p.productId=pq.productId')
                ->join('sizes as s','s.sizeId=pq.sizeId')
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.catId"=>$cat,"pq.is_deleted"=>0))
                ->like('p.storeId',$storeId)
                 ->group_by("p.productId")
                ->order_by("p.pPrice","desc"); 
        }
             
             } 
       
        
            
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
    
     function getFeaturedProducts(){
         $storeId = $this->session->userdata('store');
       $this->db->select('p.*')
                ->from('products as p')
                ->join('proquantity as pq','p.productId=pq.productId')
               
                ->where(array("p.is_deleted"=>0,"p.status"=>1,"p.is_hot"=>1,"pq.is_deleted"=>0))
                ->like('p.storeId',$storeId)
                 ->group_by("p.productId")
                ->limit(5)
                ->order_by("p.pOrder","asc");
                
                
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result= $query->result_array();
                                   
            return $result;
        } else {
            return FALSE;
        }
    }
   
  
   
}