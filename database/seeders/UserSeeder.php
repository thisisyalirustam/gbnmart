<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'y.ali.rustam@gmail.com'],
            [
                'name' => 'Yaseen Ali',
                'user_type' => 'admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Ali@12345')),
                'email_verified_at' => now(),
            ]
        );
    }
}
