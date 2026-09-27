<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Ganti Oli Mesin', 'description' => 'Penggantian oli mesin standar', 'price' => 75000],
            ['name' => 'Servis Rem', 'description' => 'Pengecekan dan perbaikan sistem rem', 'price' => 100000],
            ['name' => 'Tune Up Mesin', 'description' => 'Penyetelan ulang performa mesin', 'price' => 150000],
            ['name' => 'Cuci Kendaraan', 'description' => 'Cuci bersih bodi dan mesin', 'price' => 35000],
            ['name' => 'Servis AC', 'description' => 'Pengecekan dan pengisian freon AC', 'price' => 120000],
            ['name' => 'Balancing & Spooring', 'description' => 'Penyeimbangan roda kendaraan', 'price' => 90000],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}