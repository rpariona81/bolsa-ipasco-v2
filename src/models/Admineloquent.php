<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Illuminate\Support\Carbon as Carbon;
use Illuminate\Database\Capsule\Manager as DB;

class AdminEloquent extends My_Model
{
	protected $table = 't_admin';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'paternal_surname', 'maternal_surname', 'mobile',
		'username', 'email', 'password'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	protected $casts = [
		'birthdate' => 'datetime:Y-m-d',
		'status' => 'boolean'
	];

	public static function getAdminBy($column, $value)
	{
		return AdminEloquent::where($column, '=', $value)->first();
	}
}
