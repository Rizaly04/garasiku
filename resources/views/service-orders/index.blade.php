@extends('layouts.app')

@section('title', 'Order Servis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Order Servis</h2>
    <a href="{{ route('service-orders.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Order Baru</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Masuk</th>
                    <th>Pelanggan</th>
                    <th>Kendaraan</th>
                    <th>Mekanik</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($serviceOrders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->check_in_date }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->vehicle->plate_number }}</td>
                    <td>{{ $order->mechanic->name ?? '-' }}</td>
                    <td>
                        @php
                            $badge = match($order->status) {
                                'check_in' => 'secondary',
                                'dikerjakan' => 'warning',
                                'selesai' => 'info',
                                'dibayar' => 'success',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ ucfirst(str_replace('_',' ', $order->status)) }}</span>
                    </td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="text-end">
                        <a href="{{ route('service-orders.show', $order) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye-fill"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted">Belum ada order servis.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $serviceOrders->links() }}
    </div>
</div>
@endsection