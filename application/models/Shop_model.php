<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shop_model extends CI_Model
{

    public function getSingleShopById($shop_id)
    {
        $this->db->select('*');
        $this->db->from('shopinfo');
        $this->db->where('shop_id', $shop_id);
        return $this->db->get()->row_array();
    }
}