<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $bulkUploadExcelHeader;

    function __construct() {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    
    private function setUserSession($param) {
        $this->session->user_name = $param['response']['user_name'];
        $this->session->user_id = $param['response']['user_id'];
        $this->session->full_name = $param['response']['full_name'];
        $this->session->user_details = $param['response'];
    }
    
    public function Logout() {
        unset($_SESSION['user_name'], $_SESSION['user_id'], $_SESSION['full_name'], $_SESSION['user_details']);
        redirect(base_url());
    }
    
    public function Login($redirect = '') {
        if ($redirect == '')
            $redirect = base_url();
        $this->data['pagetitle'] = 'User Login';
        $this->data['redirect'] = $redirect;
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.')
        );
        if ($this->form_validation->run() === FALSE) 
        {
            $user_id = '';
            if ($this->session->user_id) 
            {
                $user_id = $this->session->user_id;
            }
            $this->data['user_details'] = $this->User_Model->getUserDetails($user_id);
            $this->load->view('common/headpart', $this->data);
            $this->load->view('Login_View', $this->data);
            $this->load->view('common/footer', $this->data); 
            
        } 
        else 
        {
            $res = $this->User_Model->authenticateUser($_POST);
            if ($res['status'] == 'ok') 
            {
                $this->setUserSession($res);
                redirect($redirect);
            } 
            else 
            {
                $this->common_Model->setMessage($res['message']);
                $this->data['data']['res'] = $res;
            $this->load->view('common/headpart', $this->data);
            $this->load->view('Login_View', $this->data);
            $this->load->view('common/footer', $this->data); 
            }
        }
    }
    
    public function signup($redirect = '') {
        if ($redirect == '')
            $redirect = base_url();
        $this->data['pagetitle'] = 'User Signup';
        $this->data['redirect'] = $redirect;
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.')
        );
        if ($this->form_validation->run() === FALSE) 
        {
            $user_id = '';
            if ($this->session->user_id) 
            {
                $user_id = $this->session->user_id;
            }
            $this->data['user_details'] = $this->User_Model->getUserDetails($user_id);
            $this->load->view('common/headpart', $this->data);
            $this->load->view('signup', $this->data);
            $this->load->view('common/footer', $this->data); 
            
        } 
        else 
        {
            $res = $this->User_Model->authenticateUser($_POST);
            if ($res['status'] == 'ok') 
            {
                $this->setUserSession($res);
                redirect($redirect);
            } 
            else 
            {
                $this->common_Model->setMessage($res['message']);
                $this->data['data']['res'] = $res;
            $this->load->view('common/headpart', $this->data);
            $this->load->view('signup', $this->data);
            $this->load->view('common/footer', $this->data); 
            }
        }
    }

    public function register($redirect = '') {
        if ($redirect == '')
            $redirect = base_url();
        $this->data['redirect'] = $redirect;
       $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.')
        );
        if ($this->form_validation->run() === FALSE) 
        {
            $user_id = '';
            if ($this->session->user_id) 
            {
                $user_id = $this->session->user_id;
            }
            $this->data['user_details'] = $this->User_Model->getUserDetails($user_id);
            $this->load->view('common/headpart', $this->data);
            $this->load->view('signup', $this->data);
            $this->load->view('common/footer', $this->data); 
            
        } 
        else 
        {
            $res = $this->User_Model->registerUser($_POST);
            echo json_encode($res);
  
        }
    }

    public function Unauthorize() {
        $this->data['pagetitle'] = 'Unauthorize Access';
        $this->load->view('common/headpart', $this->data);
        $this->load->view('common/sidebar');
        $this->load->view('user/unauthorize');
        $this->load->view('common/footer');
    }

}
?>

