<?php

/**
 * This library will decide about the APP logics
 *
 *
 */

//error_reporting(-1);
//ini_set('display_errors', 'On');

class Rewardslib
{

    public $obj;
    protected $country_id = "";
    /**
     * To set constructor of parent controller
     *
     * @param Object - $parent_controller -> Object of parent controller
     */

    public function __construct($parent_controller)
    {
        $this->obj = $parent_controller['controller'];
        $this->country_code = $this->obj->country_code;
    }

    public function mapCity($city, $owner, $location)
    {
        $mapped_city = $this->mappedCity($city);

        $check_rewards_city = $this->db->select('DISTINCT  `city`')->from('trivz_rewards')->where('city', $city)->row_array();
        /// Rewards only for indian country
        $full_name = $this->obj->owner_full_name;
        if ($this->obj->country_code == 'IN' && (!preg_match("/test/ims", $full_name))) {
            if (empty($mapped_city['mapped_city']) && empty($check_rewards_city['city'])) {
                $this->db->insert('new_owner_city_mapping', array('owner_id' => $owner));
            }
        }

        $url = WEB_ADMIN_URL . "city-mapping?owner_id=" . $owner;
        $params = array('owner_full_name' => $full_name, 'city' => $city, 'owner_phone' => $this->obj->owner_phone, 'owner_address' => $location, 'url' => $url);
        $params1 = array('owner_full_name' => $full_name);
        $str2InsideData = $this->obj->content_translation('crm_new_city_mapping_content', $params);
        $this->obj->applib->sendMail("sbhuia@mynewcar.in", $this->obj->content_translation('crm_new_city_mapping', $params1), $str2InsideData);

    }

    public function mappedCity($city)
    {
        $this->db->select('mapped_city');
        $this->db->where('mapped_city', $city);
        return $this->db->get('new_city_mapping')->row_array();
    }

    public function checkRewards()
    {
        return $this->obj->db->select("*")->from('test_drive_earning')->where('owner_id', $this->obj->owner_id)->where('message', 'Registration Reward')->get()->result_array();
    }

    public function getRewards($city, $car)
    {
        $getreward_two = $this->obj->db->select('tr.*')
            ->from('trivz_rewards as  tr')
            ->join('new_city_mapping ncm', 'tr.city = ncm.city', 'left')
            ->group_start()
            ->where('tr.city', $city)
            ->or_where('ncm.mapped_city', $city)
            ->group_end()
            ->where('tr.reward_type', 2)
            ->where('tr.status', 1)
            ->group_by('reward_id')
            ->get()
            ->result_array();

        $getreward = array();
        foreach ($getreward_two as $gt) {
            if (preg_match("/" . $gt['car_name'] . "/ims", $car)) {
                $getreward[] = $gt;
            }
        }

        return $getreward;
    }

    public function addRewards($city, $car)
    {
        if (count($this->checkRewards()) == 0) {
            $ownerMapped = $this->checkOwnerMapped();
            if (empty($ownerMapped)) {
                $getrewards = $this->getRewards($city, $car);
                if (count($getrewards) > 0) {
                    foreach ($getrewards as $gr) {
                        $this->obj->db->insert('test_drive_earning', array(
                            'amount' => $gr['amount'],                                                  'owner_id' => $this->obj->owner_id,
                            'added_date' => getDateTime(),
                            'message' => 'Registration Reward',
                            'gift_message' => $gr['reward']
                        ));
                    }
                } else {
                    if ($this->obj->country_code == "in") {
                        $this->obj->db->insert('test_drive_earning', array(
                            'amount' => 1500,                                                  'owner_id' => $this->obj->owner_id,
                            'added_date' => getDateTime(),
                            'message' => 'Registration Reward',
                            'gift_message' => '1 yr Road Side Assistance of Rs.1500.'
                        ));
                        $this->obj->db->insert('test_drive_earning', array(
                            'amount' => 5000,                                                  'owner_id' => $this->obj->owner_id,
                            'added_date' => getDateTime(),
                            'message' => 'Registration Reward',
                            'gift_message' => 'Holiday Voucher upto Rs.5000.'
                        ));
                    }
                }
            } 
        }
    }

    public function checkOwnerMapped()
    {
        return $this->obj->db->select('*')->from('new_owner_city_mapping')->where('owner_id', $this->obj->owner_id)->get()->row_array();
    }
}
