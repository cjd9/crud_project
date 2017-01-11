<?php

class Dentist_Model extends CI_Model {

    private $ocdb;
    private $localdb;

    public function __construct() {
        parent::__construct();
        $this->ocdb = $this->load->database('ocare', TRUE);
        $this->localdb = $this->load->database('local', TRUE);
    }

  

    public function getAllUsers() {

        $this->ocdb->select('id,full_name,address,email,mobile_no,pin,created_on')
                ->from('user_details');
        $query = $this->ocdb->get();
        return($query->result_array());
    }


   

    public function GetFullUserDetails() {
        $this->ocdb->select('id,full_name,address,email,mobile_no,pin,created_on')
                ->from('user_details');
                
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    

    public function fetchUserMasterDetailsModel($user_id) {
        $this->ocdb->select('id,full_name,address,email,mobile_no,pin,created_on')
                ->from('user_details')
                ->where('id', $user_id);
        $query = $this->ocdb->get();
        return( $query->row_array());
    }

   

    public function UpdateUserDetails($array) {
        $this->ocdb->where('user_id', $this->session->user_id);
        $count = $this->ocdb->update('users', $array);
        return $count;
    }


    
   
    public function addNewEntry($newClinic) {
        $this->ocdb->insert('user_details', $newClinic);
        $insert_id = $this->ocdb->insert_id();
        return $insert_id;
    }

   
   
   
  
   }


?>
