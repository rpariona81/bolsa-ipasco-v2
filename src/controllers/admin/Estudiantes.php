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

	/**
	 * CONTROL DE ESTUDIANTES Y EGRESADOS
	 *  */
	public function verEstudiantes()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$career_id = $this->input->post('career_id', true);
			$data['selectValue'] = isset($career_id) ? $career_id : null;
			$data['career'] = Usereloquent::getListCareers();
			$data['query'] = UserEloquent::getUserEstudiantesByCareer($career_id);
			//$data['query'] = UserEloquent::getUserEstudiantes();
			$data['contenido'] = 'admin/estudianteTable';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function nuevoEstudiante()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['contenido'] = 'admin/estudianteNew';
			$data['document_type'] = Usereloquent::getListDocumentType();
			$data['career'] = Usereloquent::getListCareers();
			$data['gender'] = Usereloquent::getGender();
			$data['condEstud'] = Usereloquent::getCondicionEstudEgre();
			$fechaactual = date('Y-m-d'); // 2016-12-29
			$nuevafecha = strtotime('-16 year', strtotime($fechaactual)); //Se resta un año menos
			$data['fechamax'] = date('Y-m-d', $nuevafecha);
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function no_repetir_username($registro)
	{
		$registro = $this->input->post();
		$usuario = UserEloquent::getUserBy('username', $registro['username']);
		if ($usuario and (!isset($registro['id']) or ($registro['id'] != $usuario->id))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function no_repetir_email($registro)
	{
		$registro = $this->input->post();
		$usuario = UserEloquent::getUserBy('email', $registro['email']);
		if ($usuario and (!isset($registro['id']) or ($registro['id'] != $usuario->id))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * En caso se defina el campo mobile como único, validaremos si ya se registró anteriormente
	 */
	public function no_repetir_mobile($registro)
	{
		$registro = $this->input->post();
		$usuario = UserEloquent::getUserBy('mobile', $registro['mobile']);
		if ($usuario and (!isset($registro['id']) or ($registro['id'] != $usuario->id))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}


	public function no_repetir_document($registro)
	{
		$registro = $this->input->post();
		$usuario = UserEloquent::getUserBy('document_number', $registro['document_number']);
		if ($usuario and (!isset($registro['id']) or ($registro['id'] != $usuario->id))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function enviaPassword()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id', true);
			$user = UserEloquent::find($id);
			/* Load PHPMailer library */
			$this->load->library('phpmailer_lib');
			/* PHPMailer object */
			$mail = $this->phpmailer_lib->load();                          // Passing `true` enables exceptions
			try {
				//Server settings
				$mail->CharSet = 'UTF-8';
				//$mail->SMTPDebug = 0;                                 // 2=Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = getenv('MAIL_HOST');             // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = getenv('MAIL_USERNAME');        // SMTP username
				$mail->Password = getenv('MAIL_PASSWORD');          // SMTP password
				$mail->SMTPSecure = getenv('MAIL_ENCRYPTION');     // Enable TLS 
				$mail->Port = getenv('MAIL_PORT');            // TCP port to connect to
				//$mail->SMTPDebug = 2;

				//reply to before setfrom: https://stackoverflow.com/questions/10396264/phpmailer-reply-using-only-reply-to-address
				$mail->setFrom(getenv('MAIL_USERNAME'), getenv('APP_NAME'));
				$mail->addAddress($user['email']);     // Add a recipient

				//Content
				$mail->isHTML(true);               // Set email format to HTML
				$mail->Subject = "Recuperación de contraseña";
				$datosPostulante = "Estimado " . $user['name'] . " " . $user['paternal_surname'] . ", a su solicitud;<br>";
				$msjUsuario = "Se remite su contraseña para acceder a la bolsa laboral es: <strong>" . base64_decode($user->remember_token) . "</strong><br>";
				$mail->Body    = $datosPostulante . "<br><p>" . $msjUsuario . "</p>";
				$mail->AltBody = strip_tags($msjUsuario);
				$mail->send();
				//$status_sendemail = TRUE;
				$this->session->set_flashdata('flashSuccess', 'Correo enviado correctamente.');
			} catch (Exception $e) {
				log_message('error', "MAIL ERROR: " . $mail->ErrorInfo);
				//$status_sendemail = FALSE;
				$this->session->set_flashdata('flashError', 'Error de envio de correo.');
			}
			redirect('/admin/estudiantes', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function creaEstudiante()
	{
		//$this->_validate();
		/*$usuario = UserEloquent::getUserBy('username', $this->input->post('username'));
        //$query = $this->ci->db->get('usuarios');
        if ($usuario) {
            //redirect('/admin/newestudiante');
            //return FALSE;
            $this->nuevoEstudiante();
        } else {
            $usuario = UserEloquent::getUserBy('email', $this->input->post('email'));
            if ($usuario) {
                //return FALSE;
                $this->nuevoEstudiante();
                //redirect('/admin/newestudiante');
            } else {*/
		$this->form_validation->set_rules('name', 'Nombres', 'required');
		$this->form_validation->set_rules('username', 'Usuario', 'required|callback_no_repetir_username');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|callback_no_repetir_email');
		$this->form_validation->set_rules('document_number', 'Nro documento', 'required|callback_no_repetir_document');
		$this->form_validation->set_rules('mobile', 'teléfono celular', 'required|callback_no_repetir_mobile');
		//si el proceso falla mostramos errores
		if ($this->form_validation->run() == FALSE) {
			$this->nuevoEstudiante();
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
					'role_id' => '4'
				);
				$model = new UserEloquent();
				$model->fill($data);
				$model->save();
				//print_r($model);
				redirect('/admin/estudiantes');
			} else {
				//redirect('/admin/newestudiante');
				$this->nuevoEstudiante();
			}
			//}
		}
	}

	public function editaEstudiante($id = NULL)
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$data['usuario'] = UserEloquent::findOrFail($id);
			$data['document_type'] = Usereloquent::getListDocumentType();
			$data['career'] = Usereloquent::getListCareers();
			$data['gender'] = Usereloquent::getGender();
			$data['condEstud'] = Usereloquent::getCondicionEstudEgre();
			$fechaactual = date('Y-m-d'); // 2016-12-29
			$nuevafecha = strtotime('-16 year', strtotime($fechaactual)); //Se resta un año menos
			$data['fechamax'] = date('Y-m-d', $nuevafecha);
			$data['contenido'] = 'admin/estudianteEdit';
			$this->load->view('admin/templateAdmin', $data);
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function actualizaEstudiante()
	{
		$registro = $this->input->post();
		$this->form_validation->set_rules('name', 'Nombres', 'required');
		$this->form_validation->set_rules('username', 'Usuario', 'required|callback_no_repetir_username');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|callback_no_repetir_email');
		$this->form_validation->set_rules('document_number', 'Nro documento', 'required|callback_no_repetir_document');
		$this->form_validation->set_rules('mobile', 'teléfono celular', 'required|callback_no_repetir_mobile');
		//si el proceso falla mostramos errores
		if ($this->form_validation->run() == FALSE) {
			$this->editaEstudiante($registro['id']);
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
				redirect('/admin/estudiantes', 'refresh');
			} else {
				$this->editaEstudiante($registro['id']);
			}
		}
	}

	public function desactivaEstudiante()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id', true);
			$model = UserEloquent::find($id);
			$model->status = 0;
			$model->save();
			redirect('/admin/estudiantes', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}

	public function activaEstudiante()
	{
		if ($this->session->userdata('user_rol') == 'admin') {
			$id = $this->input->post('id', true);
			$model = UserEloquent::find($id);
			$model->status = 1;
			$model->save();
			redirect('/admin/estudiantes', 'refresh');
		} else {
			$this->session->set_flashdata('error');
			redirect('/wp-admin');
		}
	}
}
