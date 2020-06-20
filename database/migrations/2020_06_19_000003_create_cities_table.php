<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
	const TABLE = 'cities';

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
			$table->integer('region_id')->unsigned()->index();
			$table->string('name', 255)->index();
			$table->timestamps();

			$table->unique(['region_id', 'name']);

			$table->foreign('region_id')->references('id')->on(CreateRegionsTable::TABLE)->onDelete('cascade')->onUpdate('cascade');
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
