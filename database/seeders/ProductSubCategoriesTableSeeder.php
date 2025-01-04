<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSubCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Insert subcategories related to each product category
        DB::table('product_sub_categories')->insert([
            // Subcategories for Dry Fruits
            ['name' => 'Almonds', 'slug' => 'almonds', 'product_cat_id' => 1],
            ['name' => 'Cashews', 'slug' => 'cashews', 'product_cat_id' => 1],
            ['name' => 'Pistachios', 'slug' => 'pistachios', 'product_cat_id' => 1],
            ['name' => 'Raisins', 'slug' => 'raisins', 'product_cat_id' => 1],
            
            // Subcategories for Shilajit
            ['name' => 'Pure Shilajit', 'slug' => 'pure-shilajit', 'product_cat_id' => 2],
            ['name' => 'Shilajit Resin', 'slug' => 'shilajit-resin', 'product_cat_id' => 2],
            
            // Subcategories for Gemstones
            ['name' => 'Emeralds', 'slug' => 'emeralds', 'product_cat_id' => 3],
            ['name' => 'Rubies', 'slug' => 'rubies', 'product_cat_id' => 3],
            ['name' => 'Diamonds', 'slug' => 'diamonds', 'product_cat_id' => 3],
            ['name' => 'Amethyst', 'slug' => 'amethyst', 'product_cat_id' => 3],
            
            // Subcategories for Handmade Crockery (Jugs, etc.)
            ['name' => 'Clay Jugs', 'slug' => 'clay-jugs', 'product_cat_id' => 4],
            ['name' => 'Hand-painted Crockery', 'slug' => 'hand-painted-crockery', 'product_cat_id' => 4],
            ['name' => 'Ceramic Jugs', 'slug' => 'ceramic-jugs', 'product_cat_id' => 4],
            
            // Subcategories for Handmade Dresses and Bags
            ['name' => 'Handmade Dresses', 'slug' => 'handmade-dresses', 'product_cat_id' => 5],
            ['name' => 'Handmade Bags', 'slug' => 'handmade-bags', 'product_cat_id' => 5],
            
            // Subcategories for Stitching and Tailoring Services
            ['name' => 'Custom Stitching', 'slug' => 'custom-stitching', 'product_cat_id' => 6],
            ['name' => 'Tailored Suits', 'slug' => 'tailored-suits', 'product_cat_id' => 6],
            ['name' => 'Bridal Wear Stitching', 'slug' => 'bridal-wear-stitching', 'product_cat_id' => 6],
            
            // Subcategories for Homeopathic Herbs (Jadi Booti)
            ['name' => 'Herbal Remedies', 'slug' => 'herbal-remedies', 'product_cat_id' => 7],
            ['name' => 'Ayurvedic Herbs', 'slug' => 'ayurvedic-herbs', 'product_cat_id' => 7],
        ]);
    }
}
