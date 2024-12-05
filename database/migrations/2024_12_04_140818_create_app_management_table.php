<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // Updated migration for app_management table
public function up(): void
{
    Schema::create('app_management', function (Blueprint $table) {
        $table->id();

        // App general information
        $table->string('name')->nullable();
        $table->string('tagline')->nullable();
        $table->string('description')->nullable();
        $table->string('version')->nullable();

        // Contact Information
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->string('website')->nullable();

        // Address Information
        $table->string('address')->nullable(); // New address field
        $table->foreignId('country_id')->nullable()->constrained('countries'); // New country_id foreign key

        // Social Media Links
        $table->string('facebook')->nullable();
        $table->string('twitter')->nullable();
        $table->string('instagram')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('youtube')->nullable();
        $table->string('pinterest')->nullable();

        // Messaging & Customer Service
        $table->string('whatsapp')->nullable();
        $table->string('telegram')->nullable();
        $table->string('discord')->nullable();

        // App Branding
        $table->string('logo')->nullable();
        $table->string('icon')->nullable();

        // Payment & Currency
        $table->string('currency')->nullable();
        $table->json('payment_methods')->nullable();

        // Shipping & Delivery Information
        $table->json('shipping_methods')->nullable();
        $table->decimal('shipping_fee')->nullable();

        // Tax Settings
        $table->string('tax_percentage')->nullable();

        // Legal Pages
        $table->string('privacy_policy_url')->nullable();
        $table->string('terms_of_service_url')->nullable();
        $table->string('refund_policy_url')->nullable();

        // Analytics & Tracking
        $table->string('google_analytics_tracking_id')->nullable();
        $table->string('facebook_pixel_id')->nullable();

        // Store Settings
        $table->boolean('is_store_open')->default(true);
        $table->decimal('default_tax_rate', 8, 2)->nullable();

        // SEO Settings
        $table->string('meta_title')->nullable();
        $table->string('meta_description')->nullable();

        // Date and Time tracking
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_management');
    }
};
