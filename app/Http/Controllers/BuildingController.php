<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Building;

class BuildingController extends Controller
{
	const ITEMS_PER_PAGE = 100;

	const ALLOWED_RELATIONS = ['street', 'street.city', 'street.city.region', 'steet.city.region.country'];

	public function index(Request $request, int $building_id = null)
	{
		$relations = array_intersect(self::ALLOWED_RELATIONS, $request->get('expand', []));

		$buildings = Building::with($relations);

		if ($building_id !== null)
		{
			return $buildings->where(['id' => $building_id])->first();
		}

		return $buildings->paginate(self::ITEMS_PER_PAGE);
	}
}