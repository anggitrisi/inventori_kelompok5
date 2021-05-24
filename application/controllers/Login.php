<?php

class Login extends CI_controller{
    public function __construct(){
		parent::__construct();
	}
    public function index(){
        $this->load->view('login');
    
    }

    public function register(){
        $this->load->view('register');
    
    }
    
    public function newRegistrationforuser()
    {
        extract($_POST);
        $full_name = $this->input->post ('full_name');
        $username = $this->input->post ('user_name');
        $password = $this->input->post ('password');
                        // echo "<pre>";print_r($_POST);exit;
        // $email = $this->input->post('email');
        
        // $data = array('EMP_NAME'=>$full_name,'EMP_EMAIL'=>$email);
        // $getInsertedId = $this->UsersModel->create_record('employee_profile',$data);
        
        $data = array(
            'FULL_NAME'=>$full_name,
            'USER_NAME'=>$username,
            'U_PASSWORD'=>sha1(md5($password)),
            // 'EMP_NO' => $getInsertedId,
            'GROUP_ID' => 2,
            'STATUS'  => 1

        );
        $response = $this->UsersModel->registerUser($data);
        if($response == 1){
            $this->session->set_flashdata('success', 'User Registered Successfully');
            redirect (base_url().'Login');

        }else{
            $this->session->set_flashdata('error', 'User registration Failed');
            redirect (base_url().'Login');
    
        }
    }

    public function authLogin(){
        $email = $this->input->post('u_email');
        $password = $this->input->post('u_password');
        $login = $this->UsersModel->authenticateUser($email, $password);
        if($login){
            //Define variabel to store data into session
            $this->session->set_userdata('user_id',$login['USER_ID']);
            $this->session->set_userdata('username',$login['USER_NAME']);
            $this->session->set_userdata('group_id',$login['GROUP_ID']);
            $getLoggedInGroup = $this->UsersModel->getLoggedInUserGroup($login['GROUP_ID']);
            $this->session->set_userdata('group_name',$getLoggedInGroup['GROUP_NAME']);
            if($login['GROUP_ID'] ==1 ){
                redirect(base_url().'Dashboard');
            } else{
                redirect(base_url().'Dashboard');
            }
            
            }
            else {

                $this->session->set_flashdata('msg', 'Username Or Password is Invalid');
                redirect(base_url() . 'login');
            }
        }


    public function logoutUser(){
        $this->session->sess_destroy();

        redirect(base_url());
    }
}

?>