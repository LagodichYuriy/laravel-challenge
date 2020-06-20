<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
	const TABLE = 'countries';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(self::TABLE, function (Blueprint $table)
		{
			$table->smallInteger('id')->unsigned()->unique();  # ISO 3166-1
			$table->string('name', 255)->unique();
			$table->char('code', 2)->unique();                 # ISO 3166-2
			$table->char('code_long', 3)->unique();            # ISO 3166-3
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(self::TABLE);
	}
}
