<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Country;
use App\Region;

class RegionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();

		Region::query()->truncate();

		$regions =
		[
			[Country::ID_CANADA, 'Ontario',                   'ON'],
			[Country::ID_CANADA, 'Quebec',                    'QC'],
			[Country::ID_CANADA, 'Nova Scotia',               'NS'],
			[Country::ID_CANADA, 'New Brunswick',             'NB'],
			[Country::ID_CANADA, 'Manitoba',                  'MB'],
			[Country::ID_CANADA, 'British Columbia',          'BC'],
			[Country::ID_CANADA, 'Prince Edward Island',      'PE'],
			[Country::ID_CANADA, 'Saskatchewan',              'SK'],
			[Country::ID_CANADA, 'Alberta',                   'AB'],
			[Country::ID_CANADA, 'Newfoundland and Labrador', 'NL'],
			[Country::ID_CANADA, 'Northwest Territories',     'NT'],
			[Country::ID_CANADA, 'Nunavut',                   'NU'],
			[Country::ID_CANADA, 'Yukon Territory',           'YT']
		];

		foreach ($regions as list($country_id, $region_name, $region_code))
		{
			Region::create
			([
				'country_id' => $country_id,
				'name' => $region_name,
				'code' => $region_code
			]);
		}

		Schema::enableForeignKeyConstraints();
	}
}