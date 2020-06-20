<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Street;
use App\Building;

class BuildingsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Building::query()->truncate();


		$faker = Faker\Factory::create();

		for ($i = 0; $i < 300; $i++)
		{
			$street = Street::inRandomOrder()->firstOrFail();

			Building::firstOrCreate
			([
				'street_id' => $street->id,
				'building_number' => $faker->numberBetween(1, 999) * 10
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}