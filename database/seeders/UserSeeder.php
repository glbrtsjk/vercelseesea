<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{

    public function run(): void
    {
              User::create([
            'name' => 'gilbertoo',
            'email' => 'gilbertoo@gmail.com',
            'password' => Hash::make('gilbertoo125s'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'bio' => 'Admin untuk semua',
            'foto_profil' => 'storage/profiles/gilbert.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        User::create([
            'name' => 'Mang Paez',
            'email' => 'mangpaes@gmail.com',
            'password' => Hash::make('mangpaez123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'bio' => 'admin untuk artikel',
            'foto_profil' => 'storage/profiles/paez.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'maria db',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('maria123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'bio' => 'adminuntuk komunitas',
            'created_at' => Carbon::now(),
            'foto_profil' => 'storage/profiles/maria.jpg',
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'agnes Mo',
            'email' => 'agnes@gmail.com',
            'password' => Hash::make('agnes123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'bio' => 'adminuntuk komunitas',
            'foto_profil' => 'storage/profiles/agnes.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

          User::create([
            'name' => 'winanda Sari',
            'email' => 'winanda@gmail.com',
            'password' => Hash::make('winanda123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'bio' => 'admin untuk moderasi',
            'foto_profil' => 'storage/profiles/winanda.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        if (app()->environment('local', 'development')) {
            \App\Models\User::factory(10)->create();
        }
    }
}
