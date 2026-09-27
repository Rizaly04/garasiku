@extends('layouts.app')

@section('title', 'Catat Pembayaran')

@section('content')
<h2 class="mb-4">Catat Pembayaran</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Order Servis</label>
                <select name="service_order_id" class="form-select" required>
                    <option value="">-- Pilih Order --</option>
                    @foreach($serviceOrders as $order)
                        <option value="{{ $order->id }}" {{ (old('service_order_id', $selectedOrderId) == $order->id) ? 'selected' : '' }}>
                            #{{ $order->id }} - {{ $order->customer->name }} (Total: Rp {{ number_format($order->total_price, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Bayar (Rp)</label>
                <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-select" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="qris">QRIS</option>
                    <option value="debit">Kartu Debit</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection