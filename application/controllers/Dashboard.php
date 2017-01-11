<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_Model');
        $this->load->model('User_Model');
    }

    public function Index() {
       
        $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        } else {
		
            $this->doctorclinics();
         
        }
    }

    

    public function doctorclinics() {
        $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        }
       // $this->data['dentist_details'] = $this->User_Model->GetFullDentistDetails($this->session->user_id);
       $this->data['pagetitle'] = 'User Dashboard';
        $this->data['user_details'] = $this->User_Model->GetFullUserDetails();
        $this->data['js'] = array('dateslotchecker.js');
        $this->data['js'] = array('clinics.js');
        $this->load->view('common/headpart', $this->data);
        $this->load->view('common/sidebar', $this->data);
        $this->load->view('doctorclinics', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    

    public function deleteclinic() {
        $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        }
        $count = $this->User_Model->deleteClinicModel($_POST['clinic_id']);
        if ($count > 0) {
            echo "1";
        }
    }

    public function fetchUserMasterDetails() {
        
         $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        }
       

        $returnvalue = $this->User_Model->fetchUserMasterDetailsModel($_POST['id']);

        $this->load->helper('file');
       
        $id=$_POST['id'];
          $dirname =  SERVER_ROOT . '/uploads/users/' . $id;
          
        $this->data['files'] = get_filenames($dirname);
        
        $this->data['user'] = $returnvalue;
        
        $this->data['pagetitle'] = 'Update User';
  
        $this->load->view('common/headpart', $this->data);
        $this->load->view('common/sidebar', $this->data);
        $this->load->view('updateClinicDetails', $this->data);
        $this->load->view('common/footer', $this->data);
    }

    

      public function getAllUsers() {
        $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        }
        $this->data['user_details'] = $this->User_Model->getAllUsers();
        echo json_encode($this->data['appointment_details']);
    }

   

    public function addNewEntry() {
        $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        }
        
//        print_r($_POST); print_r($_FILES);  die;
        
   
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $dataForMaster = $_POST;
	unset($dataForMaster['g-recaptcha-response']);
    
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors();
        } else {
            $clinic_id = $this->User_Model->addNewEntry($dataForMaster);
            
           
             $user_folder = SERVER_ROOT . '/uploads/users/' . $clinic_id;

            if (!is_dir($user_folder)) {
                mkdir($user_folder, 0777);
            }
            
            $config['upload_path']   = SERVER_ROOT . '/uploads/users/'. $clinic_id; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         
         $this->load->library('upload', $config);
			
         
        $files = $_FILES;
    $cpt = count($_FILES['pre_images']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['pre_images']['name']= $files['pre_images']['name'][$i];
        $_FILES['pre_images']['type']= $files['pre_images']['type'][$i];
        $_FILES['pre_images']['tmp_name']= $files['pre_images']['tmp_name'][$i];
        $_FILES['pre_images']['error']= $files['pre_images']['error'][$i];
        $_FILES['pre_images']['size']= $files['pre_images']['size'][$i];    

        $this->upload->initialize($this->set_upload_options($clinic_id,$i));
         if ( ! $this->upload->do_upload('pre_images')) {
            $error = array('error' => $this->upload->display_errors()); 
            print_r($error); 
       }

	


	$mailto="dclyde14@gmail.com";  //Enter recipient email address here
 

    //  $subject = "Test Email";
    
    if(!empty($_POST['select']) && !empty($_POST['name'])&& !empty($_POST['phone'])&& !empty($_POST['message']))
    {
    $subject='New User Details'; 
   $name=$_POST['full_name'];
    
    $emailid      = $_POST['email']; 
	$phone       = $_POST['phone'];
	$address    = $_POST['address']; 

       $from="info@localhost.com";          //Your valid email address here
       
       
       
       //$headers="From: info@abroadavenuez.com" . "\r\n" .
     
     $headers .= 'From: Abroad Avenuez <info@abroadavenuez.com>' . "\r\n";
    
      
       $message_body= "Name: $name  Email:  $emailid   Phone: $phone   Message: $address"; 

	    if(@mail($mailto,$subject,$message_body,$headers))
	    {
	    echo "success";
	    }
	    
	    else
	    {
	    
	    echo "error";
	    }
     
  
   }
   
   else
   {
   
   echo "error";
   }    
       
     
       
    }
        
           
           
        
    }
    
    redirect(base_url(''));
  }
    
    private function set_upload_options($clinic_id,$i) {
        $user_id = $this->session->user_id;
        if (!$user_id) {
            redirect(base_url('login'));
        }
        //upload an image options
        $config = array();
        $config['upload_path'] = SERVER_ROOT . '/uploads/users/'. $clinic_id;
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['file_name'] = $i. '.png';
        $config['overwrite'] = FALSE;

        return $config;
    }
    
    

}
