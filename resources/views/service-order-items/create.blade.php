@extends('layouts.app')

@section('title', 'Tambah Item')

@section('content')
<h2 class="mb-4">Tambah Jasa/Sparepart ke Order</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('service-order-items.store') }}" method="POST">
            @csrf

            @if($selectedOrderId)
                <input type="hidden" name="service_order_id" value="{{ $selectedOrderId }}">
            @else
            <div class="mb-3">
                <label class="form-label">Order Servis</label>
                <select name="service_order_id" class="form-select" required>
                    <option value="">-- Pilih Order --</option>
                    @foreach($serviceOrders as $order)
                        <option value="{{ $order->id }}">#{{ $order->id }} - {{ $order->customer->name }} ({{ $order->vehicle->plate_number }})</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Jenis Item</label>
                <select id="itemType" class="form-select" onchange="toggleItemType()">
                    <option value="service">Jasa</option>
                    <option value="part">Sparepart</option>
                </select>
            </div>

            <div class="mb-3" id="serviceField">
                <label class="form-label">Pilih Jasa</label>
                <select name="service_id" class="form-select">
                    <option value="">-- Pilih Jasa --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }} (Rp {{ number_format($service->price, 0, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 d-none" id="partField">
                <label class="form-label">Pilih Sparepart</label>
                <select name="part_id" class="form-select">
                    <option value="">-- Pilih Sparepart --</option>
                    @foreach($parts as $part)
                        <option value="{{ $part->id }}">{{ $part->name }} (Stok: {{ $part->stock }}, Rp {{ number_format($part->price, 0, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambahkan</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
function toggleItemType() {
    const type = document.getElementById('itemType').value;
    document.getElementById('serviceField').classList.toggle('d-none', type !== 'service');
    document.getElementById('partField').classList.toggle('d-none', type !== 'part');
    document.querySelector('[name="service_id"]').disabled = (type !== 'service');
    document.querySelector('[name="part_id"]').disabled = (type !== 'part');
}
toggleItemType();
</script>
@endsection