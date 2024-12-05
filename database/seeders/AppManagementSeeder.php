<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get the country ID for Pakistan
        $countryId = Country::where('code', 'PK')->first()->id;

        // Insert dummy data into app_management
        DB::table('app_management')->insert([
            'name' => 'NortProduct', // Dummy app name
            'tagline' => 'Your one-stop shop for everything', // Dummy tagline
            'description' => 'A wide variety of products ranging from electronics to fashion and more.',
            'version' => '1.0.0',
            'phone' => '+92 300 1234567', // Dummy Pakistan phone number
            'email' => 'contact@nortproduct.com', // Dummy email
            'website' => 'https://www.nortproduct.com', // Dummy website URL
            'address' => '123, Main Street, Lahore, Pakistan', // Dummy address
            'country_id' => $countryId, // Link to Pakistan in the countries table
            'facebook' => 'https://facebook.com/nortproduct',
            'twitter' => 'https://twitter.com/nortproduct',
            'instagram' => 'https://instagram.com/nortproduct',
            'linkedin' => 'https://linkedin.com/company/nortproduct',
            'youtube' => 'https://youtube.com/nortproduct',
            'pinterest' => 'https://pinterest.com/nortproduct',
            'whatsapp' => '+92 300 9876543', // Dummy WhatsApp number
            'telegram' => 'https://t.me/nortproduct',
            'discord' => 'https://discord.gg/nortproduct',
            'logo' => 'https://www.nortproduct.com/logo.png',
            'icon' => 'https://www.nortproduct.com/icon.png',
            'currency' => 'PKR', // Pakistani Rupees as currency
            'payment_methods' => json_encode(['credit_card', 'paypal', 'stripe']),
            'shipping_methods' => json_encode(['standard', 'express']),
            'shipping_fee' => 200.00, // Dummy shipping fee
            'tax_percentage' => '10',
            'privacy_policy_url' => 'https://www.nortproduct.com/privacy-policy',
            'terms_of_service_url' => 'https://www.nortproduct.com/terms-of-service',
            'refund_policy_url' => 'https://www.nortproduct.com/refund-policy',
            'google_analytics_tracking_id' => 'UA-12345678-1',
            'facebook_pixel_id' => '123456789012345',
            'is_store_open' => true,
            'default_tax_rate' => 10.00,
            'meta_title' => 'NortProduct - Your One Stop Shop',
            'meta_description' => 'Buy everything you need at NortProduct. Electronics, fashion, home goods, and more.',
        ]);
    }
}



