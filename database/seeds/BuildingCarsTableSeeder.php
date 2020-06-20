<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Car;
use App\Building;
use App\BuildingCar;

class BuildingCarsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		BuildingCar::query()->truncate();


		$car_ids      = [];
		$building_ids = [];

		for ($i = 0; $i < 200; $i++)
		{
			$building = Building::inRandomOrder()->firstOrFail();
			$car = Car::inRandomOrder()->firstOrFail();

			if (isset($car_ids     [$car->id]))      { continue; }
			if (isset($building_ids[$building->id])) { continue; }

			BuildingCar::firstOrCreate
			([
				'building_id' => $building->id,
				'car_id' => $car->id
			]);

			$car_ids     [$car->id]      = true;
			$building_ids[$building->id] = true;
		}

		Schema::enableForeignKeyConstraints();
	}
}
