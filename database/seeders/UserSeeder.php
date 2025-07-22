<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@clinic.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Create additional users for testing
        User::create([
            'name' => 'Dr. สมชาย ใจดี',
            'email' => 'doctor@clinic.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'นางสาวสมศรี เขียนดี',
            'email' => 'writer@clinic.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
        ]);
    }
}
