<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class App extends REST_Controller
{
    public $device = "";
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        //$this->authorization(); //APP Authorization and setting up global variables
        $this->load->library("applib", array("controller" => $this));
        $this->load->model("app_model");
    }

    /**
     * Called this to log the entire API Hit
     *
     */
    public function __destruct()
    {
        $this->applib->standardizedApi();
    }

    /**
     * Generate OTP for the requested phone number function
     *
     * @param int - $mobile - Mobile Number
     * @param string - $country_code - Country Code
     * @return string pass if success || fail
     */
    public function generateOtp_post()
    {
        $mobile  =  $this->checkEmptyParam($this->post('mobile'), 'Mobile');
        $validateMobile = $this->applib->checkMobile($mobile);
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }
        $otp     = $this->cache->memcached->get($mobile);
        if (!$otp) {
            $otp = mt_rand(1000, 9999);
            $this->cache->memcached->save($mobile, $otp, 1800);
        }
        $msg     = "Your MYDEALER Platform OTP is " . $otp;
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
     * @return string 
     */
    public function verifyOtp_post()
    {
        $for = $this->input->get('for');
        $otp       =  $this->checkEmptyParam($this->post('otp'), 'OTP');
        $mobile    =  $this->checkEmptyParam($this->post('mobile'), 'Mobile');
        $validateMobile = $this->applib->checkMobile($mobile);
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }
        if(!empty($this->app_model->checkDealer($mobile))){
            $this->response('', 404, 'fail', "Mobile Number Exists");
        }
        $savedOtp  = $this->cache->memcached->get($mobile);
        if ($savedOtp && $savedOtp == $otp) {

            if($for === 'login'){

            }else{
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

    public function registration_post() {
        $name = $this->checkEmptyParam($this->post('name'), 'Name');
        $dealership = $this->checkEmptyParam($this->post('dealership'), 'Dealership');
        $designation = $this->checkEmptyParam($this->post('designation'), 'Designation');
        $brand = $this->checkEmptyParam($this->post('brand'), 'Brand');
        $address = $this->checkEmptyParam($this->post('address'), 'Address');
        $number = $this->checkEmptyParam($this->post('number'), 'Number');
        $email = $this->checkEmptyParam($this->post('email'), 'Email');
        $otp       =  $this->checkEmptyParam($this->post('otp'), 'OTP');


        if(!empty($this->app_model->checkDealer($number))){
            $this->response('', 404, 'fail', "Mobile Number Exists");
        }
        $savedOtp  = $this->cache->memcached->get($number);
        if ($savedOtp && $savedOtp == $otp) {
        
            $data = array('name'=> $name, 'dealership' => $dealership, 'designation' => $designation, 'brand' => $brand, 'address' => $address, 'number' => $number, 'email' => $email);
            $dealerData = $this->app_model->addDealer($data);

            $this->response(
                array('details'=>$dealerData),
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
    }
