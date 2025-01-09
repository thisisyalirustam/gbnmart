<?php

use App\Models\Country;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); // user_id is nullable
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('grand_total', 10, 2);
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->text('address');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
