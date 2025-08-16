<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to create the world_cities table.
 * 
 * This table stores information about cities including their names,
 * codes, and relationships to countries and divisions.
 */
class CreateWorldCitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('world_cities', function (Blueprint $table) {
            $table->id()->comment('Auto increase ID');
            $table->unsignedBigInteger('country_id')->comment('Country ID');
            $table->unsignedBigInteger('division_id')->nullable()->index('division_id')->comment('Division ID');
            $table->string('name', 255)->default('')->comment('City Name');
            $table->string('full_name', 255)->nullable()->comment('City Fullname');
            $table->string('code', 64)->nullable()->comment('City Code');
            $table->index(['country_id', 'division_id', 'name'], 'uniq_city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('world_cities');
    }
}
