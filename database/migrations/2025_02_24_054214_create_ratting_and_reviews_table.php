<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        Schema::create('ratings_and_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete(); // Link to the purchased product in an order
            $table->string('reviewer_name'); // Name from order (guest) or user account
            $table->string('reviewer_email'); // Email from order (guest) or user account
            $table->double('rating')->min(1)->max(5);
            $table->text('review')->nullable();
            $table->boolean('status')->default(0); // Moderation status
            $table->timestamps();
            $table->unique(['order_item_id']); // One review per product in an order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratting_and_reviews');
    }
};
