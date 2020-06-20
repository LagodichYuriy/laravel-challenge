<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;

class CityController extends Controller
{
	const ITEMS_PER_PAGE = 25;

	const ALLOWED_RELATIONS = ['region', 'region.country'];

	public function index(Request $request, int $city_id = null)
	{
		$relations = array_intersect(self::ALLOWED_RELATIONS, $request->get('expand', []));

		$cities = City::with($relations);

		if ($city_id !== null)
		{
			return $cities->where(['id' => $city_id])->first();
		}

		return $cities->paginate(self::ITEMS_PER_PAGE);
	}
}