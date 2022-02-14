<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';
class Shop extends REST_Controller
{
    public $device = "";
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        header('Content-Type:  multipart/form-data');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
        // header('Content-Type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
        header("HTTP/1.1 200 OK");
        die();
        }
        
        $this->load->library("applib", array("controller" => $this));
        $this->load->model("app_model");
        $this->load->model("shop_model");
        $this->load->model("dealer_model");
        $this->load->model("shop_model");
    }

    public function getShopProfileById_get()
        {

            $shop_id = $_GET['shop_id'];
            $ShopDetailsById["profile"] = $this->shop_model->getSingleShopById($shop_id);
            $this->response($ShopDetailsById);
        }
    
   
    public function AddshopService_get() {

        $service_amount =   $_GET['service_amount']; 
        $serviceid = $_GET['serviceid']; 
        $shopid = $_GET['currentUserId'];
        
         $insertResponse = $this->shop_model->AddshopServiceInsert($service_amount,$serviceid,$shopid);
        $this->response($insertResponse);
    
    }


    public function UpdateshopService_get() {

        $service_amount =   $_GET['service_amount']; 
        $serviceid = $_GET['serviceid']; 
        $shopid = $_GET['currentUserId'];
        
         $insertResponse = $this->shop_model->shopServiceUpdate($service_amount,$serviceid,$shopid);
        $this->response($insertResponse);
    

    }
    public function AddShopdetails_post() {
        $json = file_get_contents('php://input');
    // Converts it into a PHP object
            $data = json_decode($json);
            $shop_id = $this->post('shop_id');
        // $currentDate = date('y-m-d');
        //     $note_data = {"lastupddt":"$currentDate"};
            
    
            $AddShopdetails = $this->shop_model->AddShopdetails($shop_id,$data);
            
            $this->response($AddShopdetails);
    } 


    public function AddComboOfferDetails_get() {

        $services =   $_GET['services']; 
        $combo_price = $_GET['combo_price']; 
        $shop_id = $_GET['shop_id'];
        $offer_percent =   $_GET['offer_percent']; 
        $start_date = $_GET['start_date']; 
        $end_date = $_GET['end_date'];

         $insertResponse = $this->shop_model->AddComboOfferDetailsInsert($services,$combo_price,$shop_id,$offer_percent,$start_date,$end_date);
        $this->response($insertResponse);
    
    }




    }
