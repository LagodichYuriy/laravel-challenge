<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Street;

class StreetController extends Controller
{
	const ITEMS_PER_PAGE = 50;

	const ALLOWED_RELATIONS = ['city', 'city.region', 'city.region.country'];

	public function index(Request $request, int $street_id = null)
	{
		$relations = array_intersect(self::ALLOWED_RELATIONS, $request->get('expand', []));

		$streets = Street::with($relations);

		if ($street_id !== null)
		{
			return $streets->where(['id' => $street_id])->first();
		}

		return $streets->paginate(self::ITEMS_PER_PAGE);
	}
}