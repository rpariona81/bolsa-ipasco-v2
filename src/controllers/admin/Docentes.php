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
	 * CONTROL DE DOCENTES
	 *  */
	public function verDocentes()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$career_id = $this->input->post('career_id', true);
			$data['selectValue'] = isset($career_id) ? $career_id : null;
			$data['career'] = Usereloquent::getListCareers();
			$data['query'] = UserEloquent::getUserDocentesByCareer($career_id);
			//$data['query'] = UserEloquent::getUserDocentes();
			$data['contenido'] = 'admin/docenteTable';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function nuevoDocente()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['contenido'] = 'admin/docenteNew';
			$data['document_type'] = Usereloquent::getListDocumentType();
			$data['career'] = Usereloquent::getListCareers();
			$data['gender'] = Usereloquent::getGender();
			$data['condDocente'] = Usereloquent::getCondicionDocente();
			$fechaactual = date('Y-m-d'); // 2016-12-29
			$nuevafecha = strtotime('-21 year', strtotime($fechaactual)); //Se resta un año menos
			$data['fechamax'] = date('Y-m-d', $nuevafecha);
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function creaDocente()
	{
		$this->form_validation->set_rules('name', 'Nombres', 'required');
		$this->form_validation->set_rules('username', 'Usuario', 'required|callback_no_repetir_username');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|callback_no_repetir_email');
		$this->form_validation->set_rules('document_number', 'Nro documento', 'required|callback_no_repetir_document');
		$this->form_validation->set_rules('mobile', 'teléfono celular', 'required|callback_no_repetir_mobile');
		//si el proceso falla mostramos errores
		if ($this->form_validation->run() == FALSE) {
			$this->nuevoDocente();
			//en otro caso procesamos los datos
		} else {
			date_default_timezone_set('America/Lima');
			if ($this->session->userdata('user_rol') == 'admin') {
				$data = array(
					'document_type' => $this->input->post('document_type'),
					'document_number' => $this->input->post('document_number'),
					'career_id' => $this->input->post('career_id'),
					'name' => $this->input->post('name'),
					'paternal_surname' => $this->input->post('paternal_surname'),
					'maternal_surname' => $this->input->post('maternal_surname'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('birthdate'),
					'username' => $this->input->post('username'),
					'mobile' => $this->input->post('mobile'),
					'email' => $this->input->post('email'),
					'graduated' => $this->input->post('graduated'),
					'address' => $this->input->post('address'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'remember_token' => base64_encode($this->input->post('password')),
					'role_id' => '3'
				);

				$model = new UserEloquent();
				$model->fill($data);
				$model->save($data);
				redirect('/admin/docentes');
			} else {
				$this->nuevoDocente();
			}
		}
	}

	public function editaDocente($id)
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['usuario'] = UserEloquent::findOrFail($id);
			$data['document_type'] = Usereloquent::getListDocumentType();
			$data['career'] = Usereloquent::getListCareers();
			$data['gender'] = Usereloquent::getGender();
			$data['condDocente'] = Usereloquent::getCondicionDocente();
			$fechaactual = date('Y-m-d'); // 2016-12-29
			$nuevafecha = strtotime('-21 year', strtotime($fechaactual)); //Se resta un año menos
			$data['fechamax'] = date('Y-m-d', $nuevafecha);
			$data['contenido'] = 'admin/docenteEdit';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function actualizaDocente()
	{
		$registro = $this->input->post();
		$this->form_validation->set_rules('name', 'Nombres', 'required');
		$this->form_validation->set_rules('username', 'Usuario', 'required|callback_no_repetir_username');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|callback_no_repetir_email');
		$this->form_validation->set_rules('document_number', 'Nro documento', 'required|callback_no_repetir_document');
		$this->form_validation->set_rules('mobile', 'teléfono celular', 'required|callback_no_repetir_mobile');
		//si el proceso falla mostramos errores
		if ($this->form_validation->run() == FALSE) {
			$this->editaDocente($registro['id']);
			//en otro caso procesamos los datos
		} else {
			date_default_timezone_set('America/Lima');
			if ($this->session->userdata('user_rol') == 'admin') {
				$id = $this->input->post('id');
				$data = array(
					'document_type' => $this->input->post('document_type'),
					'document_number' => $this->input->post('document_number'),
					'career_id' => $this->input->post('career_id'),
					'name' => $this->input->post('name'),
					'paternal_surname' => $this->input->post('paternal_surname'),
					'maternal_surname' => $this->input->post('maternal_surname'),
					'gender' => $this->input->post('gender'),
					'birthdate' => $this->input->post('birthdate'),
					'username' => $this->input->post('username'),
					'mobile' => $this->input->post('mobile'),
					'email' => $this->input->post('email'),
					'graduated' => $this->input->post('graduated'),
					'address' => $this->input->post('address')
				);

				$model = UserEloquent::findOrFail($id);
				if (password_verify($this->input->post('password'), $model->password)) {
					$data['password'] = $model->password;
					$data['remember_token'] = $model->remember_token;
				} else {
					$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
					$data['remember_token'] = base64_encode($this->input->post('password'));
				}
				$model->fill($data);
				$model->save();
				redirect('/admin/docentes', 'refresh');
			} else {
				$this->editaDocente($registro['id']);
			}
		}
	}

	public function desactivaDocente()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id', true);
			$model = UserEloquent::find($id);
			$model->status = FALSE;
			$model->save();
			redirect('/admin/docentes', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function activaDocente()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id', true);
			$model = UserEloquent::find($id);
			$model->status = TRUE;
			$model->save();
			redirect('/admin/docentes', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}
}
