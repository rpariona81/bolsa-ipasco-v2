<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Illuminate\Support\Carbon as Carbon;
use Illuminate\Database\Capsule\Manager as DB;

class CareerEloquent extends My_Model
{

	protected $table = 't_careers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'career_title',
		'career_code',
		'career_alias',
		'career_related',
		'career_notes'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [];

	//protected $with = 'role';

	public function setCreatedAtAttribute($value)
	{
		if (getenv('DB_CONNECTION') == 'mysqli') {
			$this->attributes['created_at'] = (new Carbon($value))->format('Y-m-d H:i:s');
		} elseif (getenv('DB_CONNECTION') == 'sqlsrv') {
			$this->attributes['created_at'] = (new Carbon($value))->format('Ymd H:i:s');
		} else {
			$this->attributes['created_at'] = (new Carbon($value))->format('Y-m-d H:i:s');
		}
	}

	public function setUpdatedAtAttribute($value)
	{
		if (getenv('DB_CONNECTION') == 'mysqli') {
			$this->attributes['updated_at'] = (new Carbon($value))->format('Y-m-d H:i:s');
		} elseif (getenv('DB_CONNECTION') == 'sqlsrv') {
			$this->attributes['updated_at'] = (new Carbon($value))->format('Ymd H:i:s');
		} else {
			$this->attributes['updated_at'] = (new Carbon($value))->format('Y-m-d H:i:s');
		}
	}

	public static function getCareerTitle($column, $value)
	{
		return CareerEloquent::where($column, '=', $value)->first();
	}

	public static function getCantCareers()
	{
		return CareerEloquent::count();
	}

	public static function checkProgramRecords($id_career)
	{
		$cantUsers = DB::table('t_users')
			->where('career_id', $id_career)
			->exists();
		/*->selectRaw('count(id) as cant_users')
            ->pluck('cant_users');*/

		$cantOffers = DB::table('t_offersjob')
			->where('career_id', $id_career)
			->exists();

		//var_dump($cantUsers, $cantOffers);
		/*$registrosUsers = DB::table('t_users')
            ->select(DB::raw('count(*) as users, career_id'))
            ->where('career_id', '=', $id_career)
            ->groupBy('career_id')
            ->get();
            /*->groupBy('career_id');
            var_dump($registrosUsers);*/

		/*$registrosConvocatorias = DB::table('t_offersjob')
            ->select(DB::raw('count(id) as offersjob, career_id'))
            ->where('career_id', '=', $id_career)
            ->groupBy('career_id')
            ->get();
            /*->groupBy('career_id');*/
		/*var_dump($registrosConvocatorias);
        //var_dump($registrosUsers, $registrosConvocatorias);
        */
		if (($cantUsers) || ($cantOffers)) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public static function getCantUsersByCareer()
	{

		$cantUsers = DB::table('t_users')
			->selectRaw('count(id) as cant_Users, career_id')
			->where('role_id', '=', 4)
			->where('status', '=', 1)
			->groupBy('career_id');

		//https://laracasts.com/discuss/channels/eloquent/laravel-scope-leftjoinsub-doesnt-work
		$data = CareerEloquent::leftjoinSub($cantUsers, 'cantUsers', function ($join) {
			$join->on('t_careers.id', '=', 'cantUsers.career_id');
		})
			->orderBy('t_careers.career_title', 'asc')
			->get(['t_careers.career_title', 'cantUsers.cant_Users']);

		return $data;
	}
}
