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

	public function index()
	{
		//if ($this->session->userdata('user_rol') == 'admin') {
		//$data['contenido'] = 'admin/dashboard';
		$data['cantEstudEgres'] = UserEloquent::getCantEstudEgres();
		$data['cantCareers'] = CareerEloquent::getCantCareers();
		$data['cantOffersjobs'] = OfferJobEloquent::getCantOffersjobs();
		$data['cantPostulations'] = PostulateJobEloquent::getCantPostulations();
		$data['cantUsersByCareer'] = CareerEloquent::getCantUsersByCareer();
		$data['offersjobsLast'] = OfferJobEloquent::getOffersjobsLast();

		print_r(json_encode($data));
		//    $this->load->view('admin/templateAdmin', $data);
		//} else {
		//    $this->session->set_flashdata('error');
		//    redirect('/login');
		//}
	}

	public function viewPerfil()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['perfil'] = AdminEloquent::findOrFail($this->session->userdata('user_id'));
			$data['contenido'] = 'admin/adminPerfil';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}
	public function no_repetir_email_admin($registro)
	{
		$registro = $this->input->post();
		$admin = AdminEloquent::where('email', '=', $registro['email'])->first();
		if ($admin and (!isset($registro['id']) or ($registro['id'] != $admin->id))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function no_repetir_user_admin($registro)
	{
		$registro = $this->input->post();
		$admin = AdminEloquent::where('username', '=', $registro['username'])->first();
		if ($admin and (!isset($registro['id']) or ($registro['id'] != $admin->id))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function actualizaPerfil()
	{
		$registro = $this->input->post();
		$this->form_validation->set_rules('email', 'Email', 'valid_email|callback_no_repetir_email_admin');
		$this->form_validation->set_rules('username', 'Usuario', 'required|callback_no_repetir_user_admin');
		if ($this->form_validation->run() == FALSE) {
			$this->viewPerfil();
			//en otro caso procesamos los datos
		} else {
			date_default_timezone_set('America/Lima');
			if ($this->session->userdata('user_rol') == 'admin') {
				$id = $this->input->post('id');
				$data = array(
					'name' => $this->input->post('name', true),
					'paternal_surname' => $this->input->post('paternal_surname', true),
					'maternal_surname' => $this->input->post('maternal_surname', true),
					'username' => $this->input->post('username', true),
					'mobile' => $this->input->post('mobile', true),
					'email' => $this->input->post('email', true)
				);
				$model = AdminEloquent::findOrFail($id);
				$model->fill($data);
				$model->save();
				$this->session->set_flashdata('flashSuccess', 'Actualización exitosa.');
				redirect('/admin/perfil', 'refresh');
			} else {
				$this->session->set_flashdata('flashError', 'Verifique la información ingresada.');
				$this->viewPerfil();
			}
		}
	}


	public function viewClave()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['contenido'] = 'admin/adminCredencial';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}
	public function cambiarClave()
	{
		$registro = $this->input->post();
		$this->form_validation->set_rules('clave_act', 'Clave Actual', 'required');
		$this->form_validation->set_rules('clave_new', 'Clave Nueva', 'required|matches[clave_rep]');
		$this->form_validation->set_rules('clave_rep', 'Repita Nueva', 'required');
		if ($this->form_validation->run() == FALSE) {
			//print_r($registro);
			//$this->session->set_flashdata('flashError', 'Verifique las claves ingresadas.');
			$this->viewClave();
			//en otro caso procesamos los datos
		} else {
			if ($this->session->userdata('user_rol') == 'admin') {
				$id = $this->session->userdata('user_id');
				$actual = $this->input->post('clave_act');
				$nuevo = $this->input->post('clave_new');
				$usuario = AdminEloquent::find($id);
				$password = $usuario['password'];
				if (password_verify($actual, $password)) {
					$newpassword = password_hash($nuevo, PASSWORD_BCRYPT);
					$usuario->password = $newpassword;
					$usuario->save();
					$this->session->set_flashdata('flashSuccess', 'Actualización exitosa.');
					redirect('/admin/claves', 'refresh');
				} else {
					$this->session->set_flashdata('flashError', 'Verifique las claves ingresadas.');
					redirect('/admin/claves', 'refresh');
				}
			} else {
				$this->session->set_flashdata('error');
				redirect('/wp-admin');
			}
		}
	}
	
	/**
	 * CARGA MODELO CV WORD
	 *  */

	public function viewModeloCV()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['contenido'] = 'admin/uploadModeloCV';
			//$data['document'] = FCPATH . 'uploads/document/ModeloEjemplo.docx';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function uploadModeloCV()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$config['upload_path']          = FCPATH . 'uploads/document/';
			$config['allowed_types']        = 'docx';
			$config['max_size']             = 8192;
			$config['file_name']            = round(microtime(true) * 1000);
			$config['remove_spaces']        = TRUE;

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;
			//print_r($_FILES);
			//print_r($this->upload->display_errors());
		}
		/*if (!$this->upload->do_upload('modelocv')) {
                //$error = array('error' => $this->upload->display_errors());
                //print_r($error); die();
                $data['error_string'] = 'Error de carga de archivo: ' . $this->upload->display_errors('', '');
                $data['status'] = 0;
                $this->session->set_flashdata('flashError',$data['error_string']);
                redirect('/admin/vermodelocv','refresh');
                //echo json_encode($data);
                //$this->session->set_flashdata('flashError', 'Error de carga de archivo: ' . $this->upload->display_errors('', ''));
                //redirect($_SERVER['REQUEST_URI'], 'refresh'); 
                //exit();
                //return $data;
                //return redirect()->to($_SERVER['HTTP_REFERER'], 'refresh');
    
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('flashSuccess','Archivo reemplazado con éxito.');
                redirect('/admin/vermodelocv','refresh');
            }
            return $data;
            $data['contenido'] = 'admin/programasTable';
            $this->load->view('admin/templateAdmin', $data);
        } else {
            $this->session->set_flashdata('error');
            redirect('/wp-admin');
        }*/
	}

}
