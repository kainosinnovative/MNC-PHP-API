<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
}
