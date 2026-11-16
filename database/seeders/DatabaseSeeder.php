<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rental.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Biasa',
            'email' => 'user@rental.com',
            'password' => 'password',
            'role' => 'user',
        ]);
    }
}