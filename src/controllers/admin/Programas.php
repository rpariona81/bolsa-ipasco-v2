<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'my_tag_helper'));
		$this->load->model('offerjobeloquent');
		$this->load->model('postulatejobeloquent');
		$this->load->model('usereloquent');
		$this->load->model('admineloquent');
		$this->load->model('careereloquent');
		$this->form_validation->set_message('no_repetir_username', 'Existe otro registro con el mismo %s');
		$this->form_validation->set_message('no_repetir_email', 'Existe otro registro con el mismo %s');
		$this->form_validation->set_message('no_repetir_document', 'Existe otro registro con el mismo %s');
		$this->form_validation->set_message('no_repetir_email_admin', 'Existe otro registro con el mismo %s');
		$this->form_validation->set_message('no_repetir_programa', 'Existe otro programa con el mismo %s');
		/**
		 * En caso se defina el campo mobile como único, validaremos si ya se registró anteriormente
		 */
		$this->form_validation->set_message('no_repetir_mobile', 'Existe otro registro con el mismo %s');
	}

	
	/**
     * CONTROL DE PROGRAMAS DE ESTUDIOS
     *  */

    public function verProgramas()
    {
        if ($this->session->userdata('user_rol') == 'admin') {
            $data['query'] = Careereloquent::all();
            $data['contenido'] = 'admin/programasTable';
            $this->load->view('admin/templateAdmin', $data);
        } else {
            $this->session->set_flashdata('error');
            redirect('/wp-admin');
        }
    }

    public function editaPrograma($id)
    {
        if ($this->session->userdata('user_rol') == 'admin') {
            $data['programa'] = Careereloquent::findOrFail($id);
            $data['contenido'] = 'admin/programaEdit';
            $this->load->view('admin/templateAdmin', $data);
        } else {
            $this->session->set_flashdata('error');
            redirect('/wp-admin');
        }
    }

    public function actualizaPrograma()
    {
        //$this->_validate();
        date_default_timezone_set('America/Lima');
        if ($this->session->userdata('user_rol') == 'admin') {
            $id = $this->input->post('id');
            $data = array(
                'career_title' => $this->input->post('career_title'),
            );

            $model = Careereloquent::findOrFail($id);
            $model->fill($data);
            $model->save($data);
            redirect('/admin/programas', 'refresh');
        } else {
            echo "fallo actualizacion";
        }
    }

    public function nuevoPrograma()
    {
        if ($this->session->userdata('user_rol') == 'admin') {
            $data['contenido'] = 'admin/programaNew';
            $this->load->view('admin/templateAdmin', $data);
        } else {
            $this->session->set_flashdata('error');
            redirect('/wp-admin');
        }
    }

    public function no_repetir_programa($registro)
    {
        $registro = $this->input->post();
        $programa = CareerEloquent::getCareerTitle('career_title', $registro['career_title']);
        if ($programa and (!isset($registro['id']) or ($registro['id'] != $programa->id))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function creaPrograma()
    {
        $this->form_validation->set_rules('career_title', 'Nombre del programa', 'required|callback_no_repetir_programa');
        //si el proceso falla mostramos errores
        if ($this->form_validation->run() == FALSE) {
            $this->nuevoPrograma();
            //en otro caso procesamos los datos
        } else {
            date_default_timezone_set('America/Lima');
            if ($this->session->userdata('user_rol') == 'admin') {
                $data = array(
                    'career_title' => $this->input->post('career_title'),
                );

                $model = new CareerEloquent();
                $model->fill($data);
                $model->save($data);
                redirect('/admin/programas');
            } else {
                $this->nuevoPrograma();
            }
        }
    }

    public function eliminaPrograma()
    {
        if ($this->session->userdata('user_rol') == 'admin') {
            /*CareerEloquent::checkProgramRecords($id_career);*/
            //var_dump($id_career);
            //$this->form_validation->set_rules('id_career', 'Programa', 'required|callback_tiene_registros');
            /*if ($this->form_validation->run() == FALSE) {
                $this->verProgramas();
                //en otro caso procesamos los datos
            } else {*/
            $id_career = $this->input->post('id_career', true);

            if (CareerEloquent::checkProgramRecords($id_career)) {
                $programa = CareerEloquent::find($id_career);
                $programa->delete();
                redirect('/admin/programas', 'refresh');
                //CareerEloquent::where('id', $id_career)->delete();
            } else {
                $this->session->set_flashdata('flashError', 'No se puede eliminar el programa seleccionado porque tiene registros.');
                redirect('/admin/programas', 'refresh');
            }

            //redirect($_SERVER['REQUEST_URI'], 'refresh');*/
        } else {
            $this->session->set_flashdata('error');
            redirect('/wp-admin');
        }
    }

}
