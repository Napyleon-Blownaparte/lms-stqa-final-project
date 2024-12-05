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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("flight_code", length: 5)->nullable(false)->unique();
            $table->string("origin", length: 3)->nullable(false);
            $table->string("destination", length: 3)->nullable(false);
            $table->dateTime("departure_time")->nullable(false);
            $table->dateTime("arrival_time")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
