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
        return $this->db->select('DISTINCT(lead_id), full_name')->get('zoho_leads')->result_array();
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
}
