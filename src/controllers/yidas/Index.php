<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
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
		$this->load->view('yidas/home');
	}

	public function yidas()
	{
		$this->load->model('UserEloquent', 'UserModel');

		$users['records'] = $this->UserModel->All();
		//$users['records'] = $this->UserModel->paginate();
		//print_r(json_encode($users));
		//print_r((array)$users);
		//header('Content-Type: Application/json');
		print_r(json_encode($users));
		// Print all properties for each active record from array
		/*foreach ($users as $activeRecord) {
		//	print_r($activeRecord->toArray());
			echo json_encode($activeRecord->toArray());
		}*/
	}

	public function creaUser()
	{
		$this->load->model('UserEloquent');

		// Create an Active Record
		$post = new UserEloquent;
		$post->username = "MappTrinos sTosmas"; // Equivalent to `$post['title'] = 'CI3';`
		$post->display_name = "PPaRTMarinosTsraomas"; // Equivalent to `$post['title'] = 'CI3';`
		$post->email = "marsatinppo@gmail.com";
		$post->save();
		$lastInsertID = $this->UserEloquent::latest()->first();
		
		//echo json_encode($lastInsertID->toArray());
		echo json_encode($lastInsertID['id']).'<br/>';
		// Update the Active Record found by primary key
		$post = $this->UserEloquent->findOrFail($lastInsertID['id']);
		if ($post) {
			$oldUsername = $post->username; // Equivalent to `$oldTitle = $post['title'];`
			$post->username = "NePP MaTrino aaRrsTomas";
			$post->save();
		}

		echo json_encode($post);
	}
}
