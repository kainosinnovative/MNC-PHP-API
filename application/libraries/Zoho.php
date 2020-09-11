<?php

/**
 * All Zoho related manipulation will happen here
 *
 */

class Zoho {

  private $obj; //Parent class obj
  private $zoho_api_url;

  /**
   * To get existing access token
   *
   * @param string - access token
   */
  public function __construct($obj) {
    $this->obj          = $obj['controller'];
    $this->zoho_api_url = $this->obj->config->item('zoho_api_url');
  }

  /**
   * To get the Zoho API link
   *
   * @return String - API Link
   */
  public function getZohoAPILink()
  {
      return "";
  }

  /**
   * TO get the Access token 
   * 
   * @return string $access_token
   */
  public function getAccessToken() {
    $token_data = json_decode(file_get_contents("uploads/zoho_token.json"));

    if (!empty($token_data)) {
      $expiry_time  = strtotime("+55 minutes", strtotime($token_data->created_date));
      $access_token = $token_data->access_token;
      if (time() > $expiry_time) {
        $access_token = $this->getAccessTokenByRefreshToken();
      }
    } else {
      $access_token = $this->getAccessTokenByRefreshToken();
    }

    return $access_token;
  }

 /**
   * To get access new token from refreshed token
   * 
   * @return string - new access token
   */
  public function getAccessTokenByRefreshToken() {

    $refresh_token = $this->obj->config->item('refresh_token');
    $client_id     = $this->obj->config->item('Client_ID');
    $client_secret = $this->obj->config->item('Client_Secret');

    $url   = "https://accounts.zoho.com/oauth/v2/token?refresh_token=" . $refresh_token . "&client_id=" . $client_id . "&client_secret=" . $client_secret . "&grant_type=refresh_token";

    $result                = curlRequest($url,'POST');
    $final                 = json_decode($result, true);
    $final['created_date'] = getDateTime();
    $jsondata              = json_encode($final, JSON_PRETTY_PRINT);
    file_put_contents('uploads/zoho_token.json', $jsondata);

    return $final['access_token'];
  }

  /**
   * TO update record in zoho 
   * 
   * @param Int - $leadId
   * @param array    - $updateParams 
   */
  public function updateRecord($leadId,$updateParams) {
    $access_token = $this->getAccessToken();
    
    $header = array(
      'Authorization: Zoho-oauthtoken '.$access_token,
      'Content-Type: application/json'
    );
    $url      = $this->zoho_api_url . "crm/v2/Leads/".$leadId;
    $put_data = array("data" => array($updateParams));
    $response = curlRequest($url,'',$header,json_encode($put_data),'zoho');
    //$this->obj->activityLogger('Function : updateRecord, Params : leadId- '.$leadId.'params -'.json_encode($updateParams).'response : '.json_encode($response));
    return $response;
  }

  /**
   * To Search records from zoho DB
   * 
   *  @param string - $criteria
   */
  public function searchRecords($fields, $criteria) {
    $access_token = $this->getAccessToken();
    $header = array(
      'Authorization: Zoho-oauthtoken '.$access_token,
      'Content-Type: application/json'
    );
    $url = $this->zoho_api_url . "crm/v2/Leads/search?fields=".$fields."&criteria=".$criteria;
    $response = curlRequest($url,'',$header);
    //$this->obj->activityLogger('Function : searchRecords, Params : fields -'.$fields.'criteria : '.$criteria.'response : '.json_encode($response));
    return $response;
  }

  /**
   * To insert records in zoho DB
   * 
   *  @param string - $post_params
   */
  public function insertRecords($post_params) {

    if (ENVIRONMENT == "production") {
    $access_token = $this->getAccessToken();

    $header = array(
      'Authorization: Zoho-oauthtoken '.$access_token,
      'Content-Type: application/json'
    );

    $url       = $this->zoho_api_url . "crm/v2/Leads";
    $post_data = array("data" => array($post_params));
    $response  = curlRequest($url,json_encode($post_data),$header);
    //$this->obj->activityLogger('Function : insertRecords, Params : fields -'.json_encode($post_params).'response : '.$response);

    return $response;
  } else {
    return true;
  }
  }

