<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Satu',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
        ]);

        // Customer
        User::create([
            'name' => 'Pelanggan Pertama',
            'email' => 'user@example.com',
            'password' => Hash::make('12345'),
            'role' => 'customer',
        ]);
    }
}