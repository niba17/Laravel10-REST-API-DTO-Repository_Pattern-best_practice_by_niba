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
        Schema::create('join_in_inviting', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->primary();
            $table->uuid('event_id');
            $table->string('family_name');
            $table->timestamps();

            $table->foreign('event_id')->references('uuid')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_in_inviting');
    }
};
