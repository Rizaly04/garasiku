<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Service;
use App\Models\Part;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderItem;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DemoOrderSeeder extends Seeder
{
    public function run(): void
    {
        $budi = Customer::where('name', 'Budi Santoso')->first();
        $vehicleBudi = Vehicle::where('customer_id', $budi->id)->first();
        $joko = User::where('email', 'joko@garasiku.test')->first();

        $siti = Customer::where('name', 'Siti Aminah')->first();
        $vehicleSiti = Vehicle::where('customer_id', $siti->id)->first();
        $rudi = User::where('email', 'rudi@garasiku.test')->first();

        $gantiOli = Service::where('name', 'Ganti Oli Mesin')->first();
        $servisRem = Service::where('name', 'Servis Rem')->first();
        $oliPart = Part::where('name', 'Oli Mesin 4T 1L')->first();
        $kampasRem = Part::where('name', 'Kampas Rem Depan')->first();

        // Order 1: sudah lunas
        $order1 = ServiceOrder::create([
            'customer_id' => $budi->id,
            'vehicle_id' => $vehicleBudi->id,
            'mechanic_id' => $joko->id,
            'status' => 'check_in',
            'check_in_date' => now()->subDays(3)->toDateString(),
            'complete_date' => now()->subDays(2)->toDateString(),
            'total_price' => 0,
        ]);

        $item1 = ServiceOrderItem::create([
            'service_order_id' => $order1->id,
            'service_id' => $gantiOli->id,
            'quantity' => 1,
            'price' => $gantiOli->price,
            'subtotal' => $gantiOli->price,
        ]);

        $item2 = ServiceOrderItem::create([
            'service_order_id' => $order1->id,
            'part_id' => $oliPart->id,
            'quantity' => 1,
            'price' => $oliPart->price,
            'subtotal' => $oliPart->price,
        ]);
        $oliPart->decrement('stock', 1);

        $total1 = $item1->subtotal + $item2->subtotal;
        $order1->update(['total_price' => $total1, 'status' => 'dibayar']);

        Payment::create([
            'service_order_id' => $order1->id,
            'amount' => $total1,
            'payment_method' => 'cash',
            'paid_at' => now()->subDays(2),
        ]);

        // Order 2: masih dikerjakan, belum bayar
        $order2 = ServiceOrder::create([
            'customer_id' => $siti->id,
            'vehicle_id' => $vehicleSiti->id,
            'mechanic_id' => $rudi->id,
            'status' => 'dikerjakan',
            'check_in_date' => now()->toDateString(),
            'total_price' => 0,
        ]);

        $item3 = ServiceOrderItem::create([
            'service_order_id' => $order2->id,
            'service_id' => $servisRem->id,
            'quantity' => 1,
            'price' => $servisRem->price,
            'subtotal' => $servisRem->price,
        ]);

        $item4 = ServiceOrderItem::create([
            'service_order_id' => $order2->id,
            'part_id' => $kampasRem->id,
            'quantity' => 2,
            'price' => $kampasRem->price,
            'subtotal' => $kampasRem->price * 2,
        ]);
        $kampasRem->decrement('stock', 2);

        $order2->update(['total_price' => $item3->subtotal + $item4->subtotal]);
    }
}