<?php

class MY_Controller extends CI_Controller
{
	//https://avenir.ro/codeigniter-tutorials/creating-using-page-templates-codeigniter/
	protected $data = array();
	protected $global = array();

	function __construct()
	{
		parent::__construct();
		$this->global['title'] = getenv('APP_NAME');
		
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	/*function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLogged' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( 'login' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			$this->lastLogin = $this->session->userdata ( 'lastLogin' );
			$this->isAdmin = $this->session->userdata ( 'isAdmin' );
			$this->accessInfo = $this->session->userdata ( 'accessInfo' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
			$this->global ['last_login'] = $this->lastLogin;
			$this->global ['is_admin'] = $this->isAdmin;
			$this->global ['access_info'] = $this->accessInfo;

			print_r($this->global);
		}
	}*/

	//protected function render($the_view = NULL, $template = 'admin')
	protected function render($the_view = NULL, $module = NULL)
	{
		//$test = 'templates/' . $template . '/index';
		$module =  $this->session->userdata('user_guard');
		//var_dump($test);
		if ($module == 'json' || $this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo json_encode($this->data);
		} elseif (is_null($module)) {
			$this->load->view(getenv('TEMPLATE_THEME').'/' .$the_view, $this->data);
		} else {
			$this->data['content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
			$this->load->view(getenv('TEMPLATE_THEME').'/' . $module . '/index', $this->data);
			//$this->load->view('templates/main', $this->data);
			//$this->load->view('layouts/admin', $this->data);
		}
	}
}
