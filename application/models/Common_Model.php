<?php
class Common_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        //$this->validateUser();
        //$this->setAccessToken();
        //$this->sendEmail('nigaralam@gmail.com', 'Hello This is O Care');
    }
    
    public function validateUser() {
        /*
         Method for validating user type and redirect accordingly
         Also check permission and take action
         Created by M. Nigar Alam
         Date: May-27-2016
         */
        
        $notForPermission = array(
            'dashboard/index'
            ,'user/login'
            ,'user/unauthorize'
            ,'user/logout'
            ,'user/userprofile'
            ,'user/ajax'
            
        );
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        $user_id = $this->session->user_id;
        #echo "\$user_id = $user_id";die;
        if($user_id) {
            #echo $this->session->user_details['user_type'];die;
            switch ($this->session->user_details['user_type']) {
                case 'normal':
                    if(OCARE_URL != base_url())
                        redirect(OCARE_URL);
                    break;
                case 'insured':
                    if(OCARE_URL != base_url())
                        redirect(OCARE_URL);
                    break;
                case 'dentist':
                    if(TDNOCARE_URL != base_url())
                        redirect(TDNOCARE_URL);
                    break;
                case 'diagnostic':
                    if(DIAGNOSTIC_URL != base_url())
                        redirect(DIAGNOSTIC_URL);
                    break;
                case 'default':
                    break;
            }
            $permissions = $this->session->permissions;
            
            $action = $controller . '/' . $method;
            if(!(in_array($action, $notForPermission))){
                if($this->session->user_details['user_type'] != 'superadmin' && !in_array($controller . '/' . $method, $permissions)) {
                    redirect(base_url('unauthorize'));
                }
            }
        }
        else {
            if(!($controller == 'user' && $method == 'login')){
                redirect(base_url('login/?redirect=' . urlencode($_SERVER['REQUEST_URI'])));
            }
        }
    }
    /*
    public function setAccessToken() {

         // Fetch access token if access token is not in session or it is expired
        //assign user id if user is not logged in the set user id as guest_<ip address>
        $user_id = (isset($this->session->user_id) && $this->session->user_id != '') ? $this->session->user_id : 'guest_users_' . $_SERVER['REMOTE_ADDR'];
        if(!isset($this->session->access_token) || (isset($this->session->access_token) && ($this->session->access_token == '' || time() > strtotime($this->session->at_expire_time)))) {
            
            //Fetch access token and set in the session
            $this->fetchAccessToken($user_id);
        } 
    }
    public function fetchAccessToken($user_id) {
        
         // This method forcefully fetch access token from API and set the same in the session
         
       # echo "\$user_id = $user_id";die;
        #echo WC_API_URL . '/getAccessToken'; print_r(array('app_key' => WC_APP_KEY, 'app_secret' => WC_APP_SECRET, 'user_id' => $user_id, 'chks' => md5(WC_APP_KEY . WC_APP_SECRET . $user_id . date('Y-m-d'))));die;
        $res = $this->curlCall(WC_API_URL . '/getAccessToken', array('app_key' => WC_APP_KEY, 'app_secret' => WC_APP_SECRET, 'user_id' => $user_id, 'chks' => md5(WC_APP_KEY . WC_APP_SECRET . $user_id . date('Y-m-d'))));
        $res = json_decode($res, true);
        #echo 'LLL';print_r($res);die;
        if($res['status'] = 'ok') {
            $this->session->access_token = $res['response']['access_token'];
            $this->session->at_expire_time = $res['response']['at_expire_time'];
            $this->session->user_id = $user_id;
        }
    }
    */
    public function curlCall($url, $fields, $method = 'post') {
       // echo "\$url = $url";print_r($fields);die;
        //$fields['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $ch = curl_init();
        
        if(trim(strtolower($method)) == 'post') {
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
        }
        else {
            $url .= '?' . http_build_query($fields);
        }
        #echo $url;die;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        //execute post
        #var_dump($ch);die;
        $result = curl_exec($ch);
        //print_r($result);die;
        curl_close($ch);
        return $result;
    }
    public function setMessage($message) {
        $this->session->messagetext = $message;
    }
    public function getMessage() {
        $msg = false;
        if(isset($this->session->messagetext)) {
            $msg = $this->session->messagetext;
            if(is_array($msg)) {
                $msg = implode('<br />', $msg);
            }
            $this->session->unset_userdata('messagetext');
        }
        return $msg;
    }
    
    public function sendSMS($mobile, $message) {
        //http://www.smsmantraconnect.com/api/mt/SendSMS?user=thedentalnexus&password=Dental@2016&senderid=WEBSMS&channel=Promo&DCS=0&flashsms=0&number=918390390619&text=Welcome to TDN&route=1
        //http://www.smsmantraconnect.com/api/mt/SendSMS?user=thedentalnexus&password=Dental@2016&senderid=WEBSMS&channel=Promo&DCS=0&flashsms=0&number=919867970602&text=Hello, you have successfully registered to O Care. Enter your OTP to activate account and your OTP is 097087&route=1
        $user = 'thedentalnexus';
        $pwd = 'Dental@2016';
        $senderid = 'WEBSMS';
        $channel = 'Promo';
        $DCS = 0;
        $flashsms = 0;
        $route = 1;
       # echo SMSAPI_URL;die;
        $res = $this->curlCall(SMSAPI_URL, array('user'=>$user, 'password' => $pwd, 'senderid' => $senderid, 'channel' => $channel, 'DCS' => $DCS, 'flashsms' => $flashsms, 'number' => $mobile, 'text' => $message, 'route' => $route), 'get');
        if($res) {
            $db = $this->load->database('ocare', TRUE);
            $db->insert('smssent_log', array('mobile_no' => $mobile, 'message' => $message, 'response' => $res));
        }
    }
    
    public function sendEmail($email_id, $message, $subject = 'O Care') {
        return;
        $config = array(
            'smtp_host' => 'smtp.gmail.com',
            'protocol' => 'smtp',
            'smtp_user' => 'web@thedentalnexus.com',
            'smtp_pass' => 'Dental@2015',
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'smtp_timeout' => 160
        );
        $this->load->library('email', $config);

        $this->email->from('web@thedentalnexus.com', 'O Care');
        $this->email->to($email_id);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($message);

         echo $this->email->send();
         var_dump($this->email);
         die;
    }
    
    public function getStateByCity($city_id) {
        //select s.id from states as s join locality as l on l.state = s.id where l.city = 93 limit 1 
        #var_dump($this->db);die;
        $query = $this->db->select('s.id as state_id')->from('states as s')->join('locality as l', 'l.state = s.id')->where('l.city', $city_id)->get();
        #echo $query->get_compiled_select();die;
        $res = $query->result_array();
        if($res && count($res)>0){
            return $res[0]['state_id'];
        }
        else {
            return '';
        }
    }
    
    public function getAllCities() { 
        $this->db->select('id,name')
                ->from('cities');
               //->where('id', $cityid);
        $query = $this->db->get();
        return( $query->result_array());
    }
    
     public function sendEmail_byLocal($email_id, $message, $subject) {
        /*$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->load->library('email');

        $this->email->initialize($config);
        $this->email->from('n.alam@thedentalnexus.in', 'Nigar Alam');
        $this->email->to('nigaralam@gmail.com');
        $this->email->subject('This is my subject');
        $this->email->message('This is my message');
        $this->email->send();*/
        
        $config = array(
            'smtp_host' => 'smtp.gmail.com',
            'protocol' => 'smtp',
            'smtp_user' => 'mdnigaralam@gmail.com',
            'smtp_pass' => 'GMNif0ur@1am_mn@',
            'smtp_port' => 465
        );
        $this->load->library('email', $config);
$email_id = 'n.alam@thedentalnexus.in';
        $this->email->from('mdnigaralam@gmail.com', 'O Care');
        $this->email->to($email_id);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($message);

         echo $this->email->send();
         var_dump($this->email);
         die;
    }
    
    public function sendEmailGM() {
        
        
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'amit@gmail.com';                   // SMTP username
            $mail->Password = 'digitalinspiration';               // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
            $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
            $mail->setFrom('amit@gmail.com', 'Amit Agarwal');     //Set who the message is to be sent from
            $mail->addReplyTo('labnol@gmail.com', 'First Last');  //Set an alternative reply-to address
            $mail->addAddress('josh@example.net', 'Josh Adams');  // Add a recipient
            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
            $mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
            $mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

            if(!$mail->send()) {
               echo 'Message could not be sent.';
               echo 'Mailer Error: ' . $mail->ErrorInfo;
               exit;
            }

            echo 'Message has been sent';
    }
    
}