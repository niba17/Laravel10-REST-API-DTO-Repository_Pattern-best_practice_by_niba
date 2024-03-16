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
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->primary();
            $table->uuid('guest_uuid');
            $table->uuid('event_uuid');
            $table->string('desc');
            $table->boolean('status')->default(false);
            $table->uuid('invitation_type_uuid')->nullable();
            $table->timestamps();

            $table->foreign('event_uuid')->references('uuid')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('guest_uuid')->references('uuid')->on('guests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invitation_type_uuid')->references('uuid')->on('invitation_types')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
