<?php

class Dentist_Model extends CI_Model {

    private $ocdb;
    private $localdb;

    public function __construct() {
        parent::__construct();
        $this->ocdb = $this->load->database('ocare', TRUE);
        $this->localdb = $this->load->database('local', TRUE);
    }

    public function GetDoctorProfile($doctor_user_id) {
//        $query = $this->ocdb->from('tdn_user_profile_master as tdnupm')
//                ->join('tdn_user_dentist_clinic as tdnudc', 'tdnupm.user_id = tdnudc.user_id')
//                ->join('tdn_user_dentist_speciality as tdnuds', 'tdnuds.speciality_id = tdnudc.speciality_id')
//                //Add other records
//                ->where('tdnupm.user_id', $doctor_user_id)
//                ->select(['tdnupm.user_id as doctor_user_id', 'tdnupm.user_prefix', 'tdnupm.first_name', 'tdnupm.last_name', 'tdnupm.birth_date', 'tdnupm.gender', 'tdnupm.email', 'tdnupm.contact_office', 'tdnupm.contact_residence', 'tdnupm.mobile', 'tdnupm.address', 'tdnudc.dci_reg_no', 'tdnudc.clinic_name', 'tdnudc.clinic_address', 'tdnudc.city as clinic_city', 'tdnudc.state as clinic_state', 'tdnudc.pin as clinic_pin', 'tdnudc.clinic_email', 'tdnudc.clinic_office_no', 'tdnudc.clinic_mobile_no', 'tdnuds.speciality'])
//                ->get();
//        $res = $query->result_array();
//        if (count($res) > 0) 
//        {
//            return $res[0];
//        } else {
//            return false;
//        }
    }

    public function fetchApointmentModel($dentist_id) {
        $clause = array('dentist_user_id' => $dentist_id, 'is_approved' => '0');
        $this->ocdb->select('appointment_id,user_profile.user_id,user_profile.first_name, user_profile.last_name, users.mobile_no ,clinic_master.clinic_name,appointment_date,appointment_time,appointment_status');
        $this->ocdb->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->join('users', 'users.user_id = user_profile.user_id')
                ->where($clause)
                ->order_by('appointment_date', 'DESC');
        $query = $this->ocdb->get();
        return($query->result_array());
    }

    public function fetchApointmentModelByDate($date) {

        $this->ocdb->select('appointment_id,user_profile.first_name, user_profile.last_name,user_profile.user_id, users.mobile_no ,clinic_master.clinic_name,appointment_date,appointment_time,appointment_status');
        $this->ocdb->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->join('users', 'users.user_id = user_profile.user_id')
                ->where('dentist_user_id', $this->session->user_id)
                ->where('appointment_date', $date)
                ->where('is_approved', '0')
                ->order_by('appointment_date', 'DESC');
        $query = $this->ocdb->get();
        return($query->result_array());
    }

    public function getAllUsers() {

        $this->ocdb->select('id,full_name,address,email,mobile_no,pin,created_on')
                ->from('user_details');
        $query = $this->ocdb->get();
        return($query->result_array());
    }


    public function GetDoctorProfileStatus($doctor_user_id) {
        $this->ocdb->select('updated')
                ->from('dentist_profile')
                ->where('dentist_id', $doctor_user_id);
        $query = $this->ocdb->get();
        return( $query->row_array());
    }

    public function GetAvailableTreatments() {
        $this->ocdb->select('id as treatment_id, name as treatment_name')
                ->from('treatment_master');
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    public function GetAvailableStates() {
        $this->ocdb->select('id,name')
                ->from('states')
                ->order_by("name", "asc");
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    public function GetStateForId() {
        $this->ocdb->select('state')
                ->from('dentist_master')
                ->where('dentist_id', $this->session->user_id);
        $query = $this->ocdb->get();
        return( $query->row_array());
    }

    public function GetAvailableSpeciality() {
        $this->ocdb->select('id,name')
                ->from('speciality_master');
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    public function GetAvailableCity() {
        $this->ocdb->select('id,name')
                ->from('cities');
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    public function DentistClinicMount($doctor_user_id) {
        $this->ocdb->select('dentist_id,clinic_master.clinic_id,clinic_master.clinic_name')
                ->from('dentist_clinic_mount')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_clinic_mount.clinic_id')
                ->where('dentist_id', $doctor_user_id);
        $query = $this->ocdb->get();
        return ($query->result_array() );
    }

    public function GetFullDentistDetails($doctor_user_id) {
        $this->ocdb->select('dm.dentist_id,dm.salutation,dm.first_name,dm.last_name,dm.date_of_birth,dm.specialities,dm.dci_reg_no,dm.education,dm.address,dm.gender,dm.city,dm.pincode,dm.state,dm.experience,dm.fees,dm.treatments,dm.locality,dm.image_name,dm.thumb_name,dm.is_updated,dm.treatments, u.email_id,u.about,u.is_active,u.profile_picture,u.mobile_no,c.id,c.name as city_name,s.id,s.name as state_name')
                ->from(' dentist_master as dm')
                ->join('users as u', 'u.user_id = dm.dentist_id')
                ->join('cities as c', 'c.id = dm.city')
                ->join('states as s', 's.id = dm.state')
                ->where('dm.dentist_id', $doctor_user_id);
        $query = $this->ocdb->get();
        $res = $query->result_array();
        if (count($res) > 0) {
            return $res[0];
        } else {
            return false;
        }
    }

    public function GetClinicDetails() {

        $where_array = array(
            'is_active' => '1'
        );
        $query = $this->ocdb->get_where('clinic_master', $where_array);

        foreach ($query->result() as $row) {
            $t = array();
            $t['label'] = $row->clinic_name;
            $t['value'] = $row->clinic_id;
            $t['add'] = $row->clinic_address;
            $commaSeparated[] = $t;
        }
        $js_array = json_encode($commaSeparated);
        return $js_array;
    }

    public function GetTreatments($treatments) {
        $this->ocdb->select('name as treatment_name')
                ->from('treatment_master')
                ->where_in('id', $treatments);
        $query = $this->ocdb->get();
        $res = $query->result_array();
        $result = array();
        if (count($res) > 0) {
            foreach ($res as $key => $value) {
                $result[] = $res[$key]['treatment_name'];
            }
        }
        return $result;
    }

    public function GetSpecialities($specialities) {
        $this->ocdb->select('name as speciality_name')
                ->from('speciality_master')
                ->where_in('id', $specialities);
        $query = $this->ocdb->get();
        $res = $query->result_array();
        $result = array();
        if (count($res) > 0) {
            foreach ($res as $key => $value) {
                $result[] = $res[$key]['speciality_name'];
            }
        }
        return $result;
    }

    public function fetchConfirmedAppointments() {
        $clause = array('dentist_user_id' => $this->session->user_id, 'is_approved' => '1');
        $this->ocdb->select('appointment_id,dentist_appointments.patient_user_id as patient_id,user_profile.first_name as patient_name,clinic_master.clinic_name,appointment_date,appointment_time');
        $this->ocdb->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->where($clause);
        $query = $this->ocdb->get();
        return($query->result_array());
    }

    public function fetchConfirmedAppointmentsByDate($date) {
        $clause = array('dentist_user_id' => $this->session->user_id, 'is_approved' => '1', 'appointment_date' => $date);
        $this->ocdb->select('appointment_id,dentist_appointments.patient_user_id as patient_id,,user_profile.first_name as patient_name,clinic_master.clinic_name,appointment_date,appointment_time')
                ->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->where($clause);
        $query = $this->ocdb->get();
        return($query->result_array());
    }

    public function fetchRejectedAppointments() {
        $clause = array('dentist_user_id' => $this->session->user_id, 'is_approved' => '2');
        $this->ocdb->select('appointment_id,user_profile.first_name as patient_name,clinic_master.clinic_name,appointment_date,appointment_time');
        $this->ocdb->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->where($clause);
        $query = $this->ocdb->get();
        return($query->result_array());
    }

    public function addTimeSlotsForPatient($dentist_data, $status = '0') {
        $data = array();
        $data1 = array('user_id' => $dentist_data['user_id'], 'date' => $dentist_data['date'], 'time_slots' => $dentist_data['availableTime'], 'clinic_id' => $dentist_data['clinic_id']);
        $data = array('status' => '1');
        $this->ocdb->where($data1);
        $count = $this->ocdb->update('dentist_available_time_slots', $data);
        return $count;
    }

    public function addAppointmentForPatient($data, $time) {
        $master = [ '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0'];
        $master[$data['availableTime']] = '1';
        $var = implode("", $master);
        $array = array(
            'patient_user_id' => $data['patient_id'],
            'dentist_user_id' => $this->session->user_id,
            'clinic_id' => $data['clinic_id'],
            'appointment_date' => $data['date'],
            'appointment_bit' => $var,
            'appointment_time' => $time,
            'is_approved' => '1',
            'acted_on' => date("Y-m-d h:i:s"),
            'appointment_status' => 'closed',
        );
        $count = $this->ocdb->insert('dentist_appointments', $array);
        return $count;
    }

    public function InsertPatientUserDetails($user_details) {
        $this->ocdb->insert('users', $user_details);
        $insert_id = $this->ocdb->insert_id();
        return $insert_id;
    }

    public function InsertPatientProfileDetails($profile_details) {
        $count = $this->ocdb->insert('user_profile', $profile_details);
        return $count;
    }

    public function RetrieveTimeSlotsforDate($array) {
        $this->ocdb->select('time_slots,status')
                ->from('dentist_available_time_slots')
                ->where($array);
        $query = $this->ocdb->get();
        return ($query->result_array());
    }

    public function addTimeSlots($dentist_data, $status = '0') {
        $data = array();
        $data1 = array('user_id' => $dentist_data['user_id'], 'date' => $dentist_data['date'], 'clinic_id' => $dentist_data['clinic_id']);
        $this->ocdb->select('time_slots')
                ->from('dentist_available_time_slots')
                ->where($data1);
        $query = $this->ocdb->get();
        foreach ($query->result_array() as $row) {
            $dbSlot[] = $row['time_slots'];
        }
        if (empty($dbSlot)) {
            $dbSlot = [];
        }
        if (empty($dentist_data['availableTime'])) {
            $chk = [];
        } else {
            $chk = $dentist_data['availableTime'];
        }
        $insert_diff = array_diff($chk, $dbSlot);
        $delete_diff = array_diff($dbSlot, $chk);
        $count = '';
        $date = $dentist_data['date'];
        if (!empty($insert_diff)) {
            foreach ($insert_diff as $key => $value) {
                $data[] = array('user_id' => $this->session->user_id, 'date' => $dentist_data['date'], 'clinic_id' => $dentist_data['clinic_id'], 'time_slots' => $value);
            }
            $count = $this->ocdb->insert_batch('dentist_available_time_slots', $data);
            $error = $this->ocdb->error();
        }
        if (!empty($delete_diff)) {
            foreach ($delete_diff as $key => $value) {
                $datadelete = array('user_id' => $this->session->user_id, 'date' => $dentist_data['date'], 'clinic_id' => $dentist_data['clinic_id'], 'time_slots' => $value);
                $this->ocdb->where($datadelete);
                $count+=$this->ocdb->delete('dentist_available_time_slots');
                unset($datadelete);
            }
        }
        return $count;
    }

    public function GetTimeSlotForClinic($data) {
        $this->ocdb->select('start_time,end_time')
                ->from('dentist_clinic_mount')
                ->where('dentist_id', $data['dentist_id'])
                ->where('clinic_id', $data['clinic_id']);
        $query = $this->ocdb->get();
        return( $query->row_array());
    }

    public function sum($value) {
        $slots = '000000000000000000000000000000000000000000000000';
        $this->ocdb->select('appointment_bit')
                ->from('dentist_appointments')
                ->where('dentist_user_id', $value['dentist_id'])
                ->where('clinic_id', $value['clinic_id'])
                ->where('appointment_date', $value['appointment_date']);
        $query = $this->ocdb->get();
        $myArray = $query->result_array();
        foreach ($myArray as $value) {
            $slots [strpos($value['appointment_bit'], "1")] = '1';
        }
        return($slots);
    }

    public function GetFullUserDetails() {
        $this->ocdb->select('id,full_name,address,email,mobile_no,pin,created_on')
                ->from('user_details');
                
        $query = $this->ocdb->get();
        return( $query->result_array());
    }

    public function deleteClinicModel($clinic_id) {

        $this->ocdb->where('clinic_id', $clinic_id);
        $this->ocdb->where('dentist_id', $this->session->user_id);
        $count = $this->ocdb->delete('dentist_clinic_mount');
        return $count;
    }

    public function fetchUserMasterDetailsModel($user_id) {
        $this->ocdb->select('id,full_name,address,email,mobile_no,pin,created_on')
                ->from('user_details')
                ->where('id', $user_id);
        $query = $this->ocdb->get();
        return( $query->row_array());
    }

    public function fetchLocalitiesById($city, $localityvalue) {
        $this->ocdb->select('id,name,city');
        $this->ocdb->from('locality');
        $this->ocdb->where('city', $city);
        $this->ocdb->order_by('name');
        $query = $this->ocdb->get();

        $localityarea = $query->result_array();
        $locality = '';
        foreach ($localityarea as $value) {
            if ($value['id'] == $localityvalue) {
                $locality.= "<option value='" . $value['id'] . "' selected >" . $value['name'] . "</option><br>";
            } else {
                $locality.= "<option value='" . $value['id'] . "' >" . $value['name'] . "</option><br>";
            }
        }
        return( $locality);
    }

    public function UpdateClinicDetailsModel($data) {
        $this->ocdb->where('clinic_id', trim($data['clinic_id']));
        $trimmed_array=array_map('trim',$data);
        $count = $this->ocdb->update('clinic_master', $trimmed_array);
        return $count;
    }

    public function UpdateClinicMountModel($clinic_id, $start_time, $end_time) {
        $array = ['start_time' => $start_time, 'end_time' => $end_time];
        $this->ocdb->where('clinic_id', $clinic_id);
        $this->ocdb->where('dentist_id', $this->session->user_id);
        $count = $this->ocdb->update('dentist_clinic_mount', $array);
        return $count;
    }

    public function UpdateUserDetails($array) {
        $this->ocdb->where('user_id', $this->session->user_id);
        $count = $this->ocdb->update('users', $array);
        return $count;
    }

    public function UpdateDentistDetails($array) {
        $this->ocdb->where('dentist_id', $this->session->user_id);
        $count = $this->ocdb->update('dentist_master', $array);
        return $count;
    }

    public function updateTreatmentsModel($data) {
        $count = $this->ocdb->insert('treatment_plan', $data);
         $insert_id = $this->ocdb->insert_id();
         $noti=array('treatment_id'=>$insert_id,
                        'auth_type'=>'preauth');
         $this->ocdb->insert('insurance_auth_notifications', $noti);
        return $insert_id;
    }

    public function fetchPatientDetails() {
        $query = $this->ocdb->select('users.user_id ,email_id,mobile_no,CONCAT(first_name, " ", last_name) as name')
                ->from('users')
                ->join('user_profile', 'user_profile.user_id = users.user_id')
                ->where('of_dentist', $this->session->user_id)
                ->get();
        return( $query->result_array());
    }
    
    public function fetchPatientDetailsForOcare()
    {
         $query = $this->ocdb->select('users.user_id ,email_id,mobile_no,CONCAT(first_name, " ", last_name) as name')
                ->from('users')
                ->join('user_profile', 'user_profile.user_id = users.user_id')
                 ->join('treatment_plan', 'treatment_plan.patient_id = users.user_id')
                ->where('treatment_plan.dentist_id', $this->session->user_id)
                 ->group_by('users.user_id ,email_id,mobile_no,name')
                ->get();
        return( $query->result_array());
        
    }

    public function UpdateAppointmentTable($value, $app_id) {
        $this->ocdb->where('appointment_id', $app_id);
        $count = $this->ocdb->update('dentist_appointments', $value);
        return $count;
    }

    public function RescheduleAppointmentTable() {
        $query = $this->ocdb->select('dentist_appointments', 'patient_user_id,dentist_user_id,clinic_id,patient_name')
                ->from('dentist_master')
                ->where('dentist_id', $this->session->user_id)
                ->get();
        $res = $query->result_array();
        $this->ocdb->insert('dentist_appointments', 'patient_user_id,dentist_user_id,clinic_id,patient_name');
    }

    public function fetchPatients() {
        $query = $this->ocdb->select('users.user_id ,email_id,mobile_no,user_profile.user_id,user_profile.first_name,user_profile.last_name,user_profile.gender,user_profile.city,user_profile.state,user_profile.city,user_profile.date_of_birth,user_profile.pincode')
                ->from('users')
                ->join('user_profile', 'user_profile.user_id = users.user_id')
                ->where('of_dentist', $this->session->user_id)
                ->where('user_type', 'personal_patient')
                ->get();
        return($query->result_array());
    }

    public function fetchPatientsOpen() {
        $query = $this->ocdb->select('patient_user_id,user_profile.first_name, dentist_appointments.clinic_id,clinic_name,dentist_appointments.appointment_date, dentist_appointments.appointment_time,user_profile.last_name,dentist_appointments.appointment_id')
                ->from('dentist_appointments')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->join('treatment_plan', 'treatment_plan.appointment_id = dentist_appointments.appointment_id', 'left')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->where('dentist_user_id', $this->session->user_id)
                ->where('dentist_appointments.appointment_id NOT IN (Select appointment_id from treatment_plan)')
                ->group_by('patient_user_id,user_profile.first_name,user_profile.last_name,dentist_appointments.appointment_id')
                ->get();
        //return($query->result_array());
        return($query->result_array());
    }

    public function fetchApointmentByDateModel($dentist_id, $date) {
        $clause = array('dentist_user_id' => $dentist_id, 'is_approved' => '0', 'appointment_date' => $date);
        $this->ocdb->select('appointment_id,user_profile.first_name, user_profile.last_name, users.mobile_no ,clinic_master.clinic_name,appointment_date,appointment_time,appointment_status');
        $this->ocdb->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id = dentist_appointments.patient_user_id')
                ->join('users', 'users.user_id = user_profile.user_id')
                ->where($clause)
                ->order_by('appointment_date', 'DESC');
        $query = $this->ocdb->get();
        return($query->result_array());
    }

    public function checkClinicExists($var) {
        $this->ocdb->where('clinic_name', $var)
                ->get('clinic_master');
        $query = $query->result_array();
        if (count($query) > 0) {
            return $query;
        } else {
            return '0';
        }
    }

    public function updateNewClinicForDentist($values) {
         $this->ocdb->insert('dentist_clinic_mount', $values);
        $insert_id = $this->ocdb->insert_id();
        return $insert_id;
       
    }

    public function addNewEntry($newClinic) {
        $this->ocdb->insert('user_details', $newClinic);
        $insert_id = $this->ocdb->insert_id();
        return $insert_id;
    }

    public function RetrieveTimeSlotsforDatePatient($array) {
        $this->ocdb->select('time_slots')
                ->from('dentist_available_time_slots')
                ->where($array)
                ->where('status', '0');
        $query = $this->ocdb->get();
        return ($query->result_array());
    }

    public function GetCompletedTreatments() {
        $this->ocdb->select('first_name,last_name,clinic_name,treatment_done,appointment_date,dentist_appointments.appointment_id')
                ->from('dentist_appointments')
                ->join('treatment_plan', 'treatment_plan.appointment_id=dentist_appointments.appointment_id')
                ->join('clinic_master', 'clinic_master.clinic_id = dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id=dentist_appointments.patient_user_id')
                ->where('treatment_plan.dentist_id', $this->session->user_id);
                

        $query = $this->ocdb->get();
        return ($query->result_array());
    }

    public function GetTreatmentMap() {
        /*
          $this->ocdb->where('tp.dentist_id',$this->session->user_id)
          ->where('tp.status','1')


         */
        $res = $this->ocdb->query("SELECT  CONCAT(first_name, ' ', last_name) as name , clinic_name,appointment_date, dentist_appointments.appointment_id,tp.id, tp.treatment_done, GROUP_CONCAT( tm1.name ) as treatment FROM treatment_plan tp LEFT JOIN ( SELECT tm.id, tm.name 
FROM treatment_master tm ) tm1 ON ( tp.treatment_done = tm1.id OR tp.treatment_done 
LIKE CONCAT(tm1.id,',','%') OR tp.treatment_done 
LIKE CONCAT('%',',',tm1.id, ',', '%') OR tp.treatment_done 
LIKE CONCAT('%',',',tm1.id)) 
JOIN dentist_appointments ON  tp.appointment_id=dentist_appointments.appointment_id 
JOIN treatment_plan ON treatment_plan.appointment_id=dentist_appointments.appointment_id
JOIN clinic_master ON clinic_master.clinic_id = dentist_appointments.clinic_id
JOIN user_profile ON user_profile.user_id=dentist_appointments.patient_user_id 
WHERE tp.dentist_id = ?  GROUP BY tp.id,first_name,last_name,clinic_name,appointment_date,dentist_appointments.appointment_id
", $this->session->user_id);

        //->group_by('tp.id');

        $res = $res->result_array();

        //$query = $this->ocdb->get();
        //return ($query->result_array());
        return($res);
    }
    
    public function GetTreatmentMapPast()
    {
        
               $res = $this->ocdb->query("SELECT CONCAT(first_name, ' ', last_name) as name ,tp.patient_id, ocare_id,tp.id, tp.treatment_done, GROUP_CONCAT( tm1.name ) as treatment FROM treatment_plan tp "
                       . "LEFT JOIN ( SELECT tm.id, tm.name FROM treatment_master tm ) tm1 ON ( tp.treatment_done = tm1.id OR tp.treatment_done LIKE CONCAT(tm1.id,',','%')"
                       . " OR tp.treatment_done LIKE CONCAT('%',',',tm1.id, ',', '%') OR tp.treatment_done LIKE CONCAT('%',',',tm1.id))  "
                       . "JOIN user_profile ON user_profile.user_id=tp.patient_id "
                       . "WHERE tp.dentist_id = ? AND tp.treatment_status ='postauth_approved' GROUP BY tp.id,first_name,last_name,ocare_id", $this->session->user_id);

        //->group_by('tp.id');

        $res = $res->result_array();

        //$query = $this->ocdb->get();
        //return ($query->result_array());
        return($res);
    }
    
    public function getTreatmentMapforId()
    {
        
               $res = $this->ocdb->query("SELECT CONCAT(first_name, ' ', last_name) as name ,tp.patient_id, ocare_id,tp.id, tp.treatment_done, GROUP_CONCAT( tm1.name ) as treatment FROM treatment_plan tp "
                       . "LEFT JOIN ( SELECT tm.id, tm.name FROM treatment_master tm ) tm1 ON ( tp.treatment_done = tm1.id OR tp.treatment_done LIKE CONCAT(tm1.id,',','%')"
                       . " OR tp.treatment_done LIKE CONCAT('%',',',tm1.id, ',', '%') OR tp.treatment_done LIKE CONCAT('%',',',tm1.id))  "
                       . "JOIN user_profile ON user_profile.user_id=tp.patient_id "
                       . "WHERE tp.dentist_id = ? AND tp.treatment_status = 'preauth_approved' GROUP BY tp.id,first_name,last_name,ocare_id", $this->session->user_id);

        //->group_by('tp.id');

        $res = $res->result_array();

        //$query = $this->ocdb->get();
        //return ($query->result_array());
        return($res);
    }

    public function fetchTreatmentDetailsModel($appointment_id) {

        $this->ocdb->select('*')
                ->from('treatment_plan')
                ->select('first_name,last_name,treatment_plan.appointment_id,treatment_plan.clinic_id')
                ->join('user_profile', 'user_profile.user_id=treatment_plan.patient_id')
                 
                
                ->where('treatment_plan.id', $appointment_id);


        $query = $this->ocdb->get();
        return ($query->row_array());
    }

    public function UpdatePostTreatmentModel($data,$json_history_newData) {
        
        
        $this->ocdb->where('id', $data['id']);
        
        $count = $this->ocdb->update('treatment_plan', $data);
         $this->ocdb->set('treatment_status_history', "JSON_MERGE(treatment_status_history, '" . $json_history_newData . "')", FALSE)->where('id', $data['id'])->update('treatment_plan');
         
         $noti=array('treatment_id'=>$data['id'],
                        'auth_type'=>'postauth');
         $this->ocdb->insert('insurance_auth_notifications', $noti);
        return $count;
    }

    public function GetDetsOnId($id) {

        $this->ocdb->select('clinic_master.clinic_name,dentist_appointments.clinic_id,appointment_id,first_name,last_name,patient_user_id')
                ->from('dentist_appointments')
                ->join('clinic_master', 'clinic_master.clinic_id=dentist_appointments.clinic_id')
                ->join('user_profile', 'user_profile.user_id=dentist_appointments.patient_user_id')
                
                ->where('appointment_id', $id);

        $query = $this->ocdb->get();
        return ($query->row_array());
    }

    public function getCityWiseLocalities($city_id) {

        $this->ocdb->select('id,name,city,state')
                ->from('locality')
                
                ->where('locality.city', $city_id)
                ->order_by('name');
        $query = $this->ocdb->get();
        return( $query->result_array());
    }
    
    
    public function fetchPatientProfile($ocareid)
    {
        $this->ocdb->select('user_profile.user_id,user_profile.is_insured,CAST(opg.created_at AS DATE) as date,first_name,last_name,gender,pincode,'
                . 'address,country,date_of_birth,email_id,mobile_no,'
                . 'dentist_appointments.appointment_id,dentist_appointments.clinic_id,cities.name as city,states.name as state')
                ->from('user_profile')
                ->join('users', 'users.user_id = user_profile.user_id','left')
                ->join('opg', 'opg.profile_id = user_profile.profile_id','left')
                ->join('cities', 'cities.id = user_profile.city','left')
                ->join('states', 'states.id = user_profile.state','left')
                ->join('dentist_appointments', 'dentist_appointments.patient_user_id = user_profile.user_id','left')
                ->order_by('dentist_appointments.created_on', 'DESC')
                ->limit('1')
                ->where('ocare_id',$ocareid);
                $query = $this->ocdb->get();
        return ( $query->result_array());
                
        
    }
    
        public function getPatientDetails($user_id) {
        //profile fetch
        $query = $this->ocdb->select('user_profile.*,mobile_no,email_id, treatment_done, cities.name as city_name, states.name as state_name')
                 ->from('user_profile')
                 ->where('user_profile.user_id',$user_id)
                 ->join('users', 'users.user_id = user_profile.user_id','left')
                 ->join('treatment_plan','treatment_plan.patient_id=user_profile.user_id','left')
                 ->join('cities','cities.id=user_profile.city','left')
                ->join('states','states.id=user_profile.state','left')
                ->order_by('treatment_plan.id', 'DESC')
                ->limit(1)
                 ->get()
                   ;
    
        $res = $query->result_array(); 
        if(count($res) > 0) {
            $res = $res[0];
            $treatments = $this->getTreatmentsforPatient('', '', $res['profile_id']);
            $res['treatments'] = $treatments;
        }
        return $res;
    }
    
        public function getTreatmentsforPatient($type = '', $treatment_id = '', $patient_id='', $dentist_id='') {
        $teatmentIds = $treatments = array();
        $query = $this->ocdb
                ->select([
                    'tp.id as treatment_id',
                    'tp.treatment_type',
                    'tp.treatment_status',
                   
                    'tp.tooth_no',
                    'tp.chief_complaint',
                    'tp.treatment_type',
                    'tp.amount',
                    'tp.diagnosis',
                    'up.profile_id',
                    'dm.dentist_id',
                    'up.first_name as patient_first_name',
                    'up.middle_name as patient_middle_name',
                    'up.last_name as patient_last_name',
                    'up.user_id',
                    'up.parent_user_id',
                    'dm.salutation as dentist_salutation',
                    'dm.first_name as dentist_first_name',
                    'dm.middle_name as dentist_middle_name',
                    'dm.last_name as dentist_last_name',
                    'cm.clinic_name',
                    'tp.treatment_done'
                ])
                ->from('treatment_plan as tp')
                ->join('user_profile as up', 'up.user_id = tp.patient_id')
                ->join('dentist_master as dm', 'dm.dentist_id = tp.dentist_id')
                ->join('clinic_master as cm', 'cm.clinic_id=tp.clinic_id', 'left outer')
                
                ;
        if($patient_id) {
            $query = $query->where('up.profile_id', $patient_id);
        }
        if($dentist_id) {
            $query = $query->where('dm.dentist_id', $dentist_id);
        }
        if($treatment_id) {
            $query = $query->where('tp.id', $treatment_id);
        }
        elseif($this->session->selected_city) {
            $query = $query->where('up.city', $this->session->selected_city);
        }
        if($type == 'post') {
            $query = $query->where('tp.treatment_status', 'approved');
        }
        #echo $query->get_compiled_select();die;
        $query = $query->order_by('tp.id', 'DESC');
        $query = $query->get();
        $res = $query->result_array();
        if(count($res)> 0) {
            
            //Collect treatment Ids from all comma seperated values to get treatmentr names further START
            foreach ($res as $k=>$r) {
                $tm = explode(',', $r['treatment_done']);
                $res[$k]['treatment_done'] = $tm;
                $ncount = count($tm);
                for($i = 0; $i < $ncount; $i++) {
                    if(!in_array($tm[$i], $teatmentIds)) {
                        $teatmentIds[] = $tm[$i];
                    }
                }
            }
            $query = $this->ocdb->select(['id','name'])->from('treatment_master')->where_in('id', $teatmentIds)->get();
            $res2 = $query->result_array();
            if(count($res2) > 0) {
                foreach($res2 as $r) {
                    $treatments[$r['id']] = $r['name'];
                }
            }
            //Collect treatment Ids from all comma seperated values to get treatmentr names further END
            
            //Replace Treatment Name s with Treatment ID and name array START
            foreach($res as $k=>$r) {
                $td = array();
                foreach($r['treatment_done'] as $k1=>$t) {
                    $td[$t] = $treatments[$t];
                }
                $res[$k]['treatment_done'] = $td;
            }
            //Replace Treatment Name s with Treatment ID and name array END
        }
        #pr($res,1);
        return $res;
    }
    
    
        public function query($query) {
            
        /*
          $this->ocdb->where('tp.dentist_id',$this->session->user_id)
          ->where('tp.status','1')


         */
        $res = $this->ocdb->query($query);

       

        $res = $res->result_array();

        //$query = $this->ocdb->get();
        //return ($query->result_array());
        return($res);
    }
    
    public function insertQuery($query) {
       
        $res = $this->ocdb->query($query);

        $insert_id = $this->ocdb->insert_id();
        return $insert_id;
    }

    public function updateDeleteQuery($query) {
        $res = $this->ocdb->query($query);
        return 1;
    }
    
    public function getScheduleById($id) {
        $this->ocdb->select('*')
                ->from('schedules')
                ->where('id',$id);
        
        $query = $this->ocdb->get();
        return ( $query->result_array());
    }
    
    
    public function addClinicTimings($data)
    {
        
        for($i=0;$i<=$days;$i++)
        {
        
        foreach($data['start_time'] as $index => $value)
        {
        
        $this->ocdb->insert('schedules', array('dentist_id'=>$this->session->user_id,
                                                'clinic_id'=>$data['clinic_id'],
                                                'day'=>$data['dayofweek'] ,
                                                'start_time'=>$value,
                                                'end_time'=>$data['end_time'][$index]
                
                
                   ));
        
        }
        
        }
        
       
        
   }
   
   
  
   }


?>
