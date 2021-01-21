<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dealer_model extends CI_Model
{
    /**
     * To get dealer profile data
     *
     * @param int $dealerId
     * @return array dealer details
     */
    public function getProfile($dealerId)
    {
        return $this->db->select('*')
            ->get_where('dealer', array('dealer_id' => $dealerId))
            ->row_array();
    }

    public function getLeadList()
    {
        return $this->db->select('DISTINCT(lead_id), full_name')->where('')->get('zoho_leads')->result_array();
    }

    public function insertNotes($note_data)
    {
        $this->db->insert('dealers_note', $note_data);
        $insert_id = $this->db->insert_id();
        return $insert_id ? "success" : "fail";
    }

    public function updateNotes($note_data)
    {
        $this->db->where('notes_id', $note_data['notes_id']);
        $this->db->update('dealers_note', $note_data);
        return 'updated';
    }

    public function getDealerNotes($dealer_id)
    {
        return $this->db->get_where('dealers_note', array('dealer_id' => $dealer_id))->result_array();
    }

    public function deleteNotes($note_id, $dealerId)
    {
        $where = ['notes_id' => $note_id, 'dealer_id' => $dealerId];
        $this->db->where($where);
        $this->db->delete('dealers_note');
        return "deleted";
    }

    public function getTestDriveCarList($dealer_id)
    {
        $this->db->select();
        $this->db->from();
        $this->db->join();
        return $this->db->get()->result_array();
    }

    public function getShowRoomInformation($dealer_id)
    {
        $this->db->select('dsl_id, person_name,mobile_number,location,status');
        $this->db->where('dealer_id', $dealer_id);
        return $this->db->get('dealer_showroom_location')->result_array();
    }

    public function insertShowroom($showroomData)
    {
        $this->db->insert('dealer_showroom_location', $showroomData);
        $showroom_id = $this->db->insert_id();
        return $showroom_id ? "success" : "failed";
    }

    public function updateShowroom($showroomData)
    {
        $this->db->where('dsl_id', $showroomData['dsl_id']);
        $this->db->update('dealer_showroom_location', $showroomData);
        return "updated";
    }

    public function deleteShowroom($showroom_id, $dealer_id)
    {
        $where = ['dsl_id' => $showroom_id, 'dealer_id' => $dealer_id];
        $this->db->where($where);
        $this->db->delete('dealer_showroom_location');
        return "deleted";
    }
}
