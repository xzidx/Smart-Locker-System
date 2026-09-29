<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('locker_id')
                ->constrained('lockers')
                ->cascadeOnDelete();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnDelete();

            $table->dateTime('start_time');

            $table->integer('duration');

            $table->string('name');

            $table->string('email');

            $table->string('phone', 30);

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
