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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->string('company_email')->nullable();
            $table->string('position')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_mobile')->nullable();
            $table->string('website_url')->nullable();
            $table->string('vat_tax_number')->nullable();
            $table->json('chamber_association_number')->nullable();
            $table->string('nature_of_business')->nullable();
            $table->json('type_of_business')->nullable();
            $table->text('main_business_items')->nullable();
            $table->text('main_import_items')->nullable();
            $table->text('main_export_items')->nullable();
            $table->text('main_import_countries')->nullable();
            $table->text('main_export_countries')->nullable();
            $table->decimal('annual_turnover', 15, 2)->nullable();
            $table->decimal('annual_import_export', 15, 2)->nullable();
            $table->decimal('annual_import_from_pak', 15, 2)->nullable();
            $table->string('ntn')->nullable();
            $table->string('gst')->nullable();
            $table->boolean('chamber_association_member')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
