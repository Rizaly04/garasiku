<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create(['name' => 'Budi Santoso', 'phone' => '081234567890', 'address' => 'Jl. Merdeka No. 10, Samarinda']);
        Customer::create(['name' => 'Siti Aminah', 'phone' => '081298765432', 'address' => 'Jl. Sudirman No. 25, Balikpapan']);
        Customer::create(['name' => 'Andi Wijaya', 'phone' => '082112345678', 'address' => 'Jl. Ahmad Yani No. 5, Samarinda']);
    }
}