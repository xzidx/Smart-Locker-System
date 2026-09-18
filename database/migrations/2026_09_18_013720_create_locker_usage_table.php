<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locker_usage', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users');

            $table->foreignId('locker_id')
                  ->constrained('lockers');

            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->string('status', 30)->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locker_usage');
    }
};