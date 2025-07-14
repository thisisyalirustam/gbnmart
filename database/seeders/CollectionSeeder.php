<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collections')->insert([
            ['name' => 'Summer Vibes', 'slug' => 'summer-vibes', 'description' => 'A bright and breezy summer collection.', 'is_active' => true],
            ['name' => 'Winter Essentials', 'slug' => 'winter-essentials', 'description' => 'Stay warm with our winter picks.', 'is_active' => true],
            ['name' => 'Back to School', 'slug' => 'back-to-school', 'description' => 'Get ready for the new academic year.', 'is_active' => true],
            ['name' => 'Spring Refresh', 'slug' => 'spring-refresh', 'description' => 'Fresh styles for a new season.', 'is_active' => true],
            ['name' => 'Casual Everyday', 'slug' => 'casual-everyday', 'description' => 'Comfortable picks for daily wear.', 'is_active' => true],
            ['name' => 'Work From Home', 'slug' => 'work-from-home', 'description' => 'Essentials for your home office.', 'is_active' => true],
            ['name' => 'Minimalist Style', 'slug' => 'minimalist-style', 'description' => 'Simple. Clean. Powerful.', 'is_active' => true],
            ['name' => 'Bold Statements', 'slug' => 'bold-statements', 'description' => 'Stand out with these picks.', 'is_active' => true],
            ['name' => 'Eco Friendly Picks', 'slug' => 'eco-friendly-picks', 'description' => 'Sustainable and stylish.', 'is_active' => true],
            ['name' => 'Weekend Getaway', 'slug' => 'weekend-getaway', 'description' => 'Perfect for your short trips.', 'is_active' => true],
            ['name' => 'Holiday Specials', 'slug' => 'holiday-specials', 'description' => 'Festive season favorites.', 'is_active' => true],
            ['name' => 'New Arrivals', 'slug' => 'new-arrivals', 'description' => 'Hot off the shelves.', 'is_active' => true],
        ]);
    }
}
