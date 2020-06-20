<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call
		([
			CountriesTableSeeder::class,
			RegionsTableSeeder::class,
			CitiesTableSeeder::class,
			StreetsTableSeeder::class,
			BuildingsTableSeeder::class,

			CarBrandsTableSeeder::class,
			ColorsTableSeeder::class,
			CarsTableSeeder::class,

			CitizensTableSeeder::class,
			BuildingCarsTableSeeder::class,
			BuildingTenantsTableSeeder::class
		]);
	}
}
