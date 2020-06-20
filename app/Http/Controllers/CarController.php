<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Car;

class CarController extends Controller
{
	const ITEMS_PER_PAGE = 30;

	const ALLOWED_RELATIONS =
	[
		'color',
		'brand',
		'buildingCar.building',
		'buildingCar.building.tenants',
		'buildingCar.building.tenants.citizen',
		'buildingCar.building.street',
		'buildingCar.building.street.city'
	];

	public function index(Request $request, int $car_id = null)
	{
		$relations = array_intersect(self::ALLOWED_RELATIONS, $request->get('expand', []));

		$cars = Car::with($relations);


		if ($request->exists('plate_number'))
		{
			$cars->where('plate_number', $request->get('plate_number'));
		}


		if ($request->exists('street_id'))
		{
			$cars->whereHas('buildingCar.building', function ($query) use ($request)
			{
				return $query->where(['street_id' => $request->get('street_id')]);
			});
		}

		if ($request->exists('street'))
		{
			$cars->whereHas('buildingCar.building.street', function ($query) use ($request)
			{
				return $query->where('name', $request->get('street'));
			});
		}

		if ($request->exists('street_like'))
		{
			$cars->whereHas('buildingCar.building.street', function ($query) use ($request)
			{
				$query->where('name', 'like', '%' . $request->get('street_like') . '%');
			});
		}

		if ($car_id !== null)
		{
			return $cars->where(['id' => $car_id])->first();
		}

		return $cars->paginate(self::ITEMS_PER_PAGE);
	}
}