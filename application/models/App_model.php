<?php

/**
 * All common DB-connection functions will be written here
 *
 *
 */

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

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
   * Check owner function
   *
   * @param int $mobile
   * @return array owner details
   */
  public function addDealer($data)
  {



    $dealerData = array('dealer_name' => $data['name'], 'dealers_name' => $data['dealership'], 'job_title' => $data['designation'], 'contact_no' => $data['number'], 'email_id' => $data['email'], 'address' => $data['address'], 'city' => $this->getCityFromAddress($data['address']), 'added_date' => getDateTime(), 'brand' => $data['brand']);

    $this->db->insert("dealer", $dealerData);

    $insert_id = $this->db->insert_id();

    $dealerLoginData = array('dealer_id' =>  $insert_id, 'sub_dealer_id' =>  $insert_id, 'email_id' => $data['email'], 'type' => 'dealer', 'added_date' => getDateTime(), 'status' => 1);

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
      } elseif (!empty($r['name_alias']) && preg_match("/" . $r['name_alias'] . "/ims", $address)) {
        $city = $r['name_alias'];
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
    return $this->db->select('brand_name,brand_id')
      ->get_where('brand', array('status' => 1))
      ->result_array();
  }
}
