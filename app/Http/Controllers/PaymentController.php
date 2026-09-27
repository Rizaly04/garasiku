<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\ServiceOrder;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('serviceOrder')->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $serviceOrders = ServiceOrder::where('status', '!=', 'dibayar')->orderBy('id', 'desc')->get();
        $selectedOrderId = $request->query('service_order_id');
        return view('payments.create', compact('serviceOrders', 'selectedOrderId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_order_id' => 'required|exists:service_orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
        ]);
 
        $validated['paid_at'] = now();
 
        Payment::create($validated);
 
        $this->updateOrderStatusIfPaidOff($validated['service_order_id']);
 
        return redirect()->route('service-orders.show', $validated['service_order_id'])
            ->with('success', 'Pembayaran berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load('serviceOrder');
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
        ]);
 
        $payment->update($validated);
 
        $this->updateOrderStatusIfPaidOff($payment->service_order_id);
 
        return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $orderId = $payment->service_order_id;
        $payment->delete();
 
        // Kalau ternyata jadi belum lunas lagi setelah dihapus, kembalikan status order
        $order = ServiceOrder::find($orderId);
        if ($order && $order->status === 'dibayar') {
            $order->update(['status' => 'selesai']);
        }
 
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    private function updateOrderStatusIfPaidOff($serviceOrderId)
    {
        $order = ServiceOrder::find($serviceOrderId);
        if (!$order) {
            return;
        }
 
        $totalPaid = Payment::where('service_order_id', $serviceOrderId)->sum('amount');
 
        if ($order->total_price > 0 && $totalPaid >= $order->total_price) {
            $order->update(['status' => 'dibayar']);
        }
    }
}
