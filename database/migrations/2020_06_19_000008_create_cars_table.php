<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
	const TABLE = 'cars';

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
			$table->smallInteger('brand_id')->unsigned()->index();
			$table->smallInteger('color_id')->unsigned()->nullable()->index();
			$table->string('plate_number', 16)->unique();
			$table->timestamps();

			$table->foreign('brand_id')->references('id')->on(CreateCarBrandsTable::TABLE)->onDelete('cascade') ->onUpdate('cascade');
			$table->foreign('color_id')->references('id')->on(CreateColorsTable::TABLE)   ->onDelete('set null')->onUpdate('cascade');
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
