<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Citizen;

class CitizensTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Citizen::query()->truncate();


		$faker = \Faker\Factory::create();

		for ($i = 0; $i < 500; $i++)
		{
			Citizen::create
			([
				'name' => $faker->name,
				'date_of_birth' => $faker->date()
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}
