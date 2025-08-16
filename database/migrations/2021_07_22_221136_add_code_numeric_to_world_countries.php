<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to add numeric code column to world_countries table.
 * 
 * This migration adds ISO3166-1-Numeric code support to countries.
 */
class AddCodeNumericToWorldCountries extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('world_countries', function (Blueprint $table) {
            $table->smallInteger('code_numeric')
                ->after('code_alpha3')
                ->nullable()
                ->comment('ISO3166-1-Numeric');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('world_countries', function (Blueprint $table) {
            $table->dropColumn('code_numeric');
        });
    }
}
