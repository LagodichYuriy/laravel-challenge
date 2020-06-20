<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Region;

class RegionController extends Controller
{
	const ITEMS_PER_PAGE = 15;

	const ALLOWED_RELATIONS = ['country'];

	public function index(Request $request, int $region_id = null)
	{
		$relations = array_intersect(self::ALLOWED_RELATIONS, $request->get('expand', []));

		$regions = Region::with($relations);

		if ($region_id !== null)
		{
			return $regions->where(['id' => $region_id])->first();
		}

		return $regions->paginate(self::ITEMS_PER_PAGE);
	}
}