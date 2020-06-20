<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Street;
use App\City;

class StreetsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Street::query()->truncate();


		$faker = Faker\Factory::create();

		$city = City::inRandomOrder()->firstOrFail();

		for ($i = 0; $i < 75; $i++)
		{
			Street::create
			([
				'city_id' => $city->id,
				'name' => $faker->streetName
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}