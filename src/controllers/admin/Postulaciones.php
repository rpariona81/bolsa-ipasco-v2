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
	 * CONTROL DE POSTULACIONES
	 *  */

	//public function verPostulaciones($career_id = NULL)
	public function verPostulaciones()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$career_id = $this->input->post('career_id', true);
			$data['selectValue'] = isset($career_id) ? $career_id : null;
			$data['career'] = Usereloquent::getListCareers();
			//($career_id != NULL) ? ($data['selectValue'] = $career_id) : NULL;
			$data['query'] = PostulateJobEloquent::getReportPostulations($career_id);
			//echo json_encode($data['query']);
			$data['contenido'] = 'admin/postulacionTable';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function desactivaPostulacion()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id_postulacion = $this->input->post('id', true);
			//$programa = '/admin/postulaciones/' . $this->input->post('career_id');
			$model = PostulateJobEloquent::findOrFail($id_postulacion);
			$model->status = 0;
			$model->save();
			//print_r($programa);
			redirect('/admin/postulaciones', 'refresh');
			//redirect($programa . '', 'refresh');
			//redirect(site_url(uri_string()),'refresh');
			//redirect($_SERVER['REQUEST_URI'], 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function activaPostulacion()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id_postulacion = $this->input->post('id', true);
			//$programa = '/admin/postulaciones/' . $this->input->post('career_id');
			$model = PostulateJobEloquent::find($id_postulacion);
			$model->status = 1;
			$model->save();
			//print_r($programa);
			redirect('/admin/postulaciones', 'refresh');
			//redirect($programa . '', 'refresh');
			//redirect(site_url(uri_string()),'refresh');
			//redirect($_SERVER['REQUEST_URI'], 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function verPostulacion($id = NULL)
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['postulacion'] = PostulateJobEloquent::getPostulation($id);
			$data['result'] = PostulateJobEloquent::getSelectResult();
			$data['contenido'] = 'admin/postulacionEdit';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function resultPostulacion()
	{
		$registro = $this->input->post();
		$this->form_validation->set_rules('result', 'Resultado', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->verPostulacion($registro['id']);
			//en otro caso procesamos los datos
		} else {
			date_default_timezone_set('America/Lima');
			if ($this->session->userdata('user_rol') == 'admin') {
				$id = $this->input->post('id');
				$url_actual = '/admin/postulacion/' . $id;
				$data = array(
					'result' => $this->input->post('result', true)
				);
				$model = PostulateJobEloquent::findOrFail($id);
				$model->fill($data);
				$model->save();
				$this->session->set_flashdata('flashSuccess', 'Actualización exitosa.');
				redirect($url_actual, 'refresh');
			} else {
				$this->verPostulacion($registro['id']);
			}
		}
	}
}
