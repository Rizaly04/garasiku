@extends('layouts.app')

@section('title', 'Detail Kendaraan')

@section('content')
<h2 class="mb-4">Detail Kendaraan</h2>

<div class="card mb-3">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Plat Nomor</th><td>{{ $vehicle->plate_number }}</td></tr>
            <tr><th>Merk / Model</th><td>{{ $vehicle->brand }} {{ $vehicle->model }}</td></tr>
            <tr><th>Tahun</th><td>{{ $vehicle->year ?? '-' }}</td></tr>
            <tr><th>Pemilik</th><td>{{ $vehicle->customer->name }}</td></tr>
        </table>
    </div>
</div>

<h5>Riwayat Servis</h5>
<div class="card">
    <div class="card-body">
        <table class="table table-sm">
            <thead><tr><th>Tanggal Masuk</th><th>Status</th><th>Total</th></tr></thead>
            <tbody>
                @forelse($vehicle->serviceOrders as $order)
                <tr>
                    <td>{{ $order->check_in_date }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span></td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-muted text-center">Belum ada riwayat servis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<a href="{{ route('vehicles.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection