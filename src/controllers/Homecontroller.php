<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

    public function index()
    {
        $this->load->view('home');
        //$this->load->view('hometest');
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

/* End of file Controllername.php */
