<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\BuildingTenant;
use App\Building;
use App\Citizen;

class BuildingTenantsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		BuildingTenant::query()->truncate();


		$citizen_ids = [];

		for ($i = 0; $i < 600; $i++)
		{
			$building = Building::inRandomOrder()->firstOrFail();
			$citizen = Citizen::inRandomOrder()->firstOrFail();

			if (isset($citizen_ids[$citizen->id]))
			{
				continue;
			}

			BuildingTenant::firstOrCreate
			([
				'building_id' => $building->id,
				'citizen_id' => $citizen->id
			]);

			$citizen_ids[$citizen->id] = true;
		}

		Schema::enableForeignKeyConstraints();
	}
}