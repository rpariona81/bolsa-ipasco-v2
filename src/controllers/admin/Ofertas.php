<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ofertas extends CI_Controller
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
		if ($this->session->userdata('user_rol') == 'admin') {
			$career_id = $this->input->post('career_id', true);
			$data['selectValue'] = isset($career_id) ? $career_id : null;
			$data['career'] = Usereloquent::getListCareers();
			$data['query'] = OfferJobEloquent::getOffersjobsByCareer($career_id);
			//$data['query'] = Offerjobeloquent::orderBy('date_publish','desc')->get();
			//$data['query'] = Offerjobeloquent::all();
			//$data['query'] = Offerjobeloquent::getOffersjobs();
			$data['contenido'] = 'admin/convocatoriaTable';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/login');
		}
	}

	public function verConvocados($id)
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['query'] = PostulateJobEloquent::getPostulationsOfferjob($id);
			$data['contenido'] = 'admin/convocatoriaApplicants';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function nuevaConvocatoria()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['contenido'] = 'admin/convocatoriaNew';
			$data['career'] = Usereloquent::getListCareers();
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function creaConvocatoria()
	{
		//$this->_validate();
		date_default_timezone_set('America/Lima');
		if ($this->session->userdata('user_rol') == 'admin') {
			$data = array(
				'title' => $this->input->post('title'),
				'type_offer' => $this->input->post('type_offer', true),
				'career_id' => $this->input->post('career_id', true),
				'detail' => htmlentities($this->input->post('detail', true)),
				'vacancy_numbers' => $this->input->post('vacancy_numbers', true),
				'date_publish' => $this->input->post('date_publish', true),
				'salary' => $this->input->post('salary', true),
				'date_vigency' => $this->input->post('date_vigency', true),
				'employer' => $this->input->post('employer', true),
				'ubicacion' => $this->input->post('ubicacion', true),
				'email_employer' => $this->input->post('email_employer', true),
				'turn_horary' => $this->input->post('turn_horary', true)
			);

			$model = new Offerjobeloquent();
			$model->fill($data);
			$model->save($data);
			redirect('/admin/convocatorias');
		} else {
			redirect('/admin/newconvocatoria');
		}
	}

	public function editaConvocatoria($id)
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['convocatoria'] = Offerjobeloquent::findOrFail($id);
			$data['career'] = Usereloquent::getListCareers();
			$data['contenido'] = 'admin/convocatoriaEdit';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function actualizaConvocatoria()
	{
		//$this->_validate();
		date_default_timezone_set('America/Lima');
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id');
			$data = array(
				'title' => $this->input->post('title'),
				'type_offer' => $this->input->post('type_offer', true),
				'career_id' => $this->input->post('career_id', true),
				'detail' => htmlentities($this->input->post('detail', true)),
				'vacancy_numbers' => $this->input->post('vacancy_numbers', true),
				'date_publish' => $this->input->post('date_publish', true),
				'salary' => $this->input->post('salary', true),
				'date_vigency' => $this->input->post('date_vigency', true),
				'employer' => $this->input->post('employer', true),
				'ubicacion' => $this->input->post('ubicacion', true),
				'email_employer' => $this->input->post('email_employer', true),
				'turn_horary' => $this->input->post('turn_horary', true)
			);

			$model = Offerjobeloquent::findOrFail($id);
			$model->fill($data);
			$model->save($data);
			redirect('/admin/convocatorias', 'refresh');
		} else {
			echo "fallo actualizacion";
		}
	}

	public function desactivaConvocatoria()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id', true);
			$model = Offerjobeloquent::find($id);
			$model->status = 0;
			$model->save();
			redirect('/admin/convocatorias', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function activaConvocatoria()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id');
			$model = Offerjobeloquent::find($id);
			$model->status = 1;
			$model->save();
			redirect('/admin/convocatorias', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}
}
