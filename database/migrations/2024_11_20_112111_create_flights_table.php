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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relates to users
            $table->dateTime('flight_arrival_date_time')->nullable(); // Flight arrival date & time
            $table->string('pickup_terminal')->nullable(); // Airport terminal or hotel details
            $table->string('dropoff_terminal')->nullable(); // Airport or custom location
            $table->timestamps();
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
