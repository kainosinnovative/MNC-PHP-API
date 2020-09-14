<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Test extends REST_Controller
{
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->country_code = 'IN';
        $this->load->model("app_model");
        $this->load->library("applib", array("controller" => $this));

    }

    /**
     * get otp manually function
     *
     * @return int $otp
     */
    public function otp_post()
    {
        $mobile = $this->post('mobile');
        if ($this->cache->memcached->get($mobile)) {
            $otp = $this->cache->memcached->get($mobile);
            $this->response($otp, 200, 'pass', 'OTP for ' . $mobile);
        } else {
            $this->response('', 404, 'fail', 'Invalid Number');
        }
    }

    public function test_get()
    {
        $tokenData['dealer_id'] = '11';
        $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
        $jwtToken = $this->applib->GenerateToken($tokenData);
        echo json_encode(array('Token'=>$jwtToken));
    }
}
