<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreetsTable extends Migration
{
	const TABLE = 'streets';

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
			$table->integer('city_id')->unsigned()->index();
			$table->string('name', 255)->index();
			$table->timestamps();

			$table->unique(['city_id', 'name']);

			$table->foreign('city_id')->references('id')->on(CreateCitiesTable::TABLE)->onDelete('cascade')->onUpdate('cascade');
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
