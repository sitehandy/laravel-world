<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to create the world_languages table.
 * 
 * This table stores information about world languages including
 * ISO codes and native names.
 */
class CreateWorldLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('world_languages', function (Blueprint $table) {
            $table->id();
            $table->string('iso_language_name', 255);
            $table->string('native_name', 255);
            $table->string('iso2', 2);
            $table->string('iso3', 3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('world_languages');
    }
}
