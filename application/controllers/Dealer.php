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
        $this->load->helper('download');
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
        $test_drive_car_list = $this->dealer_model->getTestDriveCarList($dealer_id);
        $showroom_count = $this->dealer_model->getShowRoomInformation($dealer_id);
        $this->response(array('test_drive_car_list' => $test_drive_car_list, 'show_room_count' => count($showroom_count)));
    }

    public function createTestDriveCar_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $brand = $this->post('brand');
        $model = $this->post('model');
        $variant = $this->post('variant');
        $registration_no = $this->post('registration_no');
        $manufacturing_year = $this->post('year');
        $address = $this->post('address');
        $lang = $this->post('long');
        $lant = $this->post('lant');
        $person_name = $this->post('person_name');
        $mobile_number = $this->post('mobile_number');

        if (empty($person_name)) {
            $this->response('', 404, 'fail', 'Please Enter Name');
        }
        if (empty($address)) {
            $this->response('', 404, 'fail', 'Please Enter Address');
        }
        if (empty($lang) || !is_numeric($lang)) {
            (empty($lang)) ? $this->response('', 404, 'fail', 'Please enter Longitude') : $this->response('', 404, 'fail', 'Longitude should be numeric');
        }

        if (empty($lant) || !is_numeric($lant)) {
            (empty($lant)) ? $this->response('', 404, 'fail', 'Please enter Latitude') : $this->response('', 404, 'fail', 'Latitude should be numeric');
        }

        $validateMobile = $this->applib->checkMobile($mobile_number);
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }

        $variant_data = $this->dealer_model->getVariantDetails($variant);
        $dealer_data = $this->dealer_model->getDealerData('owner_id', $dealer_id, 'test_drive_car_owners');

        $where = array('brand_model' => $brand . ' ' . $model, 'fuel' => $variant_data['fuel_type'], 'transmission' => $variant_data['tramission_type'], 'varaint' => $variant, 'year' => $manufacturing_year, /* 'registeration_no' => $registration_no, */'owner_id' => $dealer_data['owner_id'], 'long' => $lang, 'lant' => $lant);
        if ($this->dealer_model->checkTestDriveCar($where)) { // if data get from table the that car exist
            return $this->response('', 404, 'fail', 'Car details already exist');
        } else {
            $test_car_data = array('brand_model' => $brand . ' ' . $model, 'car_full_name' => $brand . ' ' . $model . ' ' . $variant, 'varaint' => $variant, 'fuel' => $variant_data['fuel_type'], 'transmission' => $variant_data['tramission_type'], 'registeration_no' => $registration_no, 'color' => '', 'owner_id' => $dealer_data['owner_id'], 'year' => $manufacturing_year, 'person_name' => $person_name, 'contact_number' => $mobile_number, 'long' => $lang, 'lant' => $lant);
            $data['insert_testDriveCar_status'] = $this->dealer_model->createTestDriveCar($test_car_data, $dealer_id);
            $this->response($data);
        }
    }

    public function editTestDriveCar_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $test_drive_id = $this->post('test_drive_id');
        $brand = $this->post('brand');
        $model = $this->post('model');
        $variant = $this->post('variant');
        $registration_no = $this->post('registeration_no');
        $manufacturing_year = $this->post('year');
        $address = $this->post('address');
        $person_name = $this->post('person_name');
        $mobile_number = $this->post('mobile_number');
        $lang = $this->post('long');
        $lant = $this->post('lant');

        if (empty($person_name)) {
            $this->response('', 404, 'fail', 'Please Enter Name');
        }
        if (empty($address)) {
            $this->response('', 404, 'fail', 'Please Enter Address');
        }
        if (empty($lang) || !is_numeric($lang)) {
            (empty($lang)) ? $this->response('', 404, 'fail', 'Please enter Longitude') : $this->response('', 404, 'fail', 'Longitude should be numeric');
        }
        if (empty($lant) || !is_numeric($lant)) {
            (empty($lant)) ? $this->response('', 404, 'fail', 'Please enter Latitude') : $this->response('', 404, 'fail', 'Latitude should be numeric');
        }
        $validateMobile = $this->applib->checkMobile($mobile_number);
        if (!$validateMobile['status']) {
            $this->response('', 404, 'fail', $validateMobile['message']);
        }

        $variant_data = $this->dealer_model->getVariantDetails($variant);
        $dealer_data = $this->dealer_model->getDealerData('owner_id', $dealer_id, 'test_drive_car_owners');

        $where = array('brand_model' => $brand . ' ' . $model, 'fuel' => $variant_data['fuel_type'], 'transmission' => $variant_data['tramission_type'], 'varaint' => $variant, 'year' => $manufacturing_year, /* 'registeration_no' => $registration_no, */'owner_id' => $dealer_data['owner_id'], 'long' => $lang, 'lant' => $lant);
        if ($this->dealer_model->checkTestDriveCar($where, $test_drive_id)) { // if data get from table the that car exist
            return $this->response('', 404, 'fail', 'Car details already exist');
        } else {
            $test_car_data = array('id' => $test_drive_id, 'brand_model' => $brand . ' ' . $model, 'car_full_name' => $brand . ' ' . $model . ' ' . $variant, 'varaint' => $variant, 'fuel' => $variant_data['fuel_type'], 'transmission' => $variant_data['tramission_type'], 'registeration_no' => $registration_no, 'color' => '', 'owner_id' => $dealer_data['owner_id'], 'year' => $manufacturing_year, 'person_name' => $person_name, 'contact_number' => $mobile_number, 'long' => $lang, 'lant' => $lant);
            $data['insert_testDriveCar_status'] = $this->dealer_model->editTestDriveCar($test_car_data, $dealer_id);
            $this->response($data);
        }

    }

    public function deleteTestDriveCar_get()
    {
        $dealer_id = $this->applib->verifyToken();
        $test_drive_car_id = $this->get('test_drive_car_id');
        $data['delete_testDriveCar_status'] = $this->dealer_model->deleteTestDriveCar($test_drive_car_id, $dealer_id);
        $this->response($data);
    }

    public function getShowRoomInformation_get()
    {
        $dealer_id = $this->applib->verifyToken();
        $showroom_data = $this->dealer_model->getShowRoomInformation($dealer_id);
        $this->response(array('showroom_data' => $showroom_data, 'no_showroom' => count($showroom_data)));
    }

    public function insertShowroom_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $person = $this->post('person_name');
        $mobile_number = $this->post('mobile_number');
        $location = $this->post('location');
        if (empty($person)) {
            $this->response('', 404, 'fail', 'PLease Enter Name');
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
        if (empty($person)) {
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

    public function getAttachmentData_get()
    {
        $dealer_id = $this->applib->verifyToken();
        $data['attachments_list'] = $this->dealer_model->getAttachmentData($dealer_id);
        $this->response($data);
    }

    public function downloadAttachment_get()
    {
        $attachment_id = $this->get('attachment_id');
        $path = $this->db->select('attached_path')->get_where('new_dealer_attachment', array('dealer_attach_id' => $attachment_id))->row('attached_path');
        $file = 'http://' . $_SERVER["SERVER_ADDR"] . '/MYDEALER-API' . $path;
        $filename = explode('/', $path);
        $pth = file_get_contents($file);
        force_download($filename[2], $pth);
    }

    public function insertAttachments_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $category = $this->post('category');
        $attach_by = $this->post('attach_by');

        if (empty($category)) {
            $this->response('', 404, 'fail', 'Please Enter Category');
        }
        if (empty($attach_by)) {
            $this->response('', 404, 'fail', 'Please Enter Attachment By');
        }
        $config['upload_path'] = './uploads/attachments';
        $config['allowed_types'] = 'pdf|txt';
        $config['max_size'] = '11048';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('attachments')) {
            $uploadData = $this->upload->data();
            $file = $uploadData['file_name'];
            $path = '/uploads/attachments/' . $file; //base_url('/uploads/profile/'). $picture
            $attachment_data = array('dealer_id' => $dealer_id, 'category' => $category, 'attached_by' => $attach_by, 'attached_path' => $path, 'added_date' => Date('Y-m-d h:i:s'));
            $data['inserted_attachment_status'] = $this->dealer_model->insertData($attachment_data, 'new_dealer_attachment');

        } else {
            $this->response('', 404, 'fail', $this->upload->display_errors());
        }
        $this->response($data);
    }

    public function updateAttachments_post()
    {
        $dealer_id = $this->applib->verifyToken();
        $category = $this->post('category');
        $attach_by = $this->post('attach_by');
        $attachment_id = $this->post('attachment_id');
        if (empty($category)) {
            $this->response('', 404, 'fail', 'Please Enter Category');
        }
        if (empty($attach_by)) {
            $this->response('', 404, 'fail', 'Please Enter Attachment By');
        }
        $config['upload_path'] = './uploads/attachments';
        $config['allowed_types'] = 'pdf|txt';
        $config['max_size'] = '11048';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('attachments')) {
            $uploadData = $this->upload->data();
            $file = $uploadData['file_name'];
            $path = '/uploads/attachments/' . $file; //base_url('/uploads/profile/'). $picture
            $attachment_data = array('dealer_attach_id' => $attachment_id, 'dealer_id' => $dealer_id, 'category' => $category, 'attached_by' => $attach_by, 'attached_path' => $path, 'added_date' => Date('Y-m-d h:i:s'));
            $data['update_attachment_status'] = $this->dealer_model->updateData($attachment_data, 'new_dealer_attachment', array('dealer_attach_id' => $attachment_id, 'dealer_id' => $dealer_id));

        } else {
            $this->response('', 404, 'fail', $this->upload->display_errors());
        }
        $this->response($data);
    }

    public function deleteAttachment_get()
    {
        $dealer_id = $this->applib->verifyToken();
        $attachment_id = $this->get('attachment_id');
        $data['delete_showroom_status'] = $this->dealer_model->deleteData('new_dealer_attachment', array('dealer_attach_id' => $attachment_id, 'dealer_id' => $dealer_id));
        $this->response($data);
    }
}
