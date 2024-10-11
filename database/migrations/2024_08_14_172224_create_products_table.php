<?php

use App\Models\ProductSubCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->text('description')->nullable(); // Detailed description
            $table->decimal('price', 10, 2); // Product price
            $table->integer('quantity')->default(0); // Available stock quantity
            $table->foreignIdFor(ProductSubCategory::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_image1')->nullable(); // URL of the product image
            $table->string('product_image2')->nullable(); // URL of the product image
            $table->string('product_image3')->nullable(); // URL of the product image
            $table->string('product_image4')->nullable(); // URL of the product image
            $table->string('SKU')->unique(); // Stock Keeping Unit, unique
            $table->decimal('weight', 8, 2)->nullable(); // Weight of the product
            $table->string('dimensions')->nullable(); // Dimensions of the product (LxWxH)
            $table->enum('status', ['available', 'out_of_stock', 'discontinued'])->default('available'); // Product status
            $table->decimal('rating', 3, 2)->nullable(); // Product rating (e.g., 4.25)
            $table->integer('rank')->default(0); // Rank or popularity score
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
