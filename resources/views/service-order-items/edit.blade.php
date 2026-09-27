@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<h2 class="mb-4">Edit Item</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Item:</strong> {{ $serviceOrderItem->service->name ?? $serviceOrderItem->part->name }}</p>
        <p><strong>Harga Satuan:</strong> Rp {{ number_format($serviceOrderItem->price, 0, ',', '.') }}</p>

        <form action="{{ route('service-order-items.update', $serviceOrderItem) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $serviceOrderItem->quantity) }}" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('service-orders.show', $serviceOrderItem->service_order_id) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection