<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logincontroller extends MY_Controller
{
	//https://avenir.ro/codeigniter-tutorials/creating-using-page-templates-codeigniter/
	protected $data = array();

	function __construct()
	{
		parent::__construct();
		$this->data['title'] = getenv('APP_NAME');
		//$this->session->set_userdata ( 'isLoggedIn', TRUE);
	}

	public function index()
	{
		
			$this->load->view(getenv('TEMPLATE_THEME') . '/auth/login_view');
		
	}

	public function validate_login()
	{
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		//print_r($username);
		$this->load->library('loginLib');
		$util = new loginLib();
		$checkUser = $util->getLoginUser($username, $password);
		if ($checkUser) {
			redirect('/users');
		} else {
			// Display error message
			$this->session->set_flashdata('flashError', 'Error de usuario y/o contraseña o usuario desactivado.');
			redirect('/login');
		}
	}

	public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->clear_cache();
        //$this->session->set_userdata(array('user_id' => '', 'isLogged' => FALSE));
        session_destroy();
        $this->session->sess_destroy();
        redirect('/');
    }

    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
	
}
