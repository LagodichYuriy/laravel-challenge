<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Car;
use App\CarBrand;
use App\Color;

class CarsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Car::query()->truncate();


		$faker = Faker\Factory::create();

		$colors = Color::all();
		$brands = CarBrand::all();

		for ($i = 0; $i < 100; $i++)
		{
			$brand = $faker->randomElement($brands);
			$color = $faker->randomElement($colors);

			Car::firstOrCreate
			([
				'color_id' => $color->id,
				'brand_id' => $brand->id,
				'plate_number' => $faker->regexify('[A-Z]{6}')
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}