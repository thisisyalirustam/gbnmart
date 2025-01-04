<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\ProductBrand;

class BannersTableSeeder extends Seeder
{
    public function run()
    {
        // Initialize Faker to generate random data
        $faker = Faker::create();

        // Generate a list of ProductCat, ProductSubCategory, and ProductBrand records
        $productCats = ProductCat::all();
        $productSubCategories = ProductSubCategory::all();
        $productBrands = ProductBrand::all();

        // Create a sample number of banners
        for ($i = 0; $i < 3; $i++) { // Adjust the number of banners as needed
            DB::table('banners')->insert([
                'title' => $faker->sentence, // Random title
                'percentage' => $faker->numberBetween(10, 50) . '%', // Random percentage
                'description' => $faker->text(200), // Random description
                'image' => $faker->imageUrl(800, 600, 'business'), // Random image URL
                'product_cat_id' => $productCats->random()->id ?? null, // Random category
                'product_sub_category_id' => $productSubCategories->random()->id ?? null, // Random sub-category
                'product_brand_id' => $productBrands->random()->id ?? null, // Random brand
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
