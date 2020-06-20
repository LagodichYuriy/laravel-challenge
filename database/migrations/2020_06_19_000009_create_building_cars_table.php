<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingCarsTable extends Migration
{
	const TABLE = 'building_cars';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(self::TABLE, function (Blueprint $table)
		{
			$table->integer('building_id')->unsigned()->unique();
			$table->integer('car_id')->unsigned()->unique();
			$table->timestamps();

			$table->foreign('building_id')->references('id')->on(CreateBuildingsTable::TABLE)->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('car_id')     ->references('id')->on(CreateCarsTable::TABLE)     ->onDelete('cascade')->onUpdate('cascade');
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
