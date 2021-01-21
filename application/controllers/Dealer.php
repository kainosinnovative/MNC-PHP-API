<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
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
    public function getProfileInfo_get()
    {
        $dealerId = $this->applib->verifyToken();
        $dealerData = $this->dealer_model->getProfile($dealerId);
        $this->response($dealerData, 200);

    }

    public function leadList_get()
    {

        $data['lead_list'] = $this->dealer_model->getLeadList();
        $this->response($data);
    }

    public function noteCreate_post()
    {
        $dealerId = $this->applib->verifyToken();
        $message = $this->post('message');
        $leadName = $this->post('lead');
        $note_data = array('message' => $message, 'lead_name' => $leadName, 'dealer_id' => $dealerId);
        $data['message'] = $this->dealer_model->insertNotes($note_data);
        $this->response($data);
    }

    public function noteEdit_post()
    {
        $dealerId = $this->applib->verifyToken();
        $note_id = $this->post('note_id');
        $message = $this->post('message');
        $leadName = $this->post('lead');
        $note_data = array('notes_id' => $note_id, 'message' => $message, 'lead_name' => $leadName, 'dealer_id' => $dealerId);
        $data['message'] = $this->dealer_model->updateNotes($note_data);
        $this->response($data);
    }

    public function noteDelete_get()
    {
        $dealerId = $this->applib->verifyToken();
        $note_id = $this->get('note_id');
        $data['message'] = $this->dealer_model->deleteNotes($note_id, $dealerId);
        $this->response($data);
    }

    public function note_get()
    {
        $dealer_id = $this->applib->verifyToken();
        $data['note_list'] = $this->dealer_model->getDealerNotes($dealer_id);
        $this->response($data);
    }

    public function getTestDriveCarList_get()
    {
        $dealer_id = $this->applib->verifyToken();
        $data['test_drive_car_list'] = $this->dealer_model->getTestDriveCarList($dealer_id);
        $this->response($data);
    }

    public function getShowRoomInformation_get()
    {
        $dealer_id = 309; //$this->applib->verifyToken();
        $showroom_data = $this->dealer_model->getShowRoomInformation($dealer_id);
        $this->response(array('showroom_data' => $showroom_data, 'no_showroom' => count($showroom_data)));
    }

    public function insertShowroom_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $person = $this->post('person_name');
        $mobile_number = $this->post('mobile_number');
        $location = $this->post('location');
        if (!preg_match("/^[a-zA-Z ]*$/", $person)) {
            $this->response('', 404, 'fail', 'Invalid Name');
        }
        if (empty($location)) {
            $this->response('', 404, 'fail', 'Please Enter Location');
        }
        $validateMobile = $this->applib->checkMobile($mobile_number);
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }

        $showroomData = array('dealer_id' => $dealer_id, 'person_name' => $person, 'mobile_number' => $mobile_number, 'location' => $location);
        $data['insert_showroom_status'] = $this->dealer_model->insertShowroom($showroomData);
        $this->response($data);
    }

    public function showroomEdit_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $showroom_id = $this->post('showroom_id');
        $person = $this->post('person_name');
        $mobile_number = $this->post('mobile_number');
        $location = $this->post('location');
        if (!preg_match("/^[a-zA-Z ]*$/", $person)) {
            $this->response('', 404, 'fail', 'Invalid Name');
        }
        if (empty($location)) {
            $this->response('', 404, 'fail', 'Please Enter Location');
        }
        $validateMobile = $this->applib->checkMobile($mobile_number);
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }
        $showroomData = array('dsl_id' => $showroom_id, 'dealer_id' => $dealer_id, 'person_name' => $person, 'mobile_number' => $mobile_number, 'location' => $location);
        $data['update_showroom_status'] = $this->dealer_model->updateShowroom($showroomData);
        $this->response($data);
    }

    public function deleteShowroom_get()
    {
        $showroom_id = $this->get('showroom_id');
        $dealer_id = $this->applib->verifyToken();
        $data['delete_showroom_status'] = $this->dealer_model->deleteShowroom($showroom_id, $dealer_id);
        $this->response($data);
    }

}
