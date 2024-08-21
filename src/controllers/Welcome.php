<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view(getenv('TEMPLATE_THEME').'/home_view');
	}

	public function yidas()
	{
		$this->load->model('user_model', 'UserModel');

		$users = $this->UserModel->findAll();
		//print_r((array)$users);
		header('Content-Type: Application/json');
		// Print all properties for each active record from array
		foreach ($users as $activeRecord) {
			print_r($activeRecord->toArray());
			//echo json_encode($activeRecord->toArray());
		}
	}
}
