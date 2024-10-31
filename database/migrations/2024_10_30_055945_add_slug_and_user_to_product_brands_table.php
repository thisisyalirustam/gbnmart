<?php

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
        Schema::table('product_brands', function (Blueprint $table) {
            //
            $table->string('slug')->unique()->nullable()->after('name'); // Adding slug as a nullable and unique column
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete()->after('name'); // Nullable foreign key for User
            $table->string('website')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_brands', function (Blueprint $table) {
            //
            $table->dropColumn(['slug', 'website', 'contact_email', 'contact_phone', 'description']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
