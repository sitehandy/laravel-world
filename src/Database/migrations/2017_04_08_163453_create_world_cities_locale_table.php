<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldCitiesLocaleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('world_cities_locale', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Auto increase ID');
            $table->bigInteger('city_id')->unsigned()->comment('City ID');
            $table->string('name')->default('')->comment('Localized city name');
            $table->string('alias')->nullable()->comment('Localized city alias');
            $table->string('full_name')->nullable()->comment('Localized city fullname');
            $table->string('locale', 6)->nullable()->comment('locale name');
            $table->unique(['city_id','locale'], 'uniq_city_id_locale');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('world_cities_locale');
    }
}
