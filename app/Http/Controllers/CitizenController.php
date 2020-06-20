<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use App\Citizen;

class CitizenController extends Controller
{
	const ITEMS_PER_PAGE = 100;

	const ALLOWED_RELATIONS =
	[
		'buildingTenant',
		'buildingTenant.building',
		'buildingTenant.building.street',
		'buildingTenant.building.street.city',
		'buildingTenant.building.street.city.region',
		'buildingTenant.building.street.city.region.country'
	];

	public function index(Request $request, int $citizen_id = null)
	{
		$relations = array_intersect(self::ALLOWED_RELATIONS, $request->get('expand', []));

		$citizens = Citizen::with($relations);

		if ($request->exists('name'))
		{
			$citizens->where('name', $request->get('name'));
		}

		if ($request->exists('name_like'))
		{
			$citizens->where('name', 'like', '%' . $request->get('name_like') . '%');
		}

		if ($request->exists('street_id'))
		{
			$citizens->whereHas('buildingTenant.building.street', function ($query) use ($request)
			{
				$query->where('id', $request->get('street_id'));
			});
		}

		if ($request->exists('street'))
		{
			$citizens->whereHas('buildingTenant.building.street', function ($query) use ($request)
			{
				$query->where('name', $request->get('street'));
			});
		}

		if ($request->exists('street_like'))
		{
			$citizens->whereHas('buildingTenant.building.street', function ($query) use ($request)
			{
				$query->where('name', 'like', '%' . $request->get('street_like') . '%');
			});
		}

		if ($request->exists('city_id'))
		{
			$citizens->whereHas('buildingTenant.building.street', function ($query) use ($request)
			{
				return $query->where('id', $request->get('city_id'));
			});
		}

		if ($request->exists('city'))
		{
			$citizens->whereHas('buildingTenant.building.street.city', function ($query) use ($request)
			{
				return $query->where('name', $request->get('city'));
			});
		}

		if ($request->exists('city_like'))
		{
			$citizens->whereHas('buildingTenant.building.street.city', function ($query) use ($request)
			{
				$query->where('name', 'like', '%' . $request->get('city_like') . '%');
			});
		}


		$subquery = DB::table('citizens')
			->select
			([
				'building_tenants.citizen_id',
				DB::raw('CONCAT(streets.name, " ", buildings.building_number, ", ", cities.name, ", ", regions.name, ", ", countries.name) AS address')
			])
			->from('building_tenants')
			->leftJoin('buildings',        'buildings.id',                '=', 'building_tenants.building_id')
			->leftJoin('streets',          'streets.id',                  '=', 'buildings.street_id')
			->leftJoin('cities',           'cities.id',                   '=', 'streets.city_id')
			->leftJoin('regions',          'regions.id',                  '=', 'cities.region_id')
			->leftJoin('countries',        'countries.id',                '=', 'regions.country_id')

			->groupBy(['citizen_id', 'address']);

		$citizens->joinSub($subquery, 'info', 'info.citizen_id', 'citizens.id');


		if ($citizen_id !== null)
		{
			return $citizens->where(['citizens.id' => $citizen_id])->first();
		}

		return $citizens->paginate(self::ITEMS_PER_PAGE);
	}
}