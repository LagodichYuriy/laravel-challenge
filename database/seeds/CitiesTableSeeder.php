<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\City;
use App\Region;

class CitiesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		City::query()->truncate();


		$faker = \Faker\Factory::create();

		$region = Region::inRandomOrder()->firstOrFail();

		City::firstOrCreate
		([
			'region_id' => $region->id,
			'name' => $faker->city
		]);

		Schema::enableForeignKeyConstraints();
	}
}