<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends MY_Controller {

    
    public function index_User()
    {
        //$this->load->view(getenv('TEMPLATE_THEME') .'/auth/loginUser');
		//$this->render('auth/loginUser');
        //$this->load->view('auth/testlogin');
        if($this->session->userdata('isLogged')){
            redirect('/users');
        }else{
            //$this->load->view('auth/loginUser');
			$this->render('auth/loginUser');
        }
        
    }

    public function loginUser()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        //print_r($username);
        $this->load->library('loginLib');
        $util = new loginLib();
        $checkUser = $util->getLoginUser($username, $password);
        if($checkUser){
            redirect('/users');
        }else{
            // Display error message
            $this->session->set_flashdata('flashError', 'Error de usuario y/o contraseña o usuario desactivado.');
            redirect('/wp-login');
        }
    }

    public function index_Admin()
    {
        /*if($this->session->userdata('isLogged')){
            redirect('/admin');
        }else{
            $this->load->view('auth/loginAdmin');
        }*/
        $this->load->view('auth/loginAdmin');
    }

    public function loginAdmin()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        //print_r($username);
        $this->load->library('loginLib');
        $util = new loginLib();
        $checkAdmin = $util->getLoginAdmin($username, $password);
        if($checkAdmin){
            redirect('/admin');
        }else{
            $this->session->set_flashdata('flashError', 'Error de usuario y/o contraseña.');
            redirect('/wp-admin');
        }
    }

}
