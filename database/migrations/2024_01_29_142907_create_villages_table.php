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
        Schema::create('villages', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->primary();
            $table->string('name');
            $table->uuid('district_uuid')->nullable();
            $table->uuid('subdistricts_uuid')->nullable();
            $table->timestamps();

            $table->foreign('district_uuid')->references('uuid')->on('districts')->onDelete('set null');
            $table->foreign('subdistricts_uuid')->references('uuid')->on('subdistricts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
