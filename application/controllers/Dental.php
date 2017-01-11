<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dental extends CI_Controller {
    private $data = array();
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Dentist_Model');
        $_SESSION['user_id']=15;
    }

    public function index() {
       
        
    }
    
    
    //Checks if clinic exists in DB.
    public function addNewClinic() 
    { 
        
        $clinic_data=$_POST;
        print_r($clinic_data); die;
        $checkresult=$this->Dentist_Model->checkClinicExists($clinic_data['clinic_name']);
        if ($checkresult!='0')
        {
            $status=$this->Dentist_Model->updateNewClinicForDentist($clinic_data);
            if($status==1)
            {   
                echo"true"; die;
            }
        }
        else 
        {   
        }
    }
      
    public function addNewClinicToMaster(){
          print_r($_POST); die;
        $this->form_validation->set_rules('clinic_name', 'Clinic Name', 'required');
        $this->form_validation->set_rules('clinic_office_no', 'Phone', 'required');
        $this->form_validation->set_rules('clinic_address', 'Address', 'required');
        $this->form_validation->set_rules('clinic_email', 'Email', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $dataForMapping=$_POST;
        $dataForMaster=$_POST;
        unset($dataForMaster['start_time']);
        unset($dataForMaster['end_time']);
        if ($this->form_validation->run() === FALSE)
        {
            echo validation_errors();
        }
        else
        {
            $clinic_id=$this->Dentist_Model->addNewClinicToMasterModel($dataForMaster);
            $clinic_data=array(
                'dentist_id'=>$this->session->user_id,
                'clinic_id'=>$clinic_id,
                'start_time'=>$dataForMapping['start_time'],
                'end_time'=>$dataForMapping['end_time'],
                'is_active'=>'1' 
            );
            $status=$this->Dentist_Model->updateNewClinicForDentist($clinic_data);
            if($status>0)
            {
                redirect(base_url());
            }
        }
    }
    
    public function checkTimeSlot(){
        $timeSlotArray= array('10am-11am','11am-12pm','12pm-01pm','03pm-04pm','04pm-05pm'); 
        $storearray=$this->AddDataModel->RetrieveTimeSlotsforDate($_POST);
        if($storearray)
        {
            $checkbox="";
            $uncheckbox="";
            $a='checked';
            foreach($storearray as $row)
            {
                $tobecheckedwith[]= $row['time_slots'];
            }
            $i=0;
            foreach ($timeSlotArray as $row)
            {  
                if(in_array( $row,$tobecheckedwith))
                { 
                    $checkbox.= "<input type='checkbox'  name='availableTime[]' value='".$row."' ".$a."> ".$row."<br>";
                }
                else 
                {
                    $checkbox.= "<input type='checkbox'  name='availableTime[]' value='".$row."' > ".$row."<br>";
                }
            }
            $this->data['checkbox']=$checkbox;
            echo $checkbox;
        }
        else
        {
            echo '<input type="checkbox" name="availableTime[]" value="10am-11am"> 10am-11am<br>
                <input type="checkbox" name="availableTime[]" value="11am-12pm"> 11am-12pm<br>
                <input type="checkbox" name="availableTime[]" value="12pm-01pm"> 12pm-01pm<br>
                <input type="checkbox" name="availableTime[]" value="03pm-04pm"> 03pm-04pm<br>
                <input type="checkbox" name="availableTime[]" value="04pm-05pm"> 04pm-05pm<br';
        }
        die;
    }
    
    public function updateDentistDetails()
    {            
        $treatments_selected= implode(",",$_POST['treatment']);
        $specialities_selected= implode(",",$_POST['speciality']);
        $detail_array=array(
            'salutation'=>'Dr',
            'first_name'=>$_POST['first_name'],
            'date_of_birth'=>$_POST['dob'],
            'dci_reg_no'=>$_POST['dci_number'],
            'state'=>$_POST['state'],
            'gender'=>$_POST['gender'],
            'specialities'=>$specialities_selected,
            'city'=>$_POST['city'],
            'address'=>$_POST['address'],
            'locality'=>$_POST['locality'],
            'experience'=>$_POST['experience'],
            'fees'=>$_POST['fees'],
            'pincode'=>$_POST['pincode'],
            'treatments'=>$treatments_selected,
            'is_updated'=>'1'
        );
        $detail_usertable=array (
            'mobile_no'=>$_POST['mobile'],
            'email_id'=>$_POST['email'],
            'about'=>$_POST['about'],
            'user_type'=>'dentist',
            'user_source'=>'tdn'
        );
        $result=$this->Dentist_Model->UpdateDentistDetails($detail_array);
        $result1=$this->Dentist_Model->UpdateUserDetails($detail_usertable);
        if(($result>'0')&& ($result1>'0'))
        {
            redirect(base_url());
        }
    }
      
    public function addNewPatient()
    {
        echo "die"; die;
        $user_table=array( 
            'user_name'=>  $_POST['email_id'],  
            'email_id'=>$_POST['email_id'],
            'mobile_no'=>$_POST['mobile_no'],
            'about'=>$_POST['about'],
            'user_type'=>'personal_patient',
            'of_dentist'=>$this->session->user_id
        );
        $user_id=$this->Dentist_Model->InsertPatientUserDetails($user_table);
        $user_profile=array( 
            'user_id'=>$user_id,
            'first_name'=>$_POST['first_name'],
            'last_name'=>$_POST['last_name'],
            'gender'=>$_POST['gender'],
            'address'=>$_POST['address'],
            'state'=>$_POST['state'],
            'city'=>$_POST['city'],
            'date_of_birth'=>$_POST['dob']
        );
        $result=$this->Dentist_Model->InsertPatientProfileDetails($user_profile);
        if(($result>'0'))
        {
            redirect(base_url());
        }
    }

    public function showProfile()
    {         
        $this->data['dentist_details']=$this->Dentist_Model->GetFullDentistDetails($this->session->user_id);
        $this->data['treatments']=$this->Dentist_Model->GetAvailableTreatments();
        $this->data['state']=$this->Dentist_Model->GetAvailableStates();
        $this->data['speciality']=$this->Dentist_Model->GetAvailableSpeciality();
        $this->data['city']=$this->Dentist_Model->GetAvailableCity();
        $this->data['getstateforid']=$this->Dentist_Model->GetStateForId();
        $specialityString=$this->data['dentist_details']['specialities'];
        $treatmentsString=$this->data['dentist_details']['treatments'];
        $this->data['specialityArray']=explode(",",$specialityString);
        $this->data['treatmentsArray']=explode(",",$treatmentsString);
        $this->data['images'] = $this->upload_model->get_images();
        $profiledData['profile_picture'] = $this->data['dentist_details']['profile_picture'];
        $this->data['profiledData'] = $profiledData;
        $this->load->view('updateprofile',$this->data);
    }
 
    public function Prpicupl() {
        $errors = array();
        $retVal = array('status'=>'ok', 'message'=>'success');
        $config['upload_path'] = SERVER_ROOT . '/resources/prpic';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name'] = $this->session->user_id . '.jpg';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('prpicfile'))
        {
            $errors = $this->upload->display_errors();
        }
        else
        {
            $upload_data = $this->upload->data();
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = SERVER_ROOT . '/resources/prpic/' . $upload_data['file_name'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = 252;
            $config['height']       = 300;
            $config['new_image'] = SERVER_ROOT . '/resources/prpic/thumbnails/' . $upload_data['file_name'];
            $config['thumb_marker']  = '';
            unset($this->image_lib);
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $err = $this->image_lib->display_errors();
            if($err) 
            {
                $errors[] = $err;
            }
            else 
            {
                $retVal['imageurl'] = base_url('/resources/prpic/' . $upload_data['file_name']);
                $retVal['thumbimageurl'] = base_url('/resources/prpic/thumbnails/' . $upload_data['file_name']) . '?nc=' . time();
                $this->AddDataModel->prPicUpload($this->session->user_id);
            }
        }
        if(count($errors) == 0) 
        {
            ?>
            <html><head><script>parent.postprpicupload(<?php echo json_encode($retVal); ?>);</script></head></html>
            <?php
        }
    }
    
    public function removePrPic() {
        $user_id = $this->input->post('user_id');
        $this->data['data'] = $this->AddDataModel->removePrPic($user_id);
        $this->load->view('jsonresponse', $this->data);
    }
    
    public function writetofile(){
        echo "hey"; die;
        $this->load->helper('file');
        $data = '
            BEGIN:VCALENDAR
            METHOD:PUBLISH
            VERSION:2.0
            PRODID:-//Thomas Multimedia//Clinic Time//EN
            BEGIN:VEVENT
            SUMMARY:Emily Henderson
            UID:3097
            STATUS:CONFIRMED
            DTSTART:20120509T031500Z
            DTEND:20120509T033000Z
            LAST-MODIFIED:20120509T031500Z
            LOCATION:Bundall Clinic Room 1
            END:VEVENT
            END:VCALENDAR';
        if ( !write_file('./uploads/file.ics', $data))
        {
            echo 'Unable to write the file';
        }
        else
        {
            echo 'File written!';
        }
    }  
}
?>