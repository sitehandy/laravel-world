<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to add timezone column to world_cities table.
 * 
 * This migration adds IANA timezone information to cities.
 */
class AddTimezoneToWorldCitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('world_cities', function (Blueprint $table) {
            $table->string('iana_timezone', 255)
                ->after('code')
                ->nullable()
                ->comment('IANA Timezone Name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('world_cities', function (Blueprint $table) {
            $table->dropColumn('iana_timezone');
        });
    }
}
