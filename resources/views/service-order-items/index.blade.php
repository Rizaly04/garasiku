@extends('layouts.app')

@section('title', 'Semua Item Order')

@section('content')
<h2 class="mb-4"><i class="bi bi-list-check me-2"></i>Semua Item Order Servis</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-sm">
            <thead><tr><th>Order</th><th>Item</th><th>Qty</th><th>Subtotal</th></tr></thead>
            <tbody>
                @forelse($serviceOrderItems as $item)
                <tr>
                    <td><a href="{{ route('service-orders.show', $item->service_order_id) }}">#{{ $item->service_order_id }}</a></td>
                    <td>{{ $item->service->name ?? $item->part->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada item.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $serviceOrderItems->links() }}
    </div>
</div>
@endsection