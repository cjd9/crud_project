<?php

class upload_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //$this->load->model('upload_model');
    }

    public function insert_images($image_data = array()) {
         //print_r($image_data); die;
        $data = array(
            'image_name' => $image_data['file_name'],
            'thumb_name' => $image_data['raw_name'],
            //'fullpath' => $image_data['full_path']
        );
        //print_r($data);
        $this->db->insert('profile_images', $data);
    }
    
    public function get_images() {
    if ($this->db) {
            $this->db->close();
        }
        $this->load->database('ocare');
        

        $query = $this->db->select('image_name')
                ->from('dentist_master')
                ->where('dentist_id',$this->session->user_id)
                ->get();
        //print_r($query->result_array()); die;
        $res = $query->result_array();
        $this->db->close();
        if (count($res) > 0) {
           return $res;
           
        }
        return false;
    }
}
