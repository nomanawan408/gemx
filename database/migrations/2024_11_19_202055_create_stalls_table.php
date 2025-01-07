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
        Schema::create('stalls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('stall')->nullable();
            $table->string('stall_products')->nullable();
            $table->string('selectbiz')->nullable();
            $table->string('booth_type')->default('Gems & Jewellery');
            $table->string('booth_size')->default('Any Special Request');
            $table->string('other_booth_size')->default('5x5');
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stalls');
    }
};
