<?php

/**
 * This library will decide about the APP logics
 *
 *
 */

//error_reporting(-1);
//ini_set('display_errors', 'On');
require APPPATH . '/libraries/JWT.php';


class Applib
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
  }

  /*************This function generate token private key**************/ 

  PRIVATE $key = "MNCDEALERLOGIN"; 
  public function GenerateToken($data)
  {          
      $jwt = JWT::encode($data, $this->key);
      return $jwt;
  }
  

 /*************This function DecodeToken token **************/

  public function DecodeToken()
  {      
    $datas = $this->obj->input->request_headers();
    $token = isset($datas['token']) ? $datas['token'] : '';
    if(empty($token)){
      $this->obj->response('You must login to use this service', 401);
    }
    $tks = explode('.', $token);
        if (count($tks) != 3) {
          $this->obj->response('You must login to use this service', 401);
        }    
      $decoded = JWT::decode($token, $this->key, array('HS256'));
      $decodedData = (array) $decoded;
      if(empty($decodedData['dealer_id'])){
        $this->obj->response('You must login to use this service', 401); 
      }
      return $decodedData['dealer_id'];
  }

 
  /**
   * Send Text Message
   *
   * @param array  $message
   * @param string $mobile
   * @return void
   */
  public function sendSms($message, $mobile)
  {
    if (!empty($message) || !empty($mobiles)) {
    
        $message = urlencode($message); //For indian SMS only
        $postData = array(
          'authkey' => IN_SMS_AUTH_KEY,
          'mobiles' => '91' . $mobile,
          'message' => $message,
          'sender' => IN_SMS_SOURCE,
          'country' => 0,
          'route' => 4
        );
        $response = curlRequest(IN_SMS_URL, $postData);
        return $response != IN_SMS_SUCC_TEXT ? array(
          'status' => true,
          'message' => $response
        ) :  array(
          'status' => false,
          'message' => $response
        );
      
      $data = array(
        'mobiles' => $mobile,
        'message' => $message,
        'sms_provider_status' => $response,
        'created_by' => $this->ownerId
      );
      $this->obj->db->insert('new_send_sms', $data);
    } else {
      return array(
        'status' => false,
        'message' => 'Message/Mobile is empty'
      );
    }
  }

  /**
   * To send email
   *
   * @param String - $email -> To send email-id
   * @param String - $fromemail -> Received by email
   * @param String - $cc -> CC of the email
   * @param String - $bcc -> BCC of the email
   * @param String - $subject -> Subject of the email
   * @param String - $content -> Content to be printed
   */
  public function sendMail($email, $subject, $content, $fromemail = 'contacttrivz@mynewcar.in', $cc = '', $bcc = '', $mnc = '', $attachments = '')
  {
    //echo $content;die;
    // if (!$mnc) {
    //   $content = $this->createEmailView($content);
    // }

   


    if ($this->obj->country_code == "DE") {
      $fromemail = 'trivz@moll.de';


      $to_mail = explode(',', $email);
      $data = array(
        "recipients" => array(
          array('address' => array('email' => 'developer9@mynewcar.in')),
          array('address' => array('email' => 'developer3@mynewcar.in')),
          array('address' => array('email' => 'ppadhi@mynewcar.in')),
          array('address' => array('email' => 'testanalyst@mynewcar.in')),
          array('address' => array('email' => 'testanalyst1@mynewcar.in'))
        ),
        "content" => array(
          "from" => $fromemail,
          "return_path" => $fromemail,
          'subject' => $subject,
          'html' => $content,
          'text' => strip_tags($content),

        )
      );
      if ($attachments != '') {
        $data['content']['attachments'] = [$attachments];
      }
      $data['other']['bcc'] = $bcc; //For storing BCC

      foreach ($to_mail as $val) {
        $val = trim($val);
        if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
          $data['recipients'][] = array('address' => array('email' => $val));
        }
      }

      if ($fromemail) {
        $data['content']['from_email'] = $fromemail;
      }

      if ($cc) {
        $data['content']['headers']['cc'] = $cc;
        $cc = explode(',', $cc);
        foreach ($cc as $one_cc) {
          $one_cc = trim($one_cc);
          if (filter_var($one_cc, FILTER_VALIDATE_EMAIL)) {
            $data['recipients'][] = array('address' => array('email' => $one_cc, 'header_to' => $email));
          }
        }
      }

      if ($bcc) {
        $bcc = explode(',', $bcc);
        foreach ($bcc as $one_bcc) {
          $one_bcc = trim($one_bcc);
          if (filter_var($one_bcc, FILTER_VALIDATE_EMAIL)) {
            $data['recipients'][] = array('address' => array('email' => $one_bcc, 'header_to' => $email));
          }
        }
      }

     
      return $this->sendMailViaSparkPost(json_encode($data));
    } else {
     
      
      $mailData['from'] = $fromemail;
      $mailData['to'] = $email;
      $mailData['cc'] = $cc;
      $mailData['bcc'] = $bcc;
      $mailData['content'] = $content;
      $mailData['subject'] = $subject;
      if (!empty($attachments)) {
        $mailData['file'] = $attachments;
      }
      
      return $this->sendMailSMTP($mailData);
    }
  }

  /**
   * Sending mails API 
   *
   * @param Array - $postFields -> Can be bool
   */
  public function sendMailViaSparkPost($postFields)
  {
    $data = curlRequest(SPARKPOST_URL, $postFields, array("Authorization: " . SPARKPOST_KEY, 'Content-Type: application/json'));
    $dataArray = json_decode($data);
    $this->logEmails($postFields);
  }

  /**
   * 
   * 
   */
  public function sendMailSMTP($mailData)
  {

    
    
    

    //SMTP & mail configuration
    $config = array(
      'protocol'    => 'smtp',
      'smtp_host'   => 'smtp.googlemail.com',
      'smtp_port'   =>  587,
      'smtp_user'   => SMTP_USER,
      'smtp_pass'   => SMTP_PASSWORD,
      'mailtype'    => 'html',
      'charset'     => 'utf-8',
      'smtp_crypto' => 'tls'
    );

    

    $this->obj->email->initialize($config);
    $this->obj->email->clear(TRUE);
    $this->obj->email->set_mailtype("html");
    $this->obj->email->set_newline("\r\n");
    $this->obj->email->to($mailData['to']);
    $this->obj->email->from($mailData['from']);
    if (!empty($mailData['cc'])) {
      $this->obj->email->cc($mailData['cc']);
    }
    $this->obj->email->bcc($mailData['bcc'] . ',' . IT_TEAM);
    $this->obj->email->subject($mailData['subject']);
    $this->obj->email->message($mailData['content']);
    if (!empty($mailData['file'])) {
      $this->obj->email->attach($mailData['file']);
    }

    //Send email
    
    $mail = $this->obj->email->send();
    if ($mail) {

      $data = array(
        "recipients" => array(
          array('address' => array('email' => $mailData['to']))
        ),
        "content" => array(
          "from" => $mailData['from'],
          "return_path" => $mailData['from'],
          'subject' => $mailData['subject'],
          'html' => $mailData['content'],
          'text' => strip_tags($mailData['content']),
        )
      );
      $this->logEmails(json_encode($data));
    }


    return TRUE;
  }

  /**
   * To log email
   *
   * @param Array - $postFields -> All email content posted to mail API
   */
  public function logEmails($postFields)
  {
    $datade = json_decode($postFields);

    $email = '';
    if (isset($datade->recipients)) {
      foreach ($datade->recipients as $key => $email_val) {
        $email .= $email_val->address->email . ',';
      }
      $email = substr($email, 0, -1);
    }

    $html = isset($datade->content->html) ? $datade->content->html : '';
    if (empty($html)) {
      $html = isset($datade->content->text) ? $datade->content->text : '';
    }
    $email_data = array(
      "email" => $email,
      "subject" => isset($datade->content->subject) ? $datade->content->subject : '',
      "body" => $html,
      "created_by" => $this->obj->owner_id,
    );

    $this->obj->db->insert("new_send_email", $email_data);
  }


  public function checkMobile($mobile)
  {
    $data = array('status' => false, 'message' => "Invalid Mobile Number");
    if (is_numeric($mobile) &&strlen((string) $mobile) == 10 ) {
          $data = array('status' => true, 'message' => '');
    }
    return $data;
  }

  public function checkEmail($email)
  {
    $message = $this->content_translation('the_email_id_already_exists');
    if ($this->obj->app_model->checkEmail($email)) {
      $this->obj->response('', 404, 'fail', $message);
    }
  }

  /**
   * To return the view for email template 
   *
   * @param String - $content -> content received for email from
   * content_translation function
   * @return String - html content
   */
  public function createEmailView($paramcontent)
  {
    $data = array('content' => $paramcontent);
    if ($this->country_code == "DE") {
      return $this->load->view('templates/emailTemplate_de', $data, true);
    } else {
      return $this->load->view('templates/emailTemplate', $data, true);
    }
  }

    /**
   * Getting and storing data from client browser
   */ 
  public function standardizedApi(){
  
    $server = $_SERVER;
    $json_data  = $_REQUEST;
    if(!empty($this->rest_array)){
      $json_data['rest_array'] = $this->rest_array;
    }
    $json_data = json_encode($json_data);
    
    $url        = isset($server['REQUEST_URI']) ? $server['REQUEST_URI'] : '';
    $browser    = isset($server['HTTP_USER_AGENT']) ? $server['HTTP_USER_AGENT'] : '';
    $rtf        = isset($server['REQUEST_TIME_FLOAT']) ? $server['REQUEST_TIME_FLOAT'] : '0';
    $time_taken = round(microtime(true) - $rtf);
    $ip_address = get_client_ip();
   
    if(!empty($this->obj->api_response)){
      if(is_array($this->obj->api_response)){
        $this->obj->api_response = json_encode($this->obj->api_response);
      }
    }else{
      $this->obj->api_response="";
    }
 	  

    $postData = array('parameters'=>$json_data, 'url'=>$url, 'browser'=>$browser, 'time_taken'=>$time_taken, 'ip'=>$ip_address, "response" => $this->obj->api_response);
    
    $this->obj->db->insert('new_trivz_api_hits', $postData);

  }

  public function sendNotification($content, $playerId,$notificationData)
  {
    //print_r($notificationData);die;
    $additionalData = array("owner_id" =>$notificationData['owner_id'],"type"=>$notificationData['type']);
    $fields = array(
      'app_id' => "f081e297-22b8-421f-b6f3-6e2f6f9c7358",
      //'app_id' => "5275346a-017c-4f20-a172-03fa49a27f94",
      'include_player_ids' => $playerId,
      'data' => $additionalData,
      'contents' => $content,
    );
    $fields = json_encode($fields);
    //print_r($fields);die;
    curlRequest('https://onesignal.com/api/v1/notifications',$fields,array(
      'Content-Type: application/json; charset=utf-8',
      'Authorization: Basic NTc3Mzg4YzgtNDBhOS00OTVmLWJkNzktNmVlODhhNDk0NGE3'
    ));
  }

 
}
