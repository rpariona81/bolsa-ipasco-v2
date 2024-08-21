<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use Illuminate\Support\Carbon as Carbon;
use Illuminate\Database\Capsule\Manager as DB;

class OfferJobEloquent extends My_Model
{

	protected $table = 't_offersjob';
	//protected $dateFormat = 'Ymd H:i:s';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'title',
		'type_offer',
		'detail',
		'vacancy_numbers',
		'date_publish',
		'salary',
		'date_vigency',
		'career_id',
		'email_employer',
		'employer',
		'ubicacion',
		'turn_horary'
	];

	protected $dates = ['date_publish', 'date_vigency', 'updated_at'];

	protected $casts = [
		'date_publish' => 'datetime:Y-m-d',
		'date_vigency' => 'datetime:Y-m-d',
		'status' => 'boolean',
		'vacancy_numbers' => 'integer',
		'updated_at' => 'datetime:Y-m-d'
	];

	protected $appends = ['expired', 'flag', 'vigency'];

	public function getExpiredAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		$origin = date_create('now');
		$target = date_create($this->date_vigency);
		$interval = date_diff($origin, $target)->format('%R%a');
		if ($interval < 0) {
			return 'No vigente';
		} else {
			return 'Vigente';
		}
	}

	public function getFlagAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->status) {
			return 'Activa';
		} else {
			return 'Inactiva';
		}
	}

	public function getVigencyAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		$origin = date_create('now');
		$target = date_create($this->date_vigency);
		$interval = date_diff($origin, $target)->format('%R%a');
		if ($interval < 0) {
			return 0;
		} else {
			return 1;
		}
	}


	public static function selectOffersjob($id = NULL)
	{
		return OfferJobEloquent::leftjoin('t_careers', 't_offersjob.career_id', '=', 't_careers.id')
			->select('t_offersjob.id', 't_offersjob.employer', 't_offersjob.title', 't_offersjob.detail', 't_offersjob.type_offer', 't_offersjob.vacancy_numbers', 't_offersjob.date_publish', 't_offersjob.salary', 't_offersjob.date_vigency', 't_offersjob.status', 't_offersjob.career_id', 't_offersjob.email_employer', 't_offersjob.turn_horary', 't_careers.career_title')
			->where('t_offersjob.id', $id)
			->first();
	}

	public static function getCantOffersjobs()
	{
		return OfferJobEloquent::where('status', 1)->whereDate('t_offersjob.date_vigency', '>=', Carbon::now())->count();
	}

	public static function getOffersjobs()
	{
		/*$recuentoPostulantes = DB::table('t_postulatejob')
                ->select('offer_id as offer_id_job', DB::raw('COUNT(id) as cant_postulantes'))
                        ->where('status', true)
                                ->groupBy('offer_id');
        
        return OfferJobEloquent::leftjoin('t_careers', 't_offersjob.career_id','=','t_careers.id')
            ->select('t_offersjob.id','t_offersjob.title','t_offersjob.type_offer','t_offersjob.vacancy_numbers','t_offersjob.date_publish','t_offersjob.date_vigency','t_offersjob.status','t_offersjob.career_id','t_careers.career_title')
            ->leftjoinSub($recuentoPostulantes, 'recuentoPostulantes', function ($join) {
                $join->on('t_offersjob.id', '=', 'recuentoPostulantes.offer_id_job');
            })
            ->orderBy('t_offersjob.date_publish','desc')
            ->get();
            //->get();*/

		/*$data = DB::select('SELECT t1.id,t1.title,t1.type_offer,t1.vacancy_numbers,t1.salary,t1.detail,t1.date_publish,t1.date_vigency,t1.status,t1.career_id,t2.career_title,t3.cant_postulantes,t1.updated_at FROM t_offersjob t1 LEFT JOIN t_careers t2 ON t1.career_id = t2.id LEFT JOIN (select offer_id, count(id) as cant_postulantes from t_postulatejob GROUP BY offer_id) t3 ON t3.offer_id = t1.id order By t1.updated_at DESC');
        return $data;*/

		$cantPostulates = DB::table('t_postulatejob')
			->selectRaw('count(id) as cant_postulantes, offer_id')
			->groupBy('offer_id');

		$data = OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')
			->leftjoinSub($cantPostulates, 'cantPostulates', function ($join) {
				$join->on('t_offersjob.id', '=', 'cantPostulates.offer_id');
			})
			->orderBy('t_offersjob.updated_at', 'desc')
			->get(['t_offersjob.*', 't_careers.career_title', 'cantPostulates.cant_postulantes']);

		return $data;
	}

	public static function getOffersjobsByCareer($carrera_id = NULL)
	{

		$cantPostulates = DB::table('t_postulatejob')
			->selectRaw('count(id) as cant_postulantes, offer_id')
			->groupBy('offer_id');

		if ($carrera_id != NULL) {
			$data = OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')
				->leftjoinSub($cantPostulates, 'cantPostulates', function ($join) {
					$join->on('t_offersjob.id', '=', 'cantPostulates.offer_id');
				})
				->where('t_offersjob.career_id', '=', $carrera_id)
				->orderBy('t_offersjob.updated_at', 'desc')
				->get(['t_offersjob.*', 't_careers.career_title', 'cantPostulates.cant_postulantes']);
		} else {
			$data = OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')
				->leftjoinSub($cantPostulates, 'cantPostulates', function ($join) {
					$join->on('t_offersjob.id', '=', 'cantPostulates.offer_id');
				})
				->orderBy('t_offersjob.updated_at', 'desc')
				->get(['t_offersjob.*', 't_careers.career_title', 'cantPostulates.cant_postulantes']);
		}

		return $data;
	}

	public static function getOffersjobsLast()
	{

		return OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')->where('t_offersjob.status', '=', 1)->whereDate('t_offersjob.date_vigency', '>=', Carbon::now())->take(3)->orderBy('t_offersjob.date_vigency', 'desc')->get(['t_offersjob.*', 't_careers.career_title']);
	}

	public static function getTotOffersjobsByVigency($user_carrera_id = NULL)
	{
		if ($user_carrera_id != NULL) {
			$convocatorias = OfferJobEloquent::where('t_offersjob.career_id', '=', $user_carrera_id)->where('t_offersjob.status', '=', 1)->get();
		} else {
			$convocatorias = OfferJobEloquent::where('t_offersjob.status', '=', 1)->get();
		}
		$contVigentes = 0;
		$contNoVigentes = 0;
		foreach ($convocatorias as $key) {
			if ($key->vigency == 1) {
				$contVigentes++;
			} else {
				$contNoVigentes++;
			}
		}
		$data['contVigentes'] = $contVigentes;
		$data['contNoVigentes'] = $contNoVigentes;

		return $data;
	}

	public static function getOffersjobsVigentes($user_carrera_id = NULL)
	{
		//return OfferJobEloquent::where('t_offersjob.career_id','=', $user_carrera_id)->where('t_offersjob.status','=',1)->whereDate('t_offersjob.date_vigency','>=',Carbon::now())->get();
		if ($user_carrera_id != NULL) {
			return OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')->where('t_offersjob.career_id', '=', $user_carrera_id)->where('t_offersjob.status', '=', 1)->whereDate('t_offersjob.date_vigency', '>=', Carbon::now())->get(['t_offersjob.*', 't_careers.career_title']);
		} else {
			return OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')->where('t_offersjob.status', '=', 1)->whereDate('t_offersjob.date_vigency', '>=', Carbon::now())->get(['t_offersjob.*', 't_careers.career_title']);
		}
	}

	public static function getOffersjobsNoVigentes($user_carrera_id = null)
	{
		//return OfferJobEloquent::where('t_offersjob.career_id','=', $user_carrera_id)->where('t_offersjob.status','=', 1)->whereDate('t_offersjob.date_vigency','<',Carbon::now())->get();
		if ($user_carrera_id != NULL) {
			return OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')->where('t_offersjob.career_id', '=', $user_carrera_id)->where('t_offersjob.status', '=', 1)->whereDate('t_offersjob.date_vigency', '<', Carbon::now())->get(['t_offersjob.*', 't_careers.career_title']);
		} else {
			return OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')->where('t_offersjob.status', '=', 1)->whereDate('t_offersjob.date_vigency', '<', Carbon::now())->get(['t_offersjob.*', 't_careers.career_title']);
		}
	}

	public static function getOffersjobsByPerfil($user_carrera_id)
	{
		$cantPostulates = DB::table('t_postulatejob')
			->selectRaw('count(id) as cant_postulantes, offer_id')
			->groupBy('offer_id');

		$data = OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')
			->leftjoinSub($cantPostulates, 'cantPostulates', function ($join) {
				$join->on('t_offersjob.id', '=', 'cantPostulates.offer_id');
			})
			->where('t_offersjob.career_id', $user_carrera_id)
			->where('t_offersjob.status', 1)
			->orderBy('t_offersjob.date_vigency', 'desc')
			->get(['t_offersjob.*', 't_careers.career_title', 'cantPostulates.cant_postulantes']);

		return $data;
	}



	/*public static function getOffersjobsNoVigentes($user_carrera_id)
    {
        $cantPostulates = DB::table('t_postulatejob')
            ->selectRaw('count(id) as cant_postulantes, offer_id')
            ->groupBy('offer_id');

        $data = OfferJobEloquent::leftjoin('t_careers', 't_careers.id', '=', 't_offersjob.career_id')
            ->leftjoinSub($cantPostulates, 'cantPostulates', function ($join) {
                $join->on('t_offersjob.id', '=', 'cantPostulates.offer_id');
            })
            ->where('t_offersjob.career_id', $user_carrera_id)
            ->where('t_offersjob.status', 1)
            ->orderBy('t_offersjob.date_vigency', 'desc')
            ->get(['t_offersjob.*', 't_careers.career_title', 'cantPostulates.cant_postulantes']);

        return $data;
    }*/
}
