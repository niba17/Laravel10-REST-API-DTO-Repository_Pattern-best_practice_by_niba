<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->primary();
            $table->string('name');
            $table->uuid('subdistrict_uuid')->nullable();
            $table->foreign('subdistrict_uuid')->references('uuid')->on('subdistricts');
            $table->uuid('village_uuid')->nullable();
            $table->foreign('village_uuid')->references('uuid')->on('villages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
