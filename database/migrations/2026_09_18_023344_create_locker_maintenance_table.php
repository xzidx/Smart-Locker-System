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
       Schema::create('locker_maintenance', function (Blueprint $table) {
            $table->id();

            $table->foreignId('locker_id')
                  ->constrained('lockers');

            $table->string('issue', 255);
            $table->text('description')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('status', 30)->default('in_progress');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locker_maintenance');
    }
};
