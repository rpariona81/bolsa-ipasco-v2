<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends MY_Controller
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
            $this->data['contenido'] = 'admin/dashboard';
            $this->data['cantEstudEgres'] = UserEloquent::getCantEstudEgres();
            $this->data['cantCareers'] = CareerEloquent::getCantCareers();
            $this->data['cantOffersjobs'] = OfferJobEloquent::getCantOffersjobs();
            $this->data['cantPostulations'] = PostulateJobEloquent::getCantPostulations();
            $this->data['cantUsersByCareer'] = CareerEloquent::getCantUsersByCareer();
            $this->data['offersjobsLast'] = OfferJobEloquent::getOffersjobsLast();
            $this->render('admin/templateAdmin', $this->data);
        } else {
            $this->session->set_flashdata('error');
            redirect('/login');
        }
    }

    /**
     * CONTROL DE CONVOCATORIAS
     *  */

    public function verConvocatorias()
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
            redirect('/wp-admin');
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
/* End of file Controllername.php */
