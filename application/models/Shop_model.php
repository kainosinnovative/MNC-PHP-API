<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shop_model extends CI_Model
{

    public function getSingleShopById($shop_id)
    {
        $this->db->select('*');
        $this->db->from('shopinfo');
        $this->db->where('shop_id', $shop_id);
        return $this->db->get()->row_array();
    }
    public function AddshopServiceInsert($service_amount,$serviceid,$shopid){
        $currentDate = date('y-m-d');
        $sql = "INSERT INTO shop_service (shop_id,service_id,actual_amount,lastupddt)
        VALUES ('$shopid','$serviceid','$service_amount','$currentDate')";
        // echo($sql);

        
         $query = $this->db->query($sql);
         return $query;
        //  return $query->result_array();
          

    }

    public function shopServiceUpdate($service_amount,$serviceid,$shopid){
        $currentDate = date('y-m-d');

        $sql = "UPDATE shop_service
        SET actual_amount = '$service_amount', lastupddt = '$currentDate'
        WHERE shop_id = $shopid and service_id = $serviceid";

        
         $query = $this->db->query($sql);
         return $query;
        //  return $query->result_array();
          

    }
    public function updateProfileImg($shop_id,$target_path) {
        $sql = "UPDATE shopinfo
        SET shop_image = '$target_path'
        WHERE shop_id = $shop_id;";
        $this->db->query($sql);
        return $this->db->query($sql);
    }
    public function AddShopdetails($shop_id,$data) {
        $this->db->where('shop_id', $shop_id);
        $this->db->update('shopinfo', $data);
        return 'updated';
    }
    
    public function AddComboOfferDetailsInsert($services,$combo_price,$shop_id,$offer_percent,$start_date,$end_date,$model_id){
        $currentDate = date('y-m-d');
        $sql = "INSERT INTO combo_offers (services,combo_price,shop_id,offer_percent,start_date,end_date,lastupddt,model_id)
        VALUES ('$services','$combo_price','$shop_id','$offer_percent','$start_date','$end_date','$currentDate',$model_id)";
        // echo($sql);

        
         $query = $this->db->query($sql);
         return $query;
        //  return $query->result_array();
          

    }

    public function getComboOffersByShopid($shopid)
    {
        
        
        $sql = "SELECT * FROM combo_offers where shop_id='".$shopid."'";
		$query = $this->db->query($sql);
        
        return $query->result_array();

    }

    public function getshopserviceByModelid($shopid)
    {

        $sql = "SELECT distinct(s.model_id) , m.model_name FROM models m, shop_service s WHERE m.id=s.model_id and s.shop_id='".$shopid."'";
		$query = $this->db->query($sql);
        
        return $query->result_array();

    }

    public function getcombooffertblByModelid($shop_id,$model_id) {
        $this->db->select('a.service_id,a.service_name,b.actual_amount,c.model_name,b.offer_percent,b.offer_price,b.model_id,b.shop_id');
        $this->db->join('services a','a.service_id=b.service_id');
        
        $this->db->join('models c','c.id= b.model_id');
        $this->db->join('shopinfo d','d.status=1');
        // $this->db->join('shopinfo d','d.status=1');
        return $this->db->order_by('a.service_id')->get_where('shop_service b',array('b.shop_id' => $shop_id,'b.model_id' => $model_id))->result_array();
     }



     public function getdashboardShopList($shopid)
    {
        $this->db->select('a.service_id,a.service_name,b.actual_amount,c.model_name,b.offer_percent,b.offer_price,b.model_id,b.shop_id');
        $this->db->join('services a','a.service_id=b.service_id');
        
        $this->db->join('models c','c.id= b.model_id');
        $this->db->join('shopinfo d','d.status=1');
        // $this->db->join('shopinfo d','d.status=1');
        return $this->db->order_by('a.service_id')->get_where('shop_service b',array('b.shop_id' => $shopid))->result_array();


    }

    public function getOnlineBookingShopDetails($shopid)
    {
        $sql = "SELECT *,b.services,b.combo_price,b.offer_percent,b.model_id, c.model_name FROM `shopinfo` a, combo_offers b, models c WHERE a.shop_id = b.shop_id and a.shop_id = '".$shopid."' and b.model_id= c.id order BY b.offer_percent DESC;";
		$query = $this->db->query($sql);
        
        return $query->result_array();


    }

    
    
}