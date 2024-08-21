<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Illuminate\Support\Carbon as Carbon;
use Illuminate\Database\Capsule\Manager as DB;

class PostulateJobEloquent extends My_Model
{

	protected $table = 't_postulatejob';
	//protected $dateFormat = 'Ymd H:i:s';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'user_id',
		'offer_id',
		'route_filecv',
		'msg_postulant',
		'result',
		'email_notification',
		'date_postulation',
		'review',
		'filecv'
	];

	protected $dates = ['date_postulation', 'created_at', 'updated_at'];

	protected $casts = [
		'date_postulation' => 'datetime:Y-m-d',
		'date_publish' => 'datetime:Y-m-d',
		'date_vigency' => 'datetime:Y-m-d',
		'status' => 'boolean'
	];

	protected $appends = ['flag'];

	public function getFlagAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->status) {
			return 'Activa';
		} else {
			return 'No activa';
		}
	}

	public static function getPostulationsOfferjob($offer_id = NULL)
	{
		$data['convocados'] = PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
			->leftjoin('t_users', 't_postulatejob.user_id', '=', 't_users.id')
			->leftjoin('t_careers', 't_offersjob.career_id', '=', 't_careers.id')
			->select('t_postulatejob.id', 't_postulatejob.user_id', 't_postulatejob.offer_id', 't_postulatejob.result', 't_postulatejob.date_postulation', 't_postulatejob.filecv', 't_postulatejob.status', 't_offersjob.title', 't_offersjob.type_offer', 't_offersjob.date_publish', 't_offersjob.date_vigency', 't_offersjob.salary', 't_offersjob.vacancy_numbers', 't_careers.career_title', 't_offersjob.career_id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.email', 't_users.graduated', 't_users.mobile', 't_postulatejob.updated_at')
			->where('t_postulatejob.offer_id', '=', $offer_id)
			->orderBy('t_postulatejob.updated_at', 'desc')
			->get();

		$data['convocatoria'] = PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
			->leftjoin('t_careers', 't_offersjob.career_id', '=', 't_careers.id')
			->select('t_offersjob.id', 't_offersjob.employer', 't_offersjob.title', 't_offersjob.detail', 't_offersjob.type_offer', 't_offersjob.vacancy_numbers', 't_offersjob.date_publish', 't_offersjob.salary', 't_offersjob.date_vigency', 't_offersjob.status', 't_offersjob.career_id', 't_offersjob.email_employer', 't_offersjob.turn_horary', 't_careers.career_title')
			->where('t_offersjob.id', '=', $offer_id)
			->first();

		return $data;
	}

	public static function getPostulations($user_id)
	{
		//return PostulateJobEloquent::where('user_id', '=',$user_id)->get();
		return PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
			->leftjoin('t_result_postulate', 't_result_postulate.id', '=', 't_postulatejob.result')
			->select('t_postulatejob.*', 't_result_postulate.detail_label', 't_offersjob.title', 't_offersjob.type_offer', 't_offersjob.date_publish', 't_offersjob.date_vigency')
			->where('t_postulatejob.user_id', '=', $user_id)
			->orderBy('t_postulatejob.date_postulation', 'desc')
			->get();
		//->get('t_postulatejob.*', 't_result_postulate.detail_result', 't_offersjob.title', 't_offersjob.type_offer', 't_offersjob.date_publish', 't_offersjob.date_vigency');
	}

	public static function getPostulation($id)
	{
		//return PostulateJobEloquent::where('user_id', '=',$user_id)->get();
		return PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
			->leftjoin('t_users', 't_postulatejob.user_id', '=', 't_users.id')
			->leftjoin('t_careers', 't_offersjob.career_id', '=', 't_careers.id')
			->select('t_postulatejob.id', 't_postulatejob.user_id', 't_postulatejob.offer_id', 't_offersjob.career_id', 't_offersjob.employer', 't_offersjob.email_employer', 't_offersjob.turn_horary', 't_offersjob.ubicacion', 't_postulatejob.msg_postulant', 't_postulatejob.result', 't_postulatejob.date_postulation', 't_postulatejob.review', 't_postulatejob.status', 't_postulatejob.filecv', 't_careers.career_title', 't_offersjob.title', 't_offersjob.salary', 't_offersjob.type_offer', 't_offersjob.detail', 't_offersjob.date_publish', 't_offersjob.date_vigency', 't_offersjob.vacancy_numbers', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.email', 't_users.username', 't_users.mobile', 't_users.document_type', 't_users.document_number', 't_users.graduated')
			->where('t_postulatejob.id', '=', $id)
			->first();
	}

	public static function getCantPostulations()
	{
		return PostulateJobEloquent::where('status', 1)->count();
	}


	public static function getSelectResult()
	{
		$results = DB::table('t_result_postulate')
			->select('id', 'detail_label')
			->get();

		$lista = array();

		foreach ($results as $result) {
			$lista[$result->id] = $result->detail_label;
		}
		return $lista;
	}

	public static function getReportPostulations($career_id = NULL)
	{
		if ($career_id == NULL) {
			return PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
				->leftjoin('t_users', 't_postulatejob.user_id', '=', 't_users.id')
				->leftjoin('t_careers', 't_offersjob.career_id', '=', 't_careers.id')
				->select('t_postulatejob.id', 't_postulatejob.user_id', 't_postulatejob.offer_id', 't_postulatejob.result', 't_postulatejob.date_postulation', 't_postulatejob.filecv', 't_postulatejob.status', 't_offersjob.title', 't_offersjob.type_offer', 't_offersjob.date_publish', 't_offersjob.date_vigency', 't_offersjob.salary', 't_offersjob.vacancy_numbers', 't_careers.career_title', 't_offersjob.career_id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.email', 't_users.graduated', 't_users.mobile', 't_postulatejob.updated_at')
				->orderBy('t_postulatejob.updated_at', 'desc')
				->get();
		} else {
			return PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
				->leftjoin('t_users', 't_postulatejob.user_id', '=', 't_users.id')
				->leftjoin('t_careers', 't_offersjob.career_id', '=', 't_careers.id')
				->select('t_postulatejob.id', 't_postulatejob.user_id', 't_postulatejob.offer_id', 't_postulatejob.result', 't_postulatejob.date_postulation', 't_postulatejob.filecv', 't_postulatejob.status', 't_offersjob.title', 't_offersjob.type_offer', 't_offersjob.date_publish', 't_offersjob.date_vigency', 't_offersjob.salary', 't_offersjob.vacancy_numbers', 't_careers.career_title', 't_offersjob.career_id', 't_users.name', 't_users.paternal_surname', 't_users.maternal_surname', 't_users.email', 't_users.graduated', 't_users.mobile', 't_postulatejob.updated_at')
				->where('t_offersjob.career_id', '=', $career_id)
				->orderBy('t_postulatejob.updated_at', 'desc')
				->get();
		}
	}

	public static function checkPostulationUser($idUser, $idOffer)
	{
		//return PostulateJobEloquent::where('user_id', '=',$user_id)->get();
		$check = PostulateJobEloquent::leftjoin('t_offersjob', 't_postulatejob.offer_id', '=', 't_offersjob.id')
			->leftjoin('t_users', 't_postulatejob.user_id', '=', 't_users.id')
			->select('t_postulatejob.id', 't_postulatejob.user_id', 't_postulatejob.offer_id')
			->where('t_postulatejob.user_id', '=', $idUser)
			->where('t_postulatejob.offer_id', '=', $idOffer)
			->first();

		if ($check) {
			return true;
		} else {
			return false;
		}
	}
}
