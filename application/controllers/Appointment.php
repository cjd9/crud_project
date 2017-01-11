<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Dentist_Model');
    }

    public function index() {
        
    }

    public function dentistAnswer() {
        echo"HEY"; die;
        $reason = $_POST;
        $answer = $this->uri->segment(3);
        $appointment_id = $this->uri->segment(4);
        if ($reason['reason'] != '') {
            $array = array('is_approved' => $answer, 'rejection_reason' => $reason['reason']);
        } else {
            $array = array('is_approved' => $answer);
        }
        $this->data['data'] = $this->Dentist_Moddel->UpdateAppointmentTable($array, $appointment_id);
        if ($answer == '3') {
            $this->Dentist_Model->RescheduleAppointmentTable($appointment_id);
        }
        $this->load->view('jsonresponse', $this->data);
    }

    public function checkTimeSlotforAppointment() {
        $timeSlotArray = array('10am-11am', '11am-12pm', '12pm-01pm', '03pm-04pm', '04pm-05pm');
        $storearray = $this->Dentist_Model->RetrieveTimeSlotsforDatePatient($_POST);
        $checkbox = "";
        //print_r($storearray);
        foreach ($storearray as $row) {

            $checkbox.= "<input type='radio'  name='availableTime' value='" . $row['time_slots'] . "' > " . $row['time_slots'] . "<br>";
        }
        echo $checkbox;
//        if ($storearray) 
//        {
//            $checkbox = "";
//            $uncheckbox = "";
//            $a = 'checked';
//            foreach ($storearray as $row) {
//                $tobecheckedwith[] = $row['time_slots'];
//            }
//            $i = 0;
//            foreach ($timeSlotArray as $row) {
//                if (in_array($row, $tobecheckedwith)) {
//                } 
//                else 
//                {
//                    $checkbox.= "<input type='radio'  name='availableTime' value='" . $row . "' > " . $row . "<br>";
//                }
//            }
//            $this->data['checkbox'] = $checkbox;
//            echo $checkbox;
//        } 
//        else 
//        {
//            echo '<input type="radio" name="availableTime" value="10am-11am"> 10am-11am<br>
//           <input type="radio" name="availableTime" value="11am-12pm"> 11am-12pm<br>
//           <input type="radio" name="availableTime" value="12pm-01pm"> 12pm-01pm<br>
//           <input type="radio" name="availableTime" value="03pm-04pm"> 03pm-04pm<br>
//           <input type="radio" name="availableTime" value="04pm-05pm"> 04pm-05pm<br';
//        }
        die;
    }

    public function addTimeSlotForPatient() {
        $result = $this->Dentist_Model->addTimeSlotsForPatient($_POST);
        if ($result > 0) {
            $status = $this->Dentist_Model->addAppointmentForPatient($_POST);
            if ($status > 0) {
                redirect(base_url());
            }
        } else {
            $this->load->view('errors/Success');
            redirect(base_url());
        }
    }

    public function checkTimeSlotForClinic() {



        $result = $this->Dentist_Model->GetTimeSlotForClinic($_POST);
        $slotsbooked = str_split($this->Dentist_Model->sum($_POST));
        //print_r ($slotsbooked); print_r ($result); die;
//          $diff=$result['end_time']->diff($result['start_time']);
//          $hours = $diff->h;
//       
//          echo $diff;
        $checkbox = "";

        $master = [ '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0'];




        //$slotsbooked=str_split($result['time_slot']);
        $var = strtotime($result['start_time']);

        $var1 = date('h', $var) + ( date('i', $var) / 60 );


//          $diff=(ceil($result['end_time'])-floor($result['start_time']))*2;

        $startdigit = substr($result['start_time'], 0, 2) + 0;
        $enddigit = (substr($result['end_time'], 0, 2)) + 0;

        //$range=$result['time_slot'];
        $time_in_12_hour_format = date("g:i a", strtotime($result['start_time']));
        $endtimecompare = date("g:i a", strtotime($result['end_time']));
//          
        $i = (($var1 * 60) / 30);
        //$range = (($var1 * 60) / 30);
        while (($endtimecompare != $time_in_12_hour_format)) {
            if ($slotsbooked[$i] == $master[$i]) {
                $endTime = strtotime("+30 minutes", strtotime($time_in_12_hour_format));
                $nexttime = date('g:i a', $endTime);

                $checkbox.= "<input type='radio'  name='availableTime' value='" . $i . "' > " . $time_in_12_hour_format . "-" . $nexttime . "<br>";
            }
            $endTime = strtotime("+30 minutes", strtotime($time_in_12_hour_format));
            $time_in_12_hour_format = date('g:i a', $endTime);
            $i++;
           
        }




        echo $checkbox;
    }

    public function time() {
           
$checkbox=array();
        $master = [ '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0'];

         $var = strtotime('00:00:00');

        $var1 = date('h', $var) + ( date('i', $var) / 60 );
         $time_in_12_hour_format = date("g:i a", strtotime('00:00:00'));
          $endtimecompare = date("g:i a", strtotime('23:30:00'));
        $i = (($var1 * 60) / 30);
        //$range = (($var1 * 60) / 30);
        echo $endtimecompare; echo $time_in_12_hour_format;
        while (($endtimecompare != $time_in_12_hour_format)) {
           
                $endTime = strtotime("+30 minutes", strtotime($time_in_12_hour_format));
                $nexttime = date('g:i a', $endTime);

                $checkbox[]=   $time_in_12_hour_format . "-" . $nexttime;
            
            $endTime = strtotime("+30 minutes", strtotime($time_in_12_hour_format));
            $time_in_12_hour_format = date('g:i a', $endTime);
            $i++;
            
        }
        
        print_r($checkbox);
      
    }

}
