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

    

}
