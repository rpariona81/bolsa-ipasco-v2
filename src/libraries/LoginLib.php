<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class LoginLib
{

    private $ci;
    protected $isLogged;

    public function __construct()
    {
        $this->ci = & get_instance(); // Esto para acceder a la instancia que carga la librería
        //$this->ci->load->model('Usereloquent');
        //$this->ci->load->model('Roleeloquent');
        //$this->isLogged = FALSE;
    }

    public function getLoginUser($user, $pass)
    {
        $this->ci->load->model('Usereloquent');
        $user = UserEloquent::getUserBy('username', $user);
        if($user->status){
            if(password_verify($pass, $user['password'])){
                //$this->isLogged = TRUE;
                $this->ci->load->model('Roleeloquent');
                $rol = RoleEloquent::findOrFail($user['role_id']);
                if($rol){
                    $arrayUser = array(
                        'user_login' => $user['username'],
                        'user_name' => $user['name'],
                        'user_paterno' => $user['paternal_surname'],
                        'user_carrera_id' => $user['career_id'],
                        'user_carrera' => $user['career_title'],
                        'user_email' => $user['email'],
                        'user_id' => $user['id'],
                        'user_rol' => $user['rolename'],
                        'user_condicion' => $user['graduated'],
                        'user_rol_id' => $user['role_id'],
                        'user_rol_title' => $rol['slug']
                    );
                    $this->ci->session->set_userdata( $arrayUser );
                    $this->isLogged = TRUE;
                    $this->ci->session->set_userdata( 'isLogged', $this->isLogged);
                }else{
                    $this->ci->session->set_flashdata('Error de usuario y/o contraseña.');
                    $this->isLogged = FALSE;
                }
            }
        }else{
            $this->ci->session->set_flashdata('Este usuario no existe o está desactivado.');
            $this->isLogged = FALSE;
        }
        return $this->isLogged;
    }

    public function getLoginAdmin($user, $pass)
    {
        $this->ci->load->model('Admineloquent');
        $user = AdminEloquent::getAdminBy('username', $user);
        if($user){
            if(password_verify($pass, $user['password'])){
                //$this->isLogged = TRUE;
                $this->ci->load->model('Roleeloquent');
                $rol = RoleEloquent::findOrFail($user['role_id']);
                if($rol){
                    $arrayUser = array(
                        'user_login' => $user['username'],
                        'user_name' => $user['name'],
                        'user_id' => $user['id'],
                        'user_rol' => $rol['rolename'],
                        'user_rol_title' => $rol['slug'],
                        'user_rol_id' => $rol['id'],
                        'user_email' => $user['email'],
                    );
                    $this->ci->session->set_userdata( $arrayUser );
                    $this->isLogged = TRUE;
                    $this->ci->session->set_userdata( 'isLogged', $this->isLogged);
                }else{
                    $this->ci->session->set_flashdata('Error de usuario y/o contraseña.');
                    $this->isLogged = FALSE;
                }
            }
        }else{
            $this->isLogged = FALSE;
        }
        return $this->isLogged;
    }

}
