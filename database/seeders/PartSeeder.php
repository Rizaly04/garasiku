<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        $parts = [
            ['name' => 'Oli Mesin 4T 1L', 'price' => 55000, 'stock' => 40],
            ['name' => 'Kampas Rem Depan', 'price' => 85000, 'stock' => 25],
            ['name' => 'Busi Standar', 'price' => 25000, 'stock' => 60],
            ['name' => 'Aki Kering 12V', 'price' => 450000, 'stock' => 10],
            ['name' => 'Filter Udara', 'price' => 40000, 'stock' => 30],
            ['name' => 'Ban Luar Ring 14', 'price' => 350000, 'stock' => 4],
        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }
}