@extends('layouts.app')

@section('title', 'Detail Order Servis')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Order Servis #{{ $serviceOrder->id }}</h2>
    <div>
        <a href="{{ route('service-orders.edit', $serviceOrder) }}" class="btn btn-warning">Edit Order</a>
        <form action="{{ route('service-orders.destroy', $serviceOrder) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus order ini? Semua item & pembayaran ikut terhapus.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus Order</button>
        </form>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Info Order</h5>
                <table class="table table-borderless mb-0">
                    <tr><th width="150">Pelanggan</th><td>{{ $serviceOrder->customer->name }}</td></tr>
                    <tr><th>Kendaraan</th><td>{{ $serviceOrder->vehicle->plate_number }} - {{ $serviceOrder->vehicle->brand }} {{ $serviceOrder->vehicle->model }}</td></tr>
                    <tr><th>Mekanik</th><td>{{ $serviceOrder->mechanic->name ?? '-' }}</td></tr>
                    <tr><th>Tanggal Masuk</th><td>{{ $serviceOrder->check_in_date }}</td></tr>
                    <tr><th>Tanggal Selesai</th><td>{{ $serviceOrder->complete_date ?? '-' }}</td></tr>
                    <tr><th>Status</th><td>
                        @php
                            $badge = match($serviceOrder->status) {
                                'check_in' => 'secondary',
                                'dikerjakan' => 'warning',
                                'selesai' => 'info',
                                'dibayar' => 'success',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ ucfirst(str_replace('_',' ', $serviceOrder->status)) }}</span>
                    </td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100 text-bg-dark">
            <div class="card-body d-flex flex-column justify-content-center text-center">
                <h6>Total Tagihan</h6>
                <h2>Rp {{ number_format($serviceOrder->total_price, 0, ',', '.') }}</h2>
                @php $totalPaid = $serviceOrder->payments->sum('amount'); @endphp
                <p class="mb-0">Sudah Dibayar: Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
                <p class="mb-0">Sisa: Rp {{ number_format(max($serviceOrder->total_price - $totalPaid, 0), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h5>Jasa & Sparepart</h5>
    <a href="{{ route('service-order-items.create', ['service_order_id' => $serviceOrder->id]) }}" class="btn btn-sm btn-primary">+ Tambah Item</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <table class="table table-sm align-middle">
            <thead><tr><th>Nama</th><th>Qty</th><th>Harga Satuan</th><th>Subtotal</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse($serviceOrder->items as $item)
                <tr>
                    <td>{{ $item->service->name ?? $item->part->name }} <span class="badge bg-light text-dark">{{ $item->service ? 'Jasa' : 'Part' }}</span></td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td class="text-end">
                        <a href="{{ route('service-order-items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('service-order-items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada jasa/part ditambahkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h5>Pembayaran</h5>
    @if($serviceOrder->status !== 'dibayar')
    <a href="{{ route('payments.create', ['service_order_id' => $serviceOrder->id]) }}" class="btn btn-sm btn-primary">+ Catat Pembayaran</a>
    @endif
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-sm">
            <thead><tr><th>Tanggal</th><th>Metode</th><th>Jumlah</th></tr></thead>
            <tbody>
                @forelse($serviceOrder->payments as $payment)
                <tr>
                    <td>{{ $payment->paid_at }}</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada pembayaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<a href="{{ route('service-orders.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection