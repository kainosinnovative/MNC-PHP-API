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
    public function updateShopLogo($shop_id,$target_path) {
        $sql = "UPDATE shopinfo
        SET shop_logo = '$target_path'
        WHERE shop_id = $shop_id;";
       // echo($sql);
        $this->db->query($sql);
        return $this->db->query($sql);
    }
    public function AddShopdetails($shop_id,$data) {
        $this->db->where('shop_id', $shop_id);
        $this->db->update('shopinfo', $data);
        return 'updated';
    }
    
    public function AddComboOfferDetailsInsert($services,$combo_price,$shop_id,$offer_percent,$start_date,$end_date,$model_id,$original_amount,$offer_name){
        $currentDate = date('y-m-d');
        $sql = "INSERT INTO combo_offers (services,combo_price,shop_id,offer_percent,start_date,end_date,lastupddt,model_id,original_amount,offer_name)
        VALUES ('$services','$combo_price','$shop_id','$offer_percent','$start_date','$end_date','$currentDate','$model_id','$original_amount','$offer_name')";
        // echo($sql);

        
         $query = $this->db->query($sql);
         return $query;
        //  return $query->result_array();
          

    }

    public function getComboOffersByShopid($month,$year,$id)
    {
       
        $sql = "SELECT * FROM combo_offers where shop_id='$id' and YEAR(DATE(start_date))='$year' and  MONTH(DATE(start_date)) = '$month'";
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
        $this->db->select('DISTINCT(a.service_id),a.service_name,b.actual_amount,c.model_name,b.offer_percent,b.offer_price,b.model_id,b.shop_id');
        $this->db->join('services a','a.service_id=b.service_id');
        
        $this->db->join('models c','c.id= b.model_id');
        $this->db->join('shopinfo d','d.status=1');
        // $this->db->join('shopinfo d','d.status=1');
        return $this->db->order_by('a.service_id')->get_where('shop_service b',array('b.shop_id' => $shop_id,'b.model_id' => $model_id,'b.status'=>'1'))->result_array();
     }



     public function getdashboardShopList($cityid)
    {
        // $sql = "SELECT max(b.offer_percent),a.*,b.services,b.combo_price,b.model_id, c.model_name, d.city_name,b.shop_id,b.offer_percent,b.offer_id FROM shopinfo a, combo_offers b, models c, city_list d WHERE a.shop_id = b.shop_id and b.model_id= c.id and d.city_id=a.city and a.city='".$cityid."' and !(CURDATE() between a.leave_from_date and a.leave_to_date) and (CURDATE() between b.start_date and b.end_date) GROUP BY b.shop_id";
        // $sql = "SELECT max(b.offer_percent),a.*,b.services,b.combo_price,b.model_id, c.model_name, d.city_name,b.shop_id,b.offer_percent,b.offer_id FROM shopinfo a, combo_offers b, models c, city_list d WHERE a.shop_id = b.shop_id and b.model_id= c.id and d.city_id=a.city and a.city='".$cityid."' and  (CURDATE() between b.start_date and b.end_date) GROUP BY b.shop_id";
$sql = "SELECT b.offer_percent,a.*,b.services,b.combo_price as comboprice ,b.original_amount,b.model_id, c.model_name, d.city_name,b.shop_id FROM shopinfo a, combo_offers b, models c, city_list d WHERE a.shop_id = b.shop_id and b.model_id= c.id and d.city_id=a.city and a.city='".$cityid."' and (CURDATE() between b.start_date and b.end_date) order by b.offer_percent desc";
		$query = $this->db->query($sql);
        
        return $query->result_array();


    }

    public function getOnlineBookingShopDetails($shopid)
    {
        $sql = "SELECT a.*,b.services,b.combo_price,b.offer_percent,b.model_id, c.model_name,b.original_amount,b.offer_id,b.offer_name FROM `shopinfo` a, combo_offers b, models c WHERE a.shop_id = b.shop_id and a.shop_id = '".$shopid."' and b.model_id= c.id order BY b.offer_percent DESC;";
		$query = $this->db->query($sql);
        
        return $query->result_array();


    }

    
     public function AddShopOfferDetails($service_id,$model_id,$lastupddt,$offer_price,$shop_id,$offer_percent,$start_date,$end_date)
    {
        $sql = "UPDATE shop_service SET offer_percent='$offer_percent',from_date='$start_date',to_date='$end_date',offer_price='$offer_price',lastupddt='$lastupddt'
        WHERE service_id=$service_id AND model_id=$model_id AND shop_id=$shop_id";
            
         $query = $this->db->query($sql);
         return $query;
    }


    public function getdashboardShopDetailsByOffer($cityid)
    {
        $sql = "Select b.offer_percent,a.*,b.service_id,b.offer_price as offer1,b.actual_amount,b.model_id,c.model_name,d.city_name,b.shop_id From shopinfo a,shop_service b,models c ,city_list d where a.shop_id = b.shop_id and b.model_id= c.id and d.city_id=a.city and (CURDATE() between b.from_date and b.to_date) and b.shop_id in (Select shop_id from shopinfo where city='".$cityid."') order by b.offer_percent desc;";
		$query = $this->db->query($sql);
        
        return $query->result_array();


    }
    

    public function Addonlinebooking($data)
    {
        var_dump($data);
      return $this->db->insert('onlinebooking', $data);
    }

    public function AddShopserviceDetailsInsert($data)
    {
        
        // print_r($data[0]);
        // var_dump($data);
      return $this->db->insert('shop_service', $data);
    }

    public function getMaxServiceId()
    {
        $maxid = 0;
        $row = $this->db->query('SELECT MAX(service_id) AS `maxid` FROM `services`')->row();
        if ($row) {
            $maxid = $row->maxid; 
            return $maxid;
        }
    }


    public function MasterServiceShopserviceInsert($model_id,$serviceid,$actual_amount,$shop_id)
    {
        //  return $this->db->insert('services', $data);
        $currentDate = date('y-m-d');
        $sql = "INSERT INTO shop_service (model_id,service_id,actual_amount,lastupddt,shop_id,status)
        VALUES ('$model_id','$serviceid','$actual_amount','$currentDate','$shop_id','1')";
        echo($sql);

        
         $query = $this->db->query($sql);
         return $query;

    }
    
    public function MasterServiceInsert($service_name)
    {
        //  return $this->db->insert('services', $data);
        $currentDate = date('y-m-d');
        $sql = "INSERT INTO services (service_name,lastupddt)
        VALUES ('$service_name','$currentDate')";
        echo($sql);

        
         $query = $this->db->query($sql);
         return $query;

    }

    public function getMasterServiceAndShopService($currentUserId)
    {

        $sql = "SELECT * FROM services WHERE  service_id NOT IN (SELECT service_id FROM shop_service WHERE shop_id='".$currentUserId."')";
		$query = $this->db->query($sql);
        
        return $query->result_array();

    }


    public function changeShopServiceStatusUpdate($status,$shopserviceid){
        $currentDate = date('y-m-d');
        if($status == 0){
            $status = 1;
        }
        else {
            $status = 0;
        }

        $sql = "UPDATE shop_service
        SET status = '$status', lastupddt = '$currentDate'
        WHERE id = $shopserviceid";

        
         $query = $this->db->query($sql);
         return $query;
        //  return $query->result_array();
          

    }
    public function getshoplist()
    {
        $this->db->select('*');
        $this->db->from('shopinfo');
        return $this->db->get()->result_array();
    }
    public function getcustomerBookingForShop($currentUserId)
    {

        $sql = "SELECT a.*,b.model_name,c.firstname FROM onlinebooking a, models b,customers c WHERE a.Shop_id='$currentUserId' and a.model_id=b.id and a.Customer_id=c.customer_id";
		$query = $this->db->query($sql);
        
        return $query->result_array();

    }
}