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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained('flights');
            $table->string('passenger_name')->nullable(false);
            $table->string('passenger_phone', length: 14)->nullable(false);
            $table->string("seat_number", length: 3)->nullable(false);
            $table->boolean("is_boarding")->nullable(false)->default(0);
            $table->dateTime("boarding_time")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
