<?php

use App\Models\ProductCat;
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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('content'); 
            $table->string('slug')->unique(); 
            $table->json('images')->nullable(); 
            $table->boolean('is_published')->default(false); 
            $table->timestamp('published_at')->nullable(); 
            $table->foreignIdFor(ProductCat::class)->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->json('product_ids')->nullable(); 
            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
