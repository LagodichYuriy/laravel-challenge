<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
	const TABLE = 'regions';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(self::TABLE, function (Blueprint $table)
		{
			$table->integer('id')->unsigned()->autoIncrement();
			$table->smallInteger('country_id')->unsigned()->index();
			$table->string('name', 255)->index();
			$table->string('code', 6)->index();
			$table->timestamps();

			$table->unique(['country_id', 'name']);
			$table->unique(['country_id', 'code']);

			$table->foreign('country_id')->references('id')->on(CreateCountriesTable::TABLE)->onDelete('cascade')->onUpdate('cascade');
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
