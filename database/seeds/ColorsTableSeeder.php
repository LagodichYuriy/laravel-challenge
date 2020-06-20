<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Color;

class ColorsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Color::query()->truncate();


		$faker = Faker\Factory::create();

		for ($i = 0; $i < 20; $i++)
		{
			Color::firstOrCreate
			([
				'name' => $faker->colorName
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}