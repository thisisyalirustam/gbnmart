<?php

use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('percentage')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignIdFor(ProductCat::class)->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignIdFor(ProductSubCategory::class)->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignIdFor(ProductBrand::class)->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
