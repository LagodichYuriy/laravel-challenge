<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
	const TABLE = 'buildings';

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
			$table->integer('street_id')->unsigned()->index();
			$table->integer('building_number')->unsigned()->index();
			$table->timestamps();

			$table->unique(['street_id', 'building_number']);

			$table->foreign('street_id')->references('id')->on(CreateStreetsTable::TABLE)->onDelete('cascade')->onUpdate('cascade');
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
