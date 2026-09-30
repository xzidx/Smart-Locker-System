<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locker_maintenance', function (Blueprint $table) {
            $table->id();

            $table->foreignId('locker_id')
                ->constrained('lockers')
                ->cascadeOnDelete();

            $table->string('issue');

            $table->text('description')->nullable();

            $table->date('start_date');

            $table->date('end_date')->nullable();

            $table->string('status', 30)->default('Open');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locker_maintenance');
    }
};