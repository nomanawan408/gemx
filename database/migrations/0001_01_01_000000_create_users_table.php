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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_first_name')->nullable();
            $table->string('father_last_name')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('country')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('nationality')->nullable();
            $table->string('profession')->nullable();
            // $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('wechat')->nullable();
            $table->string('imo')->nullable();
            $table->string('cnic_passport_no')->nullable();
            $table->enum('type_of_passport', ['Official', 'Ordinary'])->nullable();
            $table->date('date_of_issue')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->boolean('trip_to_pak')->default(false);
            // $table->foreignId('role_id')->constrained('roles');
            $table->boolean('declaration')->default(false);
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            
            $table->timestamps(); 
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
