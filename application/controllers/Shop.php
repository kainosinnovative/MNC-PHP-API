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
        $model_id = $_GET['model_id'];
        $original_amount = $_GET['original_amount'];

         $insertResponse = $this->shop_model->AddComboOfferDetailsInsert($services,$combo_price,$shop_id,$offer_percent,$start_date,$end_date,$model_id,$original_amount);
        $this->response($insertResponse);
    
    }

    public function getComboOffersByShopid_get()
    {
        $currentUserId = $_GET["currentUserId"];
        $carShopservices['getComboOffersByShopid'] = $this->shop_model->getComboOffersByShopid($currentUserId);
        $this->response($carShopservices);
    }

    public function shopserviceByModelid_get()
{
    $currentUserId = $_GET["currentUserId"];
    $carShopservices['shopserviceByModelid'] = $this->shop_model->getshopserviceByModelid($currentUserId);
    $this->response($carShopservices);
}


public function combooffertblByModelid_get()
{
    $currentUserId = $_GET["currentUserId"];
    $model_id = $_GET["model_id"];
    $carShopservices['combooffertblByModelid'] = $this->shop_model->getcombooffertblByModelid($currentUserId,$model_id);
    $this->response($carShopservices);
}

public function dashboardShopList_get()
{
    $currentUserId = $_GET["cityid"];
    $carShopservices['dashboardShopList'] = $this->shop_model->getdashboardShopList($currentUserId);
    $this->response($carShopservices);
}


public function OnlineBookingShopDetails_get()
{
    $currentUserId = $_GET["currentUserId"];
    $carShopservices['OnlineBookingShopDetails'] = $this->shop_model->getOnlineBookingShopDetails($currentUserId);
    $this->response($carShopservices);
}

public function Updateshopoffer_get()
    {
        
        $service_id = $_GET['serviceid'];
        $shop_id = $_GET['currentUserId'];
        $offer_percent =   $_GET['offerpercent']; 
        $start_date = $_GET['fromdate']; 
        $end_date = $_GET['todate'];
        $model_id = $_GET['modelId']; 
        $lastupddt= $_GET['lastupddt'];
        $offer_price= $_GET['offer_amount'];
        
         $insertResponse = $this->shop_model->AddShopOfferDetails($service_id,$model_id,$lastupddt,$offer_price,$shop_id,$offer_percent,$start_date,$end_date);
        $this->response($insertResponse);
    }

    }
