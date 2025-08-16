<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to add foreign keys to world_countries table.
 * 
 * This migration establishes the relationship between countries and continents.
 */
class AddForeignKeysToWorldCountriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('world_countries', function (Blueprint $table) {
            $table->foreign('continent_id', 'world_countries_ibfk_1')
                ->references('id')
                ->on('world_continents')
                ->onUpdate('RESTRICT')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('world_countries', function (Blueprint $table) {
            $table->dropForeign('world_countries_ibfk_1');
        });
    }
}
