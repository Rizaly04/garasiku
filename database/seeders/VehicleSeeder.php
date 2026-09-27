<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $budi = Customer::where('name', 'Budi Santoso')->first();
        $siti = Customer::where('name', 'Siti Aminah')->first();
        $andi = Customer::where('name', 'Andi Wijaya')->first();

        Vehicle::create(['customer_id' => $budi->id, 'plate_number' => 'KT 1234 AB', 'brand' => 'Toyota', 'model' => 'Avanza', 'year' => 2019]);
        Vehicle::create(['customer_id' => $siti->id, 'plate_number' => 'KT 5678 CD', 'brand' => 'Honda', 'model' => 'Beat', 'year' => 2021]);
        Vehicle::create(['customer_id' => $andi->id, 'plate_number' => 'KT 9012 EF', 'brand' => 'Yamaha', 'model' => 'NMAX', 'year' => 2020]);
    }
}