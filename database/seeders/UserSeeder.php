<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds to create admin and regular users.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'gilbertoo',
            'email' => 'gilbertoo@gmail.com',
            'password' => Hash::make('gilbertoo125s'), // Remember to change this in production
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'bio' => 'Admin untuk semua',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create Regular Users
        User::create([
            'name' => 'Mang Paez',
            'email' => 'mangpaes@gmail.com',
            'password' => Hash::make('mangpaez123'),
            'role' => 'user',
            'email_verified_at' => Carbon::now(),
            'bio' => 'Ocean enthusiast and regular contributor',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Nikita',
            'email' => 'nikita@gmail.com',
            'password' => Hash::make('nikita123'),
            'role' => 'user',
            'email_verified_at' => Carbon::now(),
            'bio' => 'Marine biologist with passion for ocean conservation',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Optional: Create more users with Faker if you want more test data
        if (app()->environment('local', 'development')) {
            \App\Models\User::factory(10)->create();
        }
    }
}
