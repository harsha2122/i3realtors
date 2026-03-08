<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@i3realtors.com'],
            [
                'name'              => 'Super Admin',
                'password'          => Hash::make('Admin@123456'),
                'email_verified_at' => now(),
                'is_active'         => true,
            ]
        );

        $admin->assignRole('super-admin');
    }
}
