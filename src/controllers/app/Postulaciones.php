<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Postulaciones extends CI_Controller
{


    private $accessoPermitido;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'my_tag_helper'));
        $this->load->model('offerjobeloquent');
        $this->load->model('postulatejobeloquent');
        $this->load->model('usereloquent');
        $this->form_validation->set_message('no_repetir_email', 'Existe otro registro con el mismo %s');
        /**
         * En caso se defina el campo mobile como único, validaremos si ya se registró anteriormente
         */
        $this->form_validation->set_message('no_repetir_mobile', 'Existe otro registro con el mismo %s');
    }

    public function index()
    {
        if ($this->session->userdata('user_rol') != NULL) {
            $data['query'] = Postulatejobeloquent::getPostulations($this->session->userdata('user_id'));
            $data['pagina'] = getenv('TEMPLATE_THEME').'/app/postulaciones_view';
            //echo json_encode($data['query']);
            $this->load->view(getenv('TEMPLATE_THEME').'/app/app_view', $data);
        } else {
            $this->session->set_flashdata('error', '');
            redirect('/login');
        }
    }
}