   /**
   * Get Records by start and end
   * 
   * @param Int - $leadId
   */
  public function getRecords($st,$end) {
    $access_token = $this->getAccessToken();

   
    $header = array(
      'Authorization: Zoho-oauthtoken '.$access_token,
      'Content-Type: application/json'
    );

    $url      = $this->zoho_api_url."crm/v2/Leads?page=".$st."&per_page=".$end;
    $response = curlRequest($url,'',$header);
    //$this->obj->activityLogger('Function : getRecords, Params : fields -'.$end.'response : '.$response);


    return $response;
  }

  /**
   * Get Records by Modified Date
   * 
   * @param Int - $leadId
   */
  public function getRecordsByDate($date) {
    $access_token = $this->getAccessToken();

   
    $header = array(
      'Authorization: Zoho-oauthtoken '.$access_token,
      'Content-Type: application/json',
      'If-Modified-Since:'.$date
    );

    $url      = $this->zoho_api_url."crm/v2/Leads";
    $response = curlRequest($url,'',$header);
    //$this->obj->activityLogger('Function : getRecordByDate, Params : fields -'.$date.'response : '.$response);


    return $response;
  }

  /**
   * Get Records by Lead ID
   * 
   * @param Int - $leadId
   */
  public function getRecordById($leadId) {
    $access_token = $this->getAccessToken();

    $header = array(
      'Authorization: Zoho-oauthtoken '.$access_token,
      'Content-Type: application/json'
    );

    $url      = $this->zoho_api_url."crm/v2/Leads/".$leadId;
    $response = curlRequest($url,'',$header);
    //$this->obj->activityLogger('Function : getRecordById, Params : fields -'.$leadId.'response : '.$response);

    return $response;
  }


