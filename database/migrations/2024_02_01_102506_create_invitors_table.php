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
        Schema::create('invitors', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->primary();
            $table->string('first_name');
            $table->string('mid_name')->nullable();
            $table->string('last_name')->nullable();
            $table->uuid('client_uuid');
            $table->string('parent_1_name')->nullable();
            $table->string('parent_2_name')->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();

            $table->foreign('client_uuid')->references('uuid')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitors');
    }
};
