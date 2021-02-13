<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_model extends CI_Model
{

    /**
     * Check owner function
     *
     * @param int $mobile
     * @return array owner details
     */
    public function checkDealer($mobile)
    {
        return $this->db->select('dealer_id')
            ->get_where('dealer', array('contact_no' => $mobile))
            ->row();
    }

    /**
     * Check owner function
     *
     * @param int $mobile
     * @return array owner details
     */
    public function getDealer($mobile)
    {
        return $this->db->select('*')
            ->get_where('dealer', array('contact_no' => $mobile))
            ->row_array();
    }

    /**
     * To Add dealer
     *
     * @param Array $data - dealer details
     * @return array dealer details
     */
    public function addDealer($data)
    {
        $dealerData = array('dealer_name' => $data['name'], 'dealers_name' => $data['dealership'], 'job_title' => $data['designation'], 'contact_no' => $data['number'], 'email_id' => $data['email'], 'address' => $data['address'], 'city' => $this->getCityFromAddress($data['address']), 'added_date' => getDateTime(), 'brand' => $data['brand']);
        $this->db->insert("dealer", $dealerData);
        $insert_id = $this->db->insert_id();
        $dealerLoginData = array('dealer_id' => $insert_id, 'sub_dealer_id' => $insert_id, 'email_id' => $data['email'], 'type' => 'dealer', 'added_date' => getDateTime(), 'status' => 1);
        $this->db->insert("dealer_login", $dealerLoginData);
        if (empty($this->checkOwner($data['number']))) {
            $ownerData = array('owner_full_name' => $data['name'], 'first_name' => $data['name'], 'owner_phone' => $data['number'], 'owner_email' => $data['email'], 'owner_address' => $data['address'], 'city' => $this->getCityFromAddress($data['address']), 'added_date' => getDateTime());
            $userData = array('firstname' => $data['name'], 'telephone' => $data['number'], 'email' => $data['email'], 'address' => $data['address'], 'city' => $this->getCityFromAddress($data['address']), 'date_added' => getDateTime());
            $this->db->insert("test_drive_car_owners", $ownerData);
            $this->db->insert("user", $userData);
        }
        return $this->db->select('*')
            ->get_where('dealer', array('dealer_id' => $insert_id))
            ->row_array();
    }

    /**
     * Check owner function
     *
     * @param int $mobile
     * @return array owner details
     */
    public function checkOwner($mobile)
    {
        return $this->db->select('owner_id,authtoken,owner_full_name,owner_email,name1,phn1')
            ->get_where('test_drive_car_owners', array('owner_phone' => $mobile))
            ->row_array();
    }

    /**
     * Get City from address
     *
     * @return string city
     */
    public function getCityFromAddress($address)
    {
        if (empty($address)) {
            return "";
        }
        $city = "";
        $all_cities = $this->db->select("name, name_alias")->from("city")->where("country_id", 252)->get()->result_array();
        foreach ($all_cities as $r) {
            if (preg_match("/" . $r['name'] . "/ims", $address)) {
                $city = $r['name'];
                break;
            } elseif (!empty($r['name_alias'])) {
                if (preg_match("/" . $r['name_alias'] . "/ims", $address)) {
                    $city = $r['name_alias'];
                }
                break;
            }
        }
        return $city;
    }

    /**
     * Get Brands
     *
     *
     * @return array brands
     */
    public function getBrands()
    {
        $this->db->select('brand_name,brand_id');
        $this->db->join('model m', 'b.brand_id = m.brand_id and m.status = 1');
        return $this->db->get_where('brand b', array('status' => 1))->result_array();

    }
/**
 * Get Models by brand_id
 *
 * @brand
 * @return array Models
 */
    public function getModels($brand)
    {
        $this->db->select('model_id, model_name');
        //$this->db->from('model m');
        //$this->db->join('brand b', 'b.brand_id = m.brand_id and b.status = 1');
        $this->db->where('brand_id', $brand);
        $this->db->where('status', 1);
        return $this->db->get('model')->result_array();
    }
    /**
     * Get Variant by brand id and model id
     *
     * @brand_id
     * @model_id
     * @return array Variants
     */

    public function getVariants($brand, $model)
    {
        $this->db->select('variant_id, variant, pro_name');
        $this->db->where('brand_id', $brand);
        $this->db->where('model_id', $model);
        $this->db->where('status', 1);
        return $this->db->get('variant')->result_array();
    }

    /**
     * To get lead status based counts
     *
     * @param string $status - lead status
     * @param int $dealerId
     * @param int $month
     * @param int $year
     * @return array counts array
     */
    public function getLead($status, $dealerId, $month, $year, $endDate)
    {
        //$dealerId = 148;
        $this->db->select('COALESCE(SUM(id), 0) as count');
        if ($status !== 'All') {
            $this->db->where('status', $status);
        }
        $this->db->where('dealer_id', $dealerId);
        // $this->db->where('added_date >=', $endDate);
        $this->db->where('MONTH(added_date)', $month);
        $this->db->where('YEAR(added_date)', $year);
        //
        return $this->db->get("zoho_dealer_data_status")->row()->count;
    }

    public function getLeadPipeline($status, $dealerId, $month, $year, $user, $showroom, $rating, $byDate, $startDate, $endDate)
    {
        $dealerId = 148;

        $this->db->select('zl.full_name, zl.potential_car, zl.followup_date, zl.mobile, zd.verify_status');
        $this->db->from('zoho_dealer_data_status zd');
        $this->db->join('zoho_leads zl', 'zd.zoho_lead_id = zl.lead_id');
        $user ? $this->db->where('zl.full_name', $user) : '';
        $showroom ? $this->db->where('zl.showroom', $showroom) : '';
        $rating ? $this->db->where('', $rating) : '';
        $byDate ? $this->db->where('', $byDate) : '';
        $startDate ? $this->db->where('added_date >= ', $startDate) : '';
        $endDate ? $this->db->where('added_date <= ', $endDate) : '';
        if ($status !== 'All') {
            $this->db->where('status', $status);
        }
        $this->db->where('dealer_id', $dealerId);
        // $this->db->where('added_date >=', $endDate);
        $this->db->where('MONTH(added_date)', $month);
        $this->db->where('YEAR(added_date)', $year);
        //
        return $this->db->get()->result_array();
    }

    public function getOverview($dealer_id)
    {
        $this->db->select('d.dealer_name, b.brand_name, d.city, d.contact_no, d.email_id');
        $this->db->from('dealer d');
        $this->db->join('brand b', 'b.brand_id= d.brand and b.status = 1', 'left');
        $this->db->where('d.dealer_id', $dealer_id);
        $this->db->where('d.status', 1);
        return $this->db->get()->row_array();
    }

    /**  dealer profile
     *   return profile path
     */
    /*  public function getProfile($dealer_id) {
    $this->db->select();

    ->where()->get()->row_array()
    } */

    public function updateProfile($path, $dealer_id)
    {
        /*  print_r($path);
        print_r($dealer_id);
        exit; */
        $this->db->where('dealer_id', $dealer_id);
        $this->db->update('dealer', array('profile' => $path));
        return "updated";
    }
}
