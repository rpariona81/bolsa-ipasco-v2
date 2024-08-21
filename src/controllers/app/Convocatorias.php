<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Convocatorias extends CI_Controller
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
        //print_r($this->session->userdata);
        //$accessoPermitido = $this->session->has_userdata('isLogged') ? $this->session->userdata('isLogged') : FALSE;
        if ($this->session->userdata('user_rol') != NULL) {
            $data = [];
            //$data['rol'] = $this->session->userdata('user_rol');
            //$data['pagina'] = 'app/listConvocatorias';
            $data['pagina'] = getenv('TEMPLATE_THEME').'/app/convocatorias_view';
            if ($this->session->userdata('user_rol') == 'estudiante') {
                $data['recuento'] = Offerjobeloquent::getTotOffersjobsByVigency($this->session->userdata('user_carrera_id'));
                $data['queryVigentes'] = Offerjobeloquent::getOffersjobsVigentes($this->session->userdata('user_carrera_id'));
                $data['queryNoVigentes'] = Offerjobeloquent::getOffersjobsNoVigentes($this->session->userdata('user_carrera_id'));
            } else {
                $data['recuento'] = Offerjobeloquent::getTotOffersjobsByVigency();
                $data['queryVigentes'] = Offerjobeloquent::getOffersjobsVigentes();
                $data['queryNoVigentes'] = Offerjobeloquent::getOffersjobsNoVigentes();
            }
            $this->load->view(getenv('TEMPLATE_THEME').'/app/app_view', $data);
        } else {
            $this->session->set_flashdata('error');
            redirect('/login');
        }
    }
}
