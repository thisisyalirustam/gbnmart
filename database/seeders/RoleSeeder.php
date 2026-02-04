<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create SuperAdmin role
        Role::firstOrCreate([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ]);

        // Create Admin role
        Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        // Optional message in console
        $this->command->info('✅ Roles SuperAdmin and Admin created successfully!');
    }
}
