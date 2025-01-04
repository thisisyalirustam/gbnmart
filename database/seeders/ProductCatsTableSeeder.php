<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCatsTableSeeder extends Seeder
{
    public function run()
    {
        // Insert categories related to your business
        DB::table('product_cats')->insert([
            ['name' => 'Dry Fruits', 'slug' => 'dry-fruits'],
            ['name' => 'Shilajit', 'slug' => 'shilajit'],
            ['name' => 'Gemstones', 'slug' => 'gemstones'],
            ['name' => 'Handmade Crockery', 'slug' => 'handmade-crockery'],
            ['name' => 'Handmade Dresses and Bags', 'slug' => 'handmade-dresses-and-bags'],
            ['name' => 'Stitching and Tailoring Services', 'slug' => 'stitching-and-tailoring-services'],
            ['name' => 'Homeopathic Herbs', 'slug' => 'homeopathic-herbs'],
        ]);
        
    }
}
