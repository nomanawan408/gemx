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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('business_card')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_registration_copy')->nullable();
            $table->string('chamber_association_certificate')->nullable();
            $table->string('company_catalogue')->nullable();
            $table->string('passport_cnic_file')->nullable();
            $table->string('bank_statement')->nullable();
            $table->string('pay_order_draft_no')->nullable();
            $table->decimal('pay_order_amount', 15, 2)->nullable();
            $table->date('pay_order_date')->nullable();
            $table->string('pay_order_bank_name')->nullable();
            $table->string('pay_order_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
