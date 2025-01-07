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
            $table->string('flight_no')->nullable(); // Flight number
            $table->string('airline_name')->nullable(); // Airline name
            $table->string('seat_no')->nullable(); // Seat number
            $table->integer('no_of_persons')->nullable(); // Number of persons
            $table->string('ticket_upload')->nullable(); // Ticket upload
            $table->dateTime('departure_date_time')->nullable() ; // Departure date & time
            $table->dateTime('arrival_date_time')->nullable(); // Flight arrival date & time
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
