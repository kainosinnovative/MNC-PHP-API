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
        echo($sql);

        
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
}