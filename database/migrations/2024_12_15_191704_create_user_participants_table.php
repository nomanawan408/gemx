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
        Schema::create('user_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('father_firstname')->nullable();
            $table->string('father_lastname')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Preferred Not To Say'])->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('wechat')->nullable();
            $table->string('imo')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_issue')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->enum('passport_type', ['Ordinary', 'Official'])->nullable();
            $table->string('passport_file')->nullable();
            $table->string('previous_trips')->nullable();
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_participants');
    }
};
