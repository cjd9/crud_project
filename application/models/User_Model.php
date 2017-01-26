<?php

class User_Model extends ci_model {

    private $ocdb, $tdndb, $errors;

    public function __construct() {
        parent::__construct();
        $this->ocdb = $this->load->database('ocare', TRUE);
        $this->errors=$this->config->item('errors');
       
    }

    public function __destruct() {
        unset($this->ocdb);
    }

      public function getAllUsers() {

        $this->ocdb->select('id,full_name,address,email,mobile_no,date_of_birth,pin,created_on')
                ->from('user_details');
        $query = $this->ocdb->get();
        return($query->result_array());
    }


   

    public function GetFullUserDetails() {
        $this->ocdb->select('id,full_name,address,email,mobile_no,date_of_birth,pin,created_on')
                ->from('user_details');
                
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    

    public function fetchUserMasterDetailsModel($user_id) {
        $this->ocdb->select('id,full_name,address,email,mobile_no,date_of_birth,pin,created_on')
                ->from('user_details')
                ->where('id', $user_id);
        $query = $this->ocdb->get();
        return( $query->row_array());
    }

   

    // public function UpdateUserDetails($array) {
    //     $this->ocdb->where('user_id', $this->session->user_id);
    //     $count = $this->ocdb->update('users', $array);
    //     return $count;
    // }


    
   
    public function addNewEntry($newClinic) {
        $this->ocdb->insert('user_details', $newClinic);
        $insert_id = $this->ocdb->insert_id();
        return $insert_id;
    }

    function getData($tbl_name, $where_array) {
        $this->load->database();
        // $this->db->select('user_id,user_name,email_id,user_type');
        $this->db->select('*');
        $this->db->where($where_array);
        $query = $this->db->get($tbl_name);
        return $query->result();
    }

    public function getPasswordHash($plainPassword) {
        $salt = md5(uniqid('', true));
        $sSHAHash = hash("sha256", $salt . $plainPassword);
        $sEncryptedPassword = $salt . $sSHAHash;
        return $sEncryptedPassword;
    }

    public function verifyPassword($sPlainPassword, $sPasswordHash) {

        $salt = substr($sPasswordHash, 0, 32);
        $hash = substr($sPasswordHash, 32);
        $sSHAHash = hash("sha256", $salt . $sPlainPassword);

        if ($sPasswordHash == $salt . $sSHAHash) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function generateOTP($length = 6) {
        $characters = '0123456789';
        $len = strlen($characters);
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        $string = substr($string, rand(0, ($len - $length)), $length);
        return $string;
    }

    function getloginData($tbl_name, $where_array) {

        $email = $where_array['email'];
        echo "<br/><br/>";
        $mobile = $where_array['mobile'];
        echo "<br/><br/>";
        $pwd = $where_array['password'];
        echo "<br/><br/>";
        $where = "(email_id='$email' OR mobile_no='$mobile') AND password='$pwd'";
        $this->load->database();
        // $this->db->select('user_id,user_name,email_id,user_type');
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get($tbl_name);
//            print_r($query);die;
        return $query->result();


        //       $email= $where_array['email']; echo "<br/><br/>";
        //       $mobile= $where_array['mobile'];echo "<br/><br/>";
        //       $pwd=$where_array['password'];echo "<br/><br/>";
        //        $where="(email='$email' OR mobile='$mobile') AND password='$pwd'";
        //         $this->load->database();
        //       // $this->db->select('user_id,user_name,email_id,user_type');
        //        $this->db->select('*');
        // $this->db->where($where);
        //        $query = $this->db->get($tbl_name);
        //        return $query->result();
    }

    function permission($tbl_name) {
        $this->load->database();
        // $this->db->select('user_id,user_name,email_id,user_type');
        $this->db->select('permission_id,permission_name');
//          $this -> db -> from($tbl_name);
        $query = $this->db->get($tbl_name);
        return $query->result_array();
    }

    function insert($tbl_name, $insert_array) {
        $this->db->insert($tbl_name, $insert_array);
    }

    function update($where, $tbl_name, $insert_array) {
        $this->db->where($where);
        $this->db->update($tbl_name, $insert_array);
    }

//       function permissionData($tbl_name){
//		$this->load->database();
//           // $this->db->select('user_id,user_name,email_id,user_type');
//            $this->db->select('permission_id,permission_name');
//            $query = $this->db->get($tbl_name);
//           return $query->result();
//	}

    function generatePassword($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@!&$#';
        $len = strlen($characters);
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        $string = substr($string, rand(0, ($len - $length)), $length);
        return $string;
    }

    function checkusername($username) {
        $this->db->select('user_name');
        $this->db->from('admin_users');
        $this->db->where('user_name', $username);
        $this->db->limit(1);

        $query = $this->db->get();
        $result = $query->result();
        if ($result) {
            return "1";
        } else {
            return "0";
        }
    }

    function checkemail($mail) {
        $this->db->select('user_id,user_name,email_id');
        $this->db->from('users');
        $this->db->where('email_id', $mail);
        $this->db->limit(1);

        $query = $this->db->get();
        return $result = $query->result();
//          if($result)
//          {
//            return "1";
//          }
//          else
//          {
//            return "0";
//          }
    }

    function checkmobile($mobile) {
        $this->db->select('user_id,user_name,mobile_no');
        $this->db->from('users');
        $this->db->where('mobile_no', $mobile);
        $this->db->limit(1);

        $query = $this->db->get();
        return $result = $query->result();
//          if($result)
//          {
//            return "1";
//          }
//          else
//          {
//            return "0";
//          }
    }

    function checkemailmobile($email, $mobile) {
        //echo $email."and".$mobile."modal fetched data<br/><br/>";
        $where = "email_id='$email' OR mobile_no='$mobile'";
        $this->db->select('user_id,user_name,email_id,mobile_no');
        $this->db->from('users');
        $this->db->where($where);
        $this->db->limit(1);

        $query = $this->db->get();
//          print_r($query);die;
        return $result = $query->result();
//          if($result)
//          {
//            return "1";
//          }
//          else
//          {
//            return "0";
//          }
    }

    function user_list($limit, $start) {
        $sql = 'select * from admin_users order by user_name limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function addBulkUsers($data) {
        //echo "<pre>";print_r($data); 
        $retVal = array('success' => array(), 'fail' => array());
        $count1 = count($data);
        foreach ($data as $k => $v) {
            $profileData = array('ocare_id' => $v['ocare_id'],
                'consumer_group' => $v['consumer_group'],
                'first_name' => $v['first_name'],
                'last_name' => $v['last_name'],
                'date_of_birth' => $v['date_of_birth'],
                'gender' => $v['gender'],
                'address' => $v['address'],
                'city' => $v['city'],
                'state' => $v['state'],
                'country' => $v['country'],
                'pincode' => $v['pincode'],
                'pan_card' => $v['pan_card'],
                'bank_account_number' => $v['bank_account_number'],
                'bank_branch_name' => $v['bank_branch_name'],
                'bank_ifsc' => $v['bank_ifsc'],
                'is_insured' => 1
            );
            $password = $this->getPasswordHash($this->User_Model->generatePassword());  //echo $password;


            $userData = array('user_name' => $v['user_name'],
                'mobile_no' => $v['mobile_no'],
                'email_id' => $v['email_id'],
                'password' => $password,
                'user_source' => 'bulk_upload',
                'user_type' => 'insured',
                'is_active' => 2 //two means user is active but should change the password
            );

            // echo "insert array<br/>"; print_r($profileData);print_r($userData);
            $this->db->trans_start();
            $this->db->insert('users', $userData);
            $user_id = $this->db->insert_id();
            $profileData['user_id'] = $user_id;
            $this->db->insert('user_profile', $profileData);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                //Data not added
                $retVal['fail'][$k] = array_merge($userData, $profileData);
            } else {
                //data added
                $retVal['success'][$k] = array_merge($userData, $profileData);
            }
        }
        return $retVal;
    }

    public function updateexcel($data) {
        // echo "<pre>"; print_r($data);
        $count1 = count($data);
        for ($row = 0; $row < $count1; $row++) {
            //echo "<p><b>Row number $row</b></p>";
            for ($col = 0; $col < $count1 - 1; $col++) {
                $profileData = array("ocare_id" => $data[$row]["ocare_id"],
                    "consumer_group" => $data[$row]["consumer_group"],
                    "first_name" => $data[$row]["first_name"],
                    "last_name" => $data[$row]["last_name"],
                    "date_of_birth" => $data[$row]["date_of_birth"],
                    "gender" => $data[$row]["gender"],
                    "address" => $data[$row]["address"],
                    "city" => $data[$row]["city"],
                    "state" => $data[$row]["state"],
                    "country" => $data[$row]["country"],
                    "pincode" => $data[$row]["pincode"],
                    "pan_card" => $data[$row]["pan_card"],
                    "bank_account_number" => $data[$row]["bank_account_number"],
                    "bank_branch_name" => $data[$row]["bank_branch_name"],
                    "bank_ifsc" => $data[$row]["bank_ifsc"],
                );
                $password = $this->User_Model->generatePassword();  //echo $password;
                $store_password = md5($password);
                $userid = $data[$row]["user_id"];
                $userData = array("user_name" => $data[$row]["user_name"],
                    "mobile_no" => $data[$row]["mobile_no"],
                    "email_id" => $data[$row]["email_id"],
                    "password" => $store_password
                );
            }
            //echo $userid;
            /* $query=$this->db->get('user_profile');
              $errors = array();
              foreach ($query->result() as $row)
              {
              $errors[] =  $row->first_name;
              };echo 'update data: ';print_r($errors);die; */

            // echo "update array <br/>";print_r($profileData); print_r($userData); $userid; 
            $where = "user_id=$userid";
            $this->db->trans_start();
            $this->db->where($where);
            $this->db->update('users', $userData);
            $this->db->where($where);
            $this->db->update('user_profile', $profileData);
            $this->db->trans_complete();
            echo "$userid record updated<br/>";

//            $update = array();
//            $update[] = "$userid record updated<br/>";
//            echo '$update data: ';print_r($update);
        }
    }

    public function isUserExist($email, $mobile) {
        $query = $this->db->from('users as u')
                ->join('user_profile as up', 'up.user_id = u.user_id OR up.parent_user_id = u.user_id')
                ->select(['u.user_id', 'u.email_id', 'u.mobile_no', 'up.parent_user_id', 'up.salutation', 'up.first_name', 'up.middle_name', 'up.last_name', 'up.is_insured', 'up.ocare_id', 'up.insurance_policy_id'])
                ->where('u.mobile_no', $mobile)
                ->or_where('u.email_id', $email)
                ->get();
        $res = $query->result_array();
        #pr($res,1);
        return $res;
    }

    public function addUserInsurance($v, $user_id) {
        $this->db->where('user_id', $user_id)->update('user_profile', $v);
        $dberr = $this->db->error();
        if (isset($dberr['message']) && $dberr['message'] != '') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function addAdditionalUserInsurance($v, $user_id) {
        $v['parent_user_id'] = $user_id;
        $this->db->insert('user_profile', $v);

        $dberr = $this->db->error();
        if (isset($dberr['message']) && $dberr['message'] != '') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getUserDetails($user_id, $complete = FALSE, $forauth = FALSE) {
        #print_r($user_id);die;
        $select_arr = array(
            'u.user_name',
            'u.user_id',
            'u.user_type',
            'u.email_id',
            'u.mobile_no',
            'u.is_active',
            'u.user_source',
            'u.google_id',
            'u.fb_id',
            'u.twitter_id',
            'u.profile_picture',
            'u.about',
            'u.created_on',
            'u.modified_on',
            'up.salutation',
            'up.first_name',
            'up.middle_name',
            'up.last_name',
            'up.gender',
            'up.locality',
            'up.address',
            'up.city',
            'up.state',
            'up.pincode',
            'up.date_of_birth',
            'up.latitude',
            'up.longitude'
        );
        
        $query = $this->ocdb
                ->from('users as u')
                ->join('user_master as up', 'u.user_id = up.dentist_id');
        if ($forauth) {
            //Get user details for Authentication
            $select_arr = array_merge($select_arr, array('u.password'));
            $query = $query->where('u.user_name', $user_id)
                    ->or_where('u.email_id', $user_id)
                    ->or_where('u.mobile_no', $user_id);
        } else {
            $query = $query->where('u.user_id', $user_id);
        }
        $query = $query->select($select_arr)->get();
        #pr($select_arr);
        $res = $query->result_array();
        #pr($res,1);

        if (count($res) > 0) {
            $res[0]['full_name'] = '';
            if ($res[0]['salutation'])
                $res[0]['full_name'] .= $res[0]['salutation'];
            if ($res[0]['first_name'])
                $res[0]['full_name'] .= (($res[0]['full_name'] == '') ? '' : ' ') . $res[0]['first_name'];
            if ($res[0]['middle_name'])
                $res[0]['full_name'] .= (($res[0]['full_name'] == '') ? '' : ' ') . $res[0]['middle_name'];
            if ($res[0]['last_name'])
                $res[0]['full_name'] .= (($res[0]['full_name'] == '') ? '' : ' ') . $res[0]['last_name'];

            return $res[0];
        } else {
            return false;
        }
    }
    
    public function authenticateUser($params) {
        #print_r($params);die;
        $retArray = array('status' => 'ok', 'message' => 'success');
        $errors = array();
        /*$query = $this->ocdb->select(['u.user_name', 'u.password', 'u.user_id', 'u.user_type', 'u.email_id', 'u.mobile_no', 'concat(up.salutation, " ", up.first_name, " ", up.middle_name, " ", up.last_name) as full_name', 'up.salutation', 'up.first_name', 'up.middle_name', 'up.last_name', 'up.gender', 'up.address', 'up.city', 'up.state', 'up.pincode', 'u.is_active'])
                ->from('users as u')
                ->join('user_profile as up', 'u.user_id = up.user_id')
                ->where('user_name', $params['user_name'])
                ->get();
        $res = $query->result_array();
         */
        $res = $this->getUserDetails($params['user_name'], false, true);
        #print_r($res);die;
        if (count($res) == 0) {
            //User is not found
            $errors['103'] = $this->errors['103'];
        } elseif ($this->verifyPassword($params['password'], $res['password'])) {
            $retArray['response'] = $res;
        } else {
            //Wrong password
            $errors['103'] = $this->errors['103'];
        }
        if (count($errors) > 0) {
            $retArray['status'] = 'error';
            $retArray['message'] = $errors;
        }
        #print_r($retArray);die;
        return $retArray;
    }
    public function userprofile($user_id) {
        $res = $this->getUserDetails($user_id, true);
        if ($res && count($res) > 0)
            return $res;
        return false;
    }
    public function prPicUpload($user_id) {
        $this->ocdb->set('profile_picture', 1)->where('user_id', $user_id)->update('users');
    }


    public function removePrPic($user_id) {
        $errors = array();
        $retVal=array('status'=>'ok','message'=>'success');
        $this->ocdb->set('profile_picture', 0)->where('user_id', $user_id)->update('users');
        $dberror = $this->ocdb->error();
        if($dberror['message'] != '') 
         {
            $retVal['status'] = 'error';
            $retVal['message'] = $dberror['message'];
        }
        return $retVal;
    }

        public function registerUser($params) {
        $user_id = $full_name = '';
         $retArray = array('status' => 'ok', 'message' => 'success');
         $errors = array();
        $query = $this->ocdb->select(['user_id', 'email_id', 'mobile_no', 'user_name'])
                ->from('users')
                ->where('email_id', $params['email_id']);
        if (isset($params['mobile_no']) && $params['mobile_no'] != '')
            $query = $query->or_where('mobile_no', $params['mobile_no']);
        if (isset($params['user_name']) && $params['user_name'] != '')
            $query = $query->or_where('user_name', $params['user_name']);
        $query = $query->get();
        //Fetch user if already have in our system
        $res = $query->result_array();
        if (count($res) > 0) {
            //User's email ID or phone number is already registered
            $retArray = array('status' => 'error', 'message' => 'User Already Exists. Please choose a different email or mobile no');

        
        }  else{
            if (count($errors) == 0) {
           
                if (!isset($params['user_name']) || (isset($params['user_name']) && $params['user_name'] == '')) {
                    $params['user_name'] = $params['email_id'];
                }
                $insertArray = array('email_id' => $params['email_id']);
                $insertArray2 = array();
                if (isset($params['mobile_no']) && $params['mobile_no'])
                    $insertArray['mobile_no'] = $params['mobile_no'];
                if (isset($params['user_name']) && $params['user_name'])
                    $insertArray['user_name'] = $params['user_name'];
                if (isset($params['password']) && $params['password'])
                    $insertArray['password'] = $this->getPasswordHash($params['password']);
                 if (isset($params['first_name']) && $params['first_name'])
                    $insertArray2['first_name'] = $params['first_name'];
                if (isset($params['last_name']) && $params['last_name'])
                    $insertArray2['last_name'] = $params['last_name'];
         
              
                $this->ocdb->trans_start();
                $this->ocdb->insert('users', $insertArray);
                $dberror = $this->ocdb->error();
                if(isset($dberror['code']) && $dberror['code'] && isset($dberror['message']) && $dberror['message']) {
                    $errors[$dberror['code']] = $dberror['message'];
                }
                $user_id = $this->ocdb->insert_id();
                $insertArray2['dentist_id'] = $user_id;
                $this->ocdb->insert('user_master', $insertArray2);
                $dberror = $this->ocdb->error();
                if(isset($dberror['code']) && $dberror['code'] && isset($dberror['message']) && $dberror['message']) {
                    $errors[$dberror['code']] = $dberror['message'];
                }
                $this->ocdb->trans_complete();
                
                if ($this->ocdb->trans_status() === FALSE) {
                    //Unable to perform action
                    if(count($errors) == 0) {
                        $errors['100'] = $this->errors['100'];
                    }
                    $fail = true;
                }
            }
        }
        
        if (count($errors) > 0) {
            $retArray['status'] = 'error';
            $retArray['message'] = $errors;
        }
        return $retArray;
    }

     public function deleteUser($id){

        $this->ocdb->where('id', $id);
        $count = $this->ocdb->delete('user_details');
        return $count;
    }
     public function UpdateUserDetails($data) {
        $this->ocdb->where('id', trim($data['id']));
        $trimmed_array=array_map('trim',$data);
        $count = $this->ocdb->update('user_details', $trimmed_array);
        return $count;
    }
}
