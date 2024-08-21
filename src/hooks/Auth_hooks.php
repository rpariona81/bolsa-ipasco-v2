<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_hooks
{

    private $ci;
    function __construct()
    {
        $this->ci = &get_instance(); // Esto para acceder a la instancia que carga la librería
        $this->ci->load->model('Menu_eloquent');
        $this->ci->load->model('Menurole_eloquent');
        $this->ci->load->model('Role_eloquent');
    }


    public function autentificar()
    {
        //$this->ci = & get_instance();
        /*$guard_name = $this->ci->uri->segment(1);
        $controller = $this->ci->uri->segment(2);
        $action = $this->ci->uri->segment(3);
        $url = $guard_name . "/" . $controller . "/" . $action;
        */

        $guard_name = $this->ci->uri->segment(1);
        $controller = $this->ci->uri->segment(2);
        $action = $this->ci->uri->segment(3);
        if (is_null($guard_name)) {
            $url = "/";
        } elseif (is_null($controller)) {
            $url = $guard_name;
        } elseif (is_null($action)) {
            $url = $guard_name . "/" . $controller;
        } else {
            $url = $guard_name . "/" . $controller . "/" . $action;    # code...
        }

        $libres = array('/', 'home/index', 'login', 'home/login', 'home/acerca_de', 'auth', 'logout','registroatr','home/loadentidades','home/guarda_asistencia');

        //var_dump($url);
        //exit;
		if($this->ci->session->userdata('user_guard'))	array_push($libres,$this->ci->session->userdata('user_guard').'/index');
        if (in_array($url, $libres)) {
            //print_r($url);
            /*if ($this->ci->session->userdata('user_guard') != NULL) {
                redirect(base_url() . $this->ci->session->userdata('user_guard') . '/index');
            } else {*/
                echo $this->ci->output->get_output();
            /*}*/
            return;
        } else {
            if (is_null($this->ci->session->userdata('user_guard'))) {
                redirect('/');
                exit;
            } else {
                if ($this->ci->session->userdata('user_guard') != $guard_name) {
					//dd($this->ci->session->userdata('user_guard'));
                    redirect(base_url() . $this->ci->session->userdata('user_guard') . '/index');
                    exit;
                } else {
                    if ($this->autorizar()) {
                        echo $this->ci->output->get_output();
                    } else {
                        //redirect(base_url() . $this->ci->session->userdata('user_guard') . '/index');
						//redirect()->back();
                        redirect_back();
						exit;
                    }
                    return;
                }
            }
        }
    }
    
    public function autorizar()
    {
        //$this->ci = & get_instance();
        // El perfil del usuario logueado
        $role_id = $this->ci->session->userdata('user_role_id');
        // Con el controlador, buscar la opcion en la tabla de menus
        //$this->ci->load->library('MenuLib');
        $controller = $this->ci->uri->segment(2);
        //$menu_id = $this->ci->menulib->findByController($controller);
        $guard_name = $this->ci->session->userdata('user_guard');
        //var_dump($guard_name);

        //$menu_id = Menu_eloquent::where('controller', '=', $controller)->where('guard_name', '=', $guard_name)->select('id')->get();
        $menu_id = Menu_eloquent::where('controller', '=', $controller)->where('guard_name','=', $guard_name)->get('id')->first();

        if (is_null($menu_id->id)) {
            echo 'menu_id->'.$menu_id;
        //if (isset($menu_id)) {
            return FALSE;
            //exit;
        }

        if (is_null($role_id)) {
        //if (isset($role_id)) {
            return FALSE;
            //exit;
        }
        //$this->ci->session->set_userdata('validaciones',['role_id'=>$role_id,'menu_id'=>$menu_id->id]);
		$this->ci->session->set_userdata('menu_id',$menu_id->id);
		
        /*$data['rol'] = $role_id;
        $data['menu'] = $menu_id;
        print_r($data);*/
        // 
        //$this->ci->load->library('Menu_PerfilLib');
        //$controller = $this->ci->uri->segment(2);
        //$acceso = $this->ci->menu_perfillib->findByMenuAndPerfil($role_id, $menu_id)->id;
        $acceso = Menurole_eloquent::leftjoin('t_roles', 't_roles.id', '=', 't_menu_role.role_id')
            ->where('t_menu_role.menu_id', $menu_id->id)
            ->where('t_menu_role.role_id', $role_id)
            ->where('t_roles.status', '1')
            //->get('t_roles.status')
            ->first();
        //->get(['t_menus.*', 't_roles.guard_name']);
        //$this->ci->session->set_userdata('acceso',$acceso);
        //if (!$acceso) {
        /*if (is_null($acceso->status)) {*/
        if (is_null($acceso)) {
            return FALSE;
        }

        return TRUE;
    }
}
