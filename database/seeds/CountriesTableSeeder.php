<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Country;

class CountriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Country::query()->truncate();

		Country::create
		([
			'id'        => Country::ID_CANADA, # ISO 3166-1
			'name'      => 'Canada',           #
			'code'      => 'CA',               # ISO 3166-2
			'code_long' => 'CAN'               # ISO 3166-3
		]);

		Schema::enableForeignKeyConstraints();
	}
}