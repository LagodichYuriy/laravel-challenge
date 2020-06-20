<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\CarBrand;

class CarBrandsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		CarBrand::query()->truncate();

		$brands =
		[
			'Abarth',
			'Alfa Romeo',
			'Aston Martin',
			'Audi',
			'Bentley',
			'BMW',
			'Bugatti',
			'Cadillac',
			'Chevrolet',
			'Chrysler',
			'Citroën',
			'Dacia',
			'Daewoo',
			'Daihatsu',
			'Dodge',
			'Donkervoort',
			'DS',
			'Ferrari',
			'Fiat',
			'Fisker',
			'Ford',
			'Honda',
			'Hummer',
			'Hyundai',
			'Infiniti',
			'Iveco',
			'Jaguar',
			'Jeep',
			'Kia',
			'KTM',
			'Lada',
			'Lamborghini',
			'Lancia',
			'Land Rover',
			'Landwind',
			'Lexus',
			'Lotus',
			'Maserati',
			'Maybach',
			'Mazda',
			'McLaren',
			'Mercedes-Benz',
			'MG',
			'Mini',
			'Mitsubishi',
			'Morgan',
			'Nissan',
			'Opel',
			'Peugeot',
			'Porsche',
			'Renault',
			'Rolls-Royce',
			'Rover',
			'Saab',
			'Seat',
			'Skoda',
			'Smart',
			'SsangYong',
			'Subaru',
			'Suzuki',
			'Tesla',
			'Toyota',
			'Volkswagen',
			'Volvo'
		];

		foreach ($brands as $brand)
		{
			CarBrand::create
			([
				'name' => $brand
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}