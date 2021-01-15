<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class App extends REST_Controller
{
    public $device = "";
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        $this->load->library("applib", array("controller" => $this));
        $this->load->model("app_model");
    }

    /**
     * Generate OTP for the requested phone number
     */
    public function generateOtp_post()
    {
        $for = $this->input->get('for');
        $mobile = $this->checkEmptyParam($this->post('mobile'), 'Mobile');
        $validateMobile = $this->applib->checkMobile($mobile);
        if ($for === 'login' && empty($this->app_model->checkDealer($mobile))) {
            $this->response('', 404, 'fail', "Account doesn't exist . Please Signup");
        }
        if ($for === 'register' && !empty($this->app_model->checkDealer($mobile))) {
            $this->response('', 404, 'fail', "Mobile Number Exists");
        }
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }
        $otp = $this->cache->memcached->get($mobile);
        if (!$otp) {
            $otp = mt_rand(1000, 9999);
            $this->cache->memcached->save($mobile, $otp, 18000);
        }
        $msg = "Your MYDEALER Platform OTP is " . $otp;
        $sendSms = $this->applib->sendSms($msg, $mobile);
        if ($sendSms['status']) {
            $this->response(
                '',
                200
            );
        } else {
            $this->response('', 404, 'fail', $sendSms['message']);
        }
    }

    /**
     * Verify OTP for the requested phone number function
     *
     */
    public function verifyOtp_post()
    {
        $for = $this->input->get('for');
        $otp = $this->checkEmptyParam($this->post('otp'), 'OTP');
        $mobile = $this->checkEmptyParam($this->post('mobile'), 'Mobile');
        $validateMobile = $this->applib->checkMobile($mobile);
        if (!is_numeric($otp)) {
            $this->response('', 404, 'fail', 'Only Numbers accepted');
        }
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }
        $savedOtp = $this->cache->memcached->get($mobile);
        if ($savedOtp && $savedOtp == $otp) {
            if ($for === 'login') {
                if (empty($this->app_model->checkDealer($mobile))) {
                    $this->response('', 404, 'fail', "Please register");
                }
                $dealerData = $this->app_model->getDealer($mobile);
                $tokenData['dealer_id'] = $dealerData['dealer_id'];
                $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
                $jwtToken = $this->applib->generateToken($tokenData);
                $dealerData['token'] = $jwtToken;
                $this->response(
                    array('details' => $dealerData),
                    200,
                    'pass',
                    'Dealer logged in Successfully'
                );
            } else {
                if (!empty($this->app_model->checkDealer($mobile))) {
                    $this->response('', 404, 'fail', "Mobile Number Exists");
                }
                $this->response(
                    'OTP Verified',
                    200
                );
            }
        } elseif ($savedOtp && $savedOtp != $otp) {
            $this->response('', 404, 'fail', "Invalid OTP");
        } else {
            $this->response('', 404, 'fail', 'OTP Expired');
        }
    }

    /**
     * Register Dealer
     */
    public function registration_post()
    {
        $name = $this->checkEmptyParam(trim($this->post('name')), 'Name');
        $dealership = $this->checkEmptyParam(trim($this->post('dealership')), 'Dealership');
        $designation = $this->checkEmptyParam(trim($this->post('designation')), 'Designation');
        $brand = $this->checkEmptyParam($this->post('brand'), 'Brand');
        $address = $this->checkEmptyParam(trim($this->post('address')), 'Address');
        $number = $this->checkEmptyParam($this->post('number'), 'Number');
        $email = $this->checkEmptyParam($this->post('email'), 'Email');
        $otp = $this->checkEmptyParam($this->post('otp'), 'OTP');
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $this->response('', 404, 'fail', 'Invalid Name');
        }
        $validateMobile = $this->applib->checkMobile($number);
        if (!is_numeric($otp)) {
            $this->response('', 404, 'fail', 'Only Numbers accepted');
        }
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }
        if (!preg_match("/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/", $email)) {
            $this->response('', 404, 'fail', "Email address is invalid.");
        }
        if (!empty($this->app_model->checkDealer($number))) {
            $this->response('', 404, 'fail', "Mobile Number Exists");
        }
        $savedOtp = $this->cache->memcached->get($number);
        if ($savedOtp && $savedOtp == $otp) {
            $data = array('name' => $name, 'dealership' => $dealership, 'designation' => $designation, 'brand' => $brand, 'address' => $address, 'number' => $number, 'email' => $email);
            $dealerData = $this->app_model->addDealer($data);
            $tokenData['dealer_id'] = $dealerData['dealer_id'];
            $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
            $jwtToken = $this->applib->GenerateToken($tokenData);
            $dealerData['token'] = $jwtToken;
            $this->response(
                array('details' => $dealerData),
                200,
                'pass',
                'Dealer registered Successfully'
            );
        } elseif ($savedOtp && $savedOtp != $otp) {
            $this->response('', 404, 'fail', "Invalid OTP");
        } else {
            $this->response('', 404, 'fail', 'OTP Expired');
        }
    }

    /**
     * Get Brands
     */
    public function getBrands_get()
    {
        $data = $this->app_model->getBrands();
        $this->response(array(
            'brands' => $data,
        ), 200);
    }

    /** get list of the Models based on brand id
     *
     * @brand_name
     */
    public function getModels_get()
    {
        $brand_name = $this->get('brand_name');
        $data['models'] = $this->app_model->getModels($brand_name);
        $this->response($data);
    }

    /** get list of the Variants based on brand name and model Name
     *
     * @brand_name
     * @model_name
     */
    public function getVariantList_get()
    {
        $model_name = $this->get('model_name');
        $brand_name = $this->get('brand_name');
        $data['variant_list'] = $this->app_model->getVariants($brand_name, $model_name);
        $this->response($data);
    }

    /**
     * Get Lead in for Dashboard
     */
    public function getLeadData_get()
    {
        $dealerId = $this->applib->verifyToken();
        $month = $this->get('month');
        $year = $this->get('year');
        $data['all'] = $this->app_model->getLead('All', $dealerId, $month, $year);
        $data['open'] = $this->app_model->getLead('Open', $dealerId, $month, $year);
        $data['junk'] = $this->app_model->getLead('Junk Lead', $dealerId, $month, $year);
        $data['out_of_zone'] = $this->app_model->getLead('Out of Zone', $dealerId, $month, $year);
        $data['lead_lost'] = $this->app_model->getLead('Lead Lost', $dealerId, $month, $year);
        $data['call_back'] = $this->app_model->getLead('Call Back', $dealerId, $month, $year);
        $data['booked'] = $this->app_model->getLead('Booked', $dealerId, $month, $year);
        $data['cancelled'] = $this->app_model->getLead('Cancelled', $dealerId, $month, $year);
        $data['delivered'] = $this->app_model->getLead('Delivered', $dealerId, $month, $year);
        $this->response(
            array('lead_info' => $data),
            200
        );
    }
}
