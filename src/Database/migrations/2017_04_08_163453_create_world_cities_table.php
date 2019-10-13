<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldCitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('world_cities', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Auto increase ID');
            $table->bigInteger('country_id')->unsigned()->comment('Country ID');
            $table->bigInteger('division_id')->unsigned()->nullable()->index('division_id')->comment('Division ID');
            $table->string('name')->default('')->comment('City Name');
            $table->string('full_name')->nullable()->comment('City Fullname');
            $table->string('code', 64)->nullable()->comment('City Code');
            $table->index(['country_id','division_id','name'], 'uniq_city');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('world_cities');
    }
}
