@extends('layouts.app')

@section('title', 'Detail Item')

@section('content')
<h2 class="mb-4">Detail Item</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Order</th><td><a href="{{ route('service-orders.show', $serviceOrderItem->service_order_id) }}">#{{ $serviceOrderItem->service_order_id }}</a></td></tr>
            <tr><th>Item</th><td>{{ $serviceOrderItem->service->name ?? $serviceOrderItem->part->name }}</td></tr>
            <tr><th>Jumlah</th><td>{{ $serviceOrderItem->quantity }}</td></tr>
            <tr><th>Harga Satuan</th><td>Rp {{ number_format($serviceOrderItem->price, 0, ',', '.') }}</td></tr>
            <tr><th>Subtotal</th><td>Rp {{ number_format($serviceOrderItem->subtotal, 0, ',', '.') }}</td></tr>
        </table>
    </div>
</div>

<a href="{{ route('service-orders.show', $serviceOrderItem->service_order_id) }}" class="btn btn-secondary mt-3">Kembali ke Order</a>
@endsection