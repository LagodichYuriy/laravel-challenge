<?php

namespace App\Http\Controllers;

use App\Country;

class CountryController extends Controller
{
	const ITEMS_PER_PAGE = 100;

	public function index(int $country_id = null)
	{
		if ($country_id !== null)
		{
			return Country::where(['id' => $country_id])->first();
		}

		return Country::paginate(self::ITEMS_PER_PAGE);
	}
}