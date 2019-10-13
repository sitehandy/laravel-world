<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldDivisionsLocaleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('world_divisions_locale', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Auto Increase ID');
            $table->bigInteger('division_id')->unsigned()->comment('Division ID');
            $table->string('name')->default('')->comment('Localized Division Name');
            $table->string('abbr', 16)->nullable()->comment('Localized Division Abbr');
            $table->string('alias')->nullable()->comment('Localized Division Alias');
            $table->string('full_name')->nullable()->comment('Localized Division Fullname');
            $table->string('locale', 6)->nullable()->comment('locale');
            $table->unique(['division_id','locale'], 'uniq_division_id_locale');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('world_divisions_locale');
    }
}
