<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Owner GARASIKU',
            'email' => 'owner@garasiku.test',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'Admin Kasir',
            'email' => 'admin@garasiku.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Joko Mekanik',
            'email' => 'joko@garasiku.test',
            'password' => Hash::make('password123'),
            'role' => 'mekanik',
        ]);

        User::create([
            'name' => 'Rudi Mekanik',
            'email' => 'rudi@garasiku.test',
            'password' => Hash::make('password123'),
            'role' => 'mekanik',
        ]);
    }
}