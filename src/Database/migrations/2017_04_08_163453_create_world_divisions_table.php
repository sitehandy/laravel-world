<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldDivisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('world_divisions', function(Blueprint $table)
		{
			$table->bigIncrements('id')->comment('Auto Increase ID');
			$table->bigInteger('country_id')->unsigned()->comment('Country ID');
			$table->string('name')->default('')->comment('Division Common Name');
			$table->string('full_name')->nullable()->comment('Division Full Name');
			$table->string('code', 64)->nullable()->comment('ISO 3166-2 Code');
			$table->boolean('has_city')->default(0)->comment('Has city?');
			$table->unique(['country_id','name'], 'uniq_division');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('world_divisions');
	}

}
