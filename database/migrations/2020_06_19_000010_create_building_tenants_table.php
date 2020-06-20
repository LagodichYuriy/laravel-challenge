<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingTenantsTable extends Migration
{
	const TABLE = 'building_tenants';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(self::TABLE, function (Blueprint $table)
		{
			$table->integer('building_id')->unsigned()->index();
			$table->integer('citizen_id')->unsigned()->unique();
			$table->timestamps();

			//$table->unique(['building_id', 'citizen_id']);

			$table->foreign('building_id')->references('id')->on(CreateBuildingsTable::TABLE)->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('citizen_id') ->references('id')->on(CreateCitizensTable::TABLE) ->onDelete('cascade')->onUpdate('cascade');
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
