<?php

use App\Models\ProductBrand;
use App\Models\ProductCat;
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
            $table->string('name');
            $table->string('name_slug');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('description_slug')->nullable();
            $table->foreignIdFor(ProductCat::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(ProductSubCategory::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->foreignIdFor(ProductBrand::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('users');
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->json('color_options')->nullable();
            $table->string('size_options')->nullable();
            $table->string('material')->nullable(); // Material
            $table->json('images')->nullable(); // Images (JSON array)
            $table->decimal('rating', 3, 2)->nullable(); // Product Rating
            $table->text('reviews')->nullable(); // Reviews
            $table->string('shipping_info')->nullable(); // Shipping Info
            $table->string('return_policy')->nullable(); // Return Policy
            $table->json('tags')->nullable(); // Tags (JSON array)
            $table->boolean('featured')->default(false); // Featured Product (Boolean)
            $table->timestamps(); // Created At and Updated At
            $table->softDeletes(); // Adds deleted_at column for soft deletes
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
