<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Illuminate\Support\Carbon as Carbon;
use Illuminate\Database\Capsule\Manager as DB;

class UserEloquent extends My_Model
{
	protected $table = 't_users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'document_type',
		'document_number',
		'career_id',
		'name',
		'paternal_surname',
		'maternal_surname',
		'gender',
		'birthdate',
		'mobile',
		'graduated',
		'address',
		'role_id',
		'username',
		'email',
		'password',
		'remember_token'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'birthdate' => 'datetime:Y-m-d',
		'status' => 'boolean'
	];

	protected $appends = ['flag'];

	public function getFlagAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->status) {
			return 'Activo';
		} else {
			return 'Suspendido';
		}
	}

	public static function getUserBy($column, $value)
	{
		return UserEloquent::leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
			->leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
			->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
			->select('t_users.id', 't_users.name', 't_users.password', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
			->where($column, '=', $value)->first();
		//return UserEloquent::where($column, '=', $value)->first();
	}

	public static function getUserEstudiantes()
	{
		/*$data = DB::select('SELECT t1.id, t1.name, t1.paternal_surname, t1.maternal_surname, t1.document_type, t4.document_type_label, t1.document_number, t1.address, t1.mobile, t1.gender, t1.email, t1.birthdate, t1.status, t1.role_id, t3.rolename, t1.career_id, t2.career_title, t1.graduated, t1.username, t1.updated_at FROM t_users t1 LEFT JOIN t_careers t2 ON t1.career_id=t2.id LEFT JOIN t_roles t3 ON t1.role_id=t3.id LEFT JOIN t_document_type t4 ON t1.document_type = t4.id WHERE t1.role_id=4 ORDER BY t1.updated_at DESC');
        return $data;*/

		return UserEloquent::leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
			->leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
			->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
			->select('t_users.id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
			->where('t_users.role_id', '=', '4')
			->orderBy('t_users.updated_at', 'desc')
			->get();
	}

	public static function getUserEstudiantesByCareer($career_id = NULL)
	{
		if ($career_id == NULL) {
			return UserEloquent::leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
				->leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
				->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
				->select('t_users.id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
				->where('t_users.role_id', '=', '4')
				->orderBy('t_users.updated_at', 'desc')
				->get();
		} else {
			return UserEloquent::leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
				->leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
				->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
				->select('t_users.id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
				->where('t_users.role_id', '=', '4')
				->where('t_users.career_id', '=', $career_id)
				->orderBy('t_users.updated_at', 'desc')
				->get();
		}
	}

	public static function getUserDocentes()
	{
		/*$data = DB::select('SELECT t1.id, t1.name, t1.paternal_surname, t1.maternal_surname, t1.document_type, t4.document_type_label, t1.document_number, t1.address, t1.mobile, t1.gender, t1.email, t1.birthdate, t1.status, t1.role_id, t3.rolename, t1.career_id, t2.career_title, t1.graduated, t1.username, t1.updated_at FROM t_users t1 LEFT JOIN t_careers t2 ON t1.career_id=t2.id LEFT JOIN t_roles t3 ON t1.role_id=t3.id LEFT JOIN t_document_type t4 ON t1.document_type = t4.id WHERE t1.role_id=3 ORDER BY t1.updated_at DESC');
        return $data;*/

		return UserEloquent::leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
			->leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
			->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
			->select('t_users.id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
			->where('t_users.role_id', '=', '3')
			->orderBy('t_users.updated_at', 'desc')
			->get();
	}

	public static function getUserDocentesByCareer($career_id = NULL)
	{
		if ($career_id == NULL) {
			return UserEloquent::leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
				->leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
				->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
				->select('t_users.id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
				->where('t_users.role_id', '=', '3')
				->orderBy('t_users.updated_at', 'desc')
				->get();
		} else {
			return UserEloquent::leftjoin('t_careers', 't_users.career_id', '=', 't_careers.id')
				->leftjoin('t_roles', 't_users.role_id', '=', 't_roles.id')
				->leftjoin('t_document_type', 't_users.document_type', '=', 't_document_type.id')
				->select('t_users.id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.document_type', 't_document_type.document_type_label', 't_users.document_number', 't_users.address', 't_users.mobile', 't_users.gender', 't_users.email', 't_users.birthdate', 't_users.status', 't_users.role_id', 't_roles.rolename', 't_users.career_id', 't_careers.career_title', 't_users.graduated', 't_users.username', 't_users.updated_at')
				->where('t_users.role_id', '=', '3')
				->where('t_users.career_id', '=', $career_id)
				->orderBy('t_users.updated_at', 'desc')
				->get();
		}
	}

	public static function getListDocumentType()
	{
		$results = DB::table('t_document_type')
			->select('id', 'document_type_label')
			->get();

		$lista = array();
		//$lista[NULL]='Seleccionar';
		foreach ($results as $result) {
			$lista[$result->id] = $result->document_type_label;
		}
		return $lista;
	}

	public static function getListCareers()
	{
		$results = DB::table('t_careers')
			->select('id', 'career_title')
			->get();

		$lista = array();
		$lista[NULL] = 'Seleccionar programa de estudios';
		foreach ($results as $result) {
			$lista[$result->id] = $result->career_title;
		}
		return $lista;
	}

	public static function getGender()
	{
		$lista = array();
		//$lista[NULL]='Seleccionar';
		$lista['Femenino'] = 'Femenino';
		$lista['Masculino'] = 'Masculino';
		return $lista;
	}

	public static function getCondicionEstudEgre()
	{
		$lista = array();
		//$lista['']='Seleccionar';
		$lista['Estudiante'] = 'Estudiante';
		$lista['Egresado'] = 'Egresado';
		return $lista;
	}

	public static function getCondicionDocente()
	{
		$lista = array();
		//$lista['']='Seleccionar';
		$lista['Nombrado'] = 'Nombrado';
		$lista['Contratado'] = 'Contratado';
		return $lista;
	}

	public static function getCantEstudEgres()
	{
		return UserEloquent::where('role_id', 4)->where('status', 1)->count();
	}

	/**
	 * Valida acceso del login
	 *
	 * @param string $user
	 * @param string $pass
	 * @return User|Boolean
	 */
	public static function getLogin($user, $pass)
	{
		$userValidate = UserEloquent::where('username', '=', $user)->first();
		if (is_null($userValidate)) {
			$arrayLogin = array(
				'error' => 'Usuario no registrado.',
				'isLogged' => FALSE,
			);
			return $arrayLogin;
		} else {
			if ($userValidate->status) {
				if (password_verify($pass, $userValidate['password'])) {
					$role_user = RoleUser_Eloquent::where('user_id',  $userValidate['id'])->first();
					//print_r($role_user);
					$role = Role_Eloquent::findOrFail($role_user['role_id']);
					if ($role) {
						if ($role->status) {
							$arrayLogin = array(
								'user_login' => $userValidate['username'],
								'user_nickname' => $userValidate['display_name'],
								'user_email' => $userValidate['email'],
								'user_id' => $userValidate['id'],
								'user_role' => $role['rolename'],
								'user_guard' => $role['guard_name'],
								'user_role_id' => $role['id'],
								'user_level' => $userValidate['user_type'],
								'isLogged' => TRUE,
							);
							//print_r($arrayLogin);
							return $arrayLogin;
						} else {
							$arrayLogin = array(
								'error' => 'Usuario no tiene rol autorizado',
								'isLogged' => FALSE,
							);
							return $arrayLogin;
						}
					} else {
						$arrayLogin = array(
							'error' => 'No tiene rol asignado',
							'isLogged' => FALSE,
						);
						return $arrayLogin;
					}
				} else {
					$arrayLogin = array(
						'error' => 'Error de contraseña',
						'isLogged' => FALSE,
					);
					return $arrayLogin;
				}
			} else {
				$arrayLogin = array(
					'error' => 'Usuario no autorizado.',
					'isLogged' => FALSE,
				);
				return $arrayLogin;
			}
			return;
		}
	}
}