  public function zoho_automation($data, $real_data, $phone_num) {
    if(strtolower(ENVIRONMENT) != "production" ){
      return false;
    }
    /************ zoho new code *******************/
    $column_names = array('Mobile', 'Phone', 'Email');
    $lead_id = "";
    foreach($column_names as $k => $col){
      $criteria = '('.$col.':equals:'. $phone_num .')';
      $fields = 'First_Name,Last_Name,Email,Company,Mobile';
      $response = $this->searchRecords($fields, $criteria);
      if(!empty($response)){
        $responseArray = json_decode($response, TRUE);
        $lead_id = $responseArray['data'][0]['id'];
        break;
      }
    }
    if (empty($lead_id)) {
      $insert_params = $data;
      $insert_params['Notes'] = $real_data;
      $insert_params['Enquiry_Date'] = date("Y-m-d");
      $insert_params['Visitor_Comment'] = $real_data;
      $insert_response = $this->insertRecords($insert_params);
      return $insert_response;          
    } else {
      $updateParams['Lead_Status'] = 'Open';
      $updateParams['Visitor_Comment'] = $real_data;
      $update_response = $this->updateRecord($lead_id, $updateParams);
      return $update_response;          
    }
    /************* zoho new code end *************************/
    /************* zoho old code start *************************
    $email = trim(preg_replace('/[^0-9\-]/', '', $email));
    $email = substr($email, -10);
    $authtoken = "6a9246ede3e4dcfe1b1688cfc1df6c81";
    $url = "https://crm.zoho.com/crm/private/xml/Leads/getSearchRecords?";
    $query = "authtoken=" . $authtoken . "&scope=crmapi&newFormat=1&selectColumns=Leads(First Name,Last Name,Email,Company,Mobile)&searchCondition=(Mobile|=|" . $email . ")";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $response = trim(curl_exec($ch));
    if (strpos($response, 'There is no data to show') !== false) {
      $ch = curl_init('https://crm.zoho.com/crm/private/xml/Leads/insertRecords?');
      curl_setopt($ch, CURLOPT_VERBOSE, 1); //standard i/o streams 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Turn off the server and peer verification 
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set to return data to string ($response) 
      curl_setopt($ch, CURLOPT_POST, 1); //Regular post 
      $data = "<Leads><row no='1'>" . $data . "<FL val='Notes'>" . $real_data . "</FL><FL val='Enquiry_Date'>" . date('m/d/Y') . "</FL><FL val='Visitor_Comment'>" . $real_data . "</FL></row></Leads>";
      $xmlData2 = urlencode($data);
      $query = "newFormat=1&authtoken={$authtoken}&scope=crmapi&xmlData={$xmlData2}";
      curl_setopt($ch, CURLOPT_POSTFIELDS, $query); // Set the request as a POST FIELD for curl. 
      $response = curl_exec($ch);
    } else {
      $xml = simplexml_load_string($response);
      $json = json_encode($xml);
      $array = json_decode($json, TRUE);
      $lead_id = $array['result']['Leads']['row']['FL'][0];
      $ch = curl_init('https://crm.zoho.com/crm/private/xml/Leads/updateRecords?');
      curl_setopt($ch, CURLOPT_VERBOSE, 1); //standard i/o streams 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Turn off the server and peer verification 
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set to return data to string ($response) 
      curl_setopt($ch, CURLOPT_POST, 1); //Regular post 
      $data = "<Leads><row no='1'><FL val='Lead Status'>Open</FL><FL val='Visitor_Comment'>" . $real_data . "</FL></row></Leads>";
      $xmlData2 = urlencode($data);
      $query = "newFormat=1&authtoken={$authtoken}&scope=crmapi&id=$lead_id&xmlData={$xmlData2}";
      curl_setopt($ch, CURLOPT_POSTFIELDS, $query); // Set the request as a POST FIELD for curl. 
      $response = curl_exec($ch);
    }
    /************* zoho old code start *************************/
  }
/**
 * Format the V2 api parameters as per current table format
 * 
 */
public function formatParams($finalData,$key,$value) {

  $key1 = "";
  $value1 = "";
  $updateQuery = "";

  if($key == 'id'){
    $key = 'LEADID';
} else if($key == 'Owner') {
    $key = 'SMOWNERID';
    $value = $finalData['Owner']['id'];
} else if($key == 'Allocated Dealer 1') {
  if(!empty($value)){
      $value = $finalData['Allocated_Dealer_1']['name'];
      $key1 = ',`Allocated Dealer 1_ID`';
      $value1 = ','.$finalData['Allocated_Dealer_1']['id'];
      $updatekey1 = '`Allocated Dealer 1_ID`';
      $updatevalue1 = $finalData['Allocated_Dealer_1']['id'];
      $updateQuery = ''.$updatekey1.'='.$updatevalue1.',';  
    }
} else if($key == 'Allocated Dealer 2') {
    if(!empty($value)){
        $value = $finalData['Allocated_Dealer_2']['name'];
        $key1 = ',`Allocated Dealer 2_ID`';
        $value1 = ','.$finalData['Allocated_Dealer_2']['id'];
        $updatekey1 = '`Allocated Dealer 2_ID`';
        $updatevalue1 = $finalData['Allocated_Dealer_2']['id'];
        $updateQuery = ''.$updatekey1.'='.$updatevalue1.',';
    }
  }  else if($key == 'Allocated Dealer 3') {
    if(!empty($value)){
        $value = $finalData['Allocated_Dealer_3']['name'];
        $key1 = ',`Allocated Dealer 3_ID`';
        $value1 = ','.$finalData['Allocated_Dealer_3']['id'];
        $updatekey1 = '`Allocated Dealer 3_ID`';
        $updatevalue1 = $finalData['Allocated_Dealer_3']['id'];
        $updateQuery = ''.$updatekey1.'='.$updatevalue1.',';
    }
  }   else if($key == 'Allocated Dealer 4') {
    if(!empty($value)){
        $value = $finalData['Allocated_Dealer_4']['name'];
        $key1 = ',`Allocated Dealer 4_ID`';
        $value1 = ','.$finalData['Allocated_Dealer_4']['id'];
        $updatekey1 = '`Allocated Dealer 4_ID`';
        $updatevalue1 = $finalData['Allocated_Dealer_4']['id'];
        $updateQuery = ''.$updatekey1.'='.$updatevalue1.',';
    }
  }   else if($key == 'Created By') {
    if(!empty($value)){
        $value = $finalData['Created_By']['name'];
        $key1 = ',`SMCREATORID`';
        $value1 = ','.$finalData['Created_By']['id'];
        $updatekey1 = '`SMCREATORID`';
        $updatevalue1 = $finalData['Created_By']['id'];
        $updateQuery = ''.$updatekey1.'='.$updatevalue1.',';
    }
  }   else if($key == 'Modified By') {
    if(!empty($value)){
        $value = $finalData['Modified_By']['name'];
        $key1 = ',`MODIFIEDBY`';
        $value1 = ','.$finalData['Modified_By']['id'];
        $updatekey1 = '`MODIFIEDBY`';
        $updatevalue1 = $finalData['Modified_By']['id'];
        $updateQuery = ''.$updatekey1.'='.$updatevalue1.',';
    }
  } 

  $changeParams = array($key1,$value1,$updateQuery,$key,$value);

  

  return $changeParams;
  
}
} 

