<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrderItem;
use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\Service;
use App\Models\Part;

class ServiceOrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceOrderItems = ServiceOrderItem::with('serviceOrder', 'service', 'part')->latest()->paginate(10);
        return view('service-order-items.index', compact('serviceOrderItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $serviceOrders = ServiceOrder::orderBy('id', 'desc')->get();
        $services = Service::orderBy('name')->get();
        $parts = Part::orderBy('name')->get(); 
        $selectedOrderId = $request->query('service_order_id');
        return view('service-order-items.create', compact('serviceOrders', 'services', 'parts', 'selectedOrderId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_order_id' => 'required|exists:service_orders,id',
            'service_id' => 'nullable|exists:services,id',
            'part_id' => 'nullable|exists:parts,id',
            'quantity' => 'required|integer|min:1',
        ]);
 
        if (empty($validated['service_id']) && empty($validated['part_id'])) {
            return back()->withErrors(['service_id' => 'Pilih salah satu: jasa atau sparepart.'])->withInput();
        }
 
        if (!empty($validated['part_id'])) {
            $part = Part::findOrFail($validated['part_id']);
            if ($part->stock < $validated['quantity']) {
                return back()->withErrors(['quantity' => 'Stok sparepart tidak cukup.'])->withInput();
            }
            $price = $part->price;
            $part->decrement('stock', $validated['quantity']);
        } else {
            $price = Service::findOrFail($validated['service_id'])->price;
        }
 
        $validated['price'] = $price;
        $validated['subtotal'] = $price * $validated['quantity'];
 
        ServiceOrderItem::create($validated);
 
        $this->recalculateTotal($validated['service_order_id']);
 
        return redirect()->route('service-orders.show', $validated['service_order_id'])
            ->with('success', 'Item berhasil ditambahkan ke order.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceOrderItem $serviceOrderItem)
    {
        $serviceOrderItem->load('serviceOrder', 'service', 'part');
        return view('service-order-items.show', compact('serviceOrderItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOrderItem $serviceOrderItem)
    {
        $services = Service::orderBy('name')->get();
        $parts = Part::orderBy('name')->get();
        return view('service-order-items.edit', compact('serviceOrderItem', 'services', 'parts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceOrderItem $serviceOrderItem)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
 
        if ($serviceOrderItem->part_id) {
            $part = Part::find($serviceOrderItem->part_id);
            $part->increment('stock', $serviceOrderItem->quantity);
 
            if ($part->stock < $validated['quantity']) {
                $part->decrement('stock', $validated['quantity']);
                return back()->withErrors(['quantity' => 'Stok sparepart tidak cukup.'])->withInput();
            }
            $part->decrement('stock', $validated['quantity']);
        }
 
        $serviceOrderItem->quantity = $validated['quantity'];
        $serviceOrderItem->subtotal = $serviceOrderItem->price * $validated['quantity'];
        $serviceOrderItem->save();
 
        $this->recalculateTotal($serviceOrderItem->service_order_id);
 
        return redirect()->route('service-orders.show', $serviceOrderItem->service_order_id)
            ->with('success', 'Item berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOrderItem $serviceOrderItem)
    {
        if ($serviceOrderItem->part_id) {
            Part::find($serviceOrderItem->part_id)?->increment('stock', $serviceOrderItem->quantity);
        }
 
        $orderId = $serviceOrderItem->service_order_id;
        $serviceOrderItem->delete();
 
        $this->recalculateTotal($orderId);
 
        return redirect()->route('service-orders.show', $orderId)->with('success', 'Item berhasil dihapus dari order.');
    }
 
    /**
     * hitung ulang total_price di service_orders berdasarkan semua itemnyoo
     */
    private function recalculateTotal($serviceOrderId)
    {
        $total = ServiceOrderItem::where('service_order_id', $serviceOrderId)->sum('subtotal');
        ServiceOrder::where('id', $serviceOrderId)->update(['total_price' => $total]);
    }
}
