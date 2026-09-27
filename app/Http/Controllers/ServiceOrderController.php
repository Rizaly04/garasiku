<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\User;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceOrders = ServiceOrder::with('customer', 'vehicle', 'mechanic')->latest()->paginate(10);
        return view('service-orders.index', compact('serviceOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $vehicles = Vehicle::orderBy('plate_number')->get();
        $mechanics = User::where('role', 'mekanik')->orderBy('name')->get();
        return view('service-orders.create', compact('customers', 'vehicles', 'mechanics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:users,id',
            'check_in_date' => 'required|date',
        ]);
 
        $validated['status'] = 'check_in';
        $validated['total_price'] = 0;
 
        $serviceOrder = ServiceOrder::create($validated);
 
        return redirect()->route('service-orders.show', $serviceOrder)
            ->with('success', 'Order servis berhasil dibuat. Silakan tambahkan jasa/part yang dikerjakan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrder $serviceOrder)
    {
        $serviceOrder->load('customer', 'vehicle', 'mechanic', 'items.service', 'items.part', 'payments');
        return view('service-orders.show', compact('serviceOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOrder $serviceOrder)
    {
        $customers = Customer::orderBy('name')->get();
        $vehicles = Vehicle::orderBy('plate_number')->get();
        $mechanics = User::where('role', 'mekanik')->orderBy('name')->get();
        return view('service-orders.edit', compact('serviceOrder', 'customers', 'vehicles', 'mechanics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceOrder $serviceOrder)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'mechanic_id' => 'nullable|exists:users,id',
            'status' => 'required|in:check_in,dikerjakan,selesai,dibayar',
            'check_in_date' => 'required|date',
            'complete_date' => 'nullable|date',
        ]);
 
        $serviceOrder->update($validated);
 
        return redirect()->route('service-orders.show', $serviceOrder)
            ->with('success', 'Order servis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrder $serviceOrder)
    {
        $serviceOrder->delete();
        return redirect()->route('service-orders.index')->with('success', 'Order servis berhasil dihapus.');
    }
}
