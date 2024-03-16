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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->primary();
            $table->string('name');
            $table->string('date');
            $table->uuid('event_type_uuid')->nullable();
            $table->uuid('client_uuid');
            $table->uuid('song_uuid')->nullable();
            $table->uuid('village_uuid_1')->nullable();
            $table->uuid('village_uuid_2')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();

            $table->foreign('client_uuid')->references('uuid')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_type_uuid')->references('uuid')->on('event_types')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('song_uuid')->references('uuid')->on('songs')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('village_uuid_1')->references('uuid')->on('villages')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('village_uuid_2')->references('uuid')->on('villages')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
