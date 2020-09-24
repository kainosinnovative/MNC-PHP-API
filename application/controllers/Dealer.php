<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');
class Dealer extends REST_Controller
{
    public $device = "";
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        $this->load->library("applib", array("controller" => $this));
        $this->load->model("dealer_model");
    }

    /**
     * To get the dealer info
     *
     * @return void
     */
    public function getProfileInfo_get(){
        $dealerId = $this->applib->verifyToken();
        $dealerData = $this->dealer_model->getProfile($dealerId);
        $this->response($dealerData,200);

    }

}
