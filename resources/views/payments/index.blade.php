@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<h2 class="mb-4"><i class="bi bi-cash-coin me-2"></i>Semua Pembayaran</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Order</th><th>Pelanggan</th><th>Tanggal</th><th>Metode</th><th>Jumlah</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('service-orders.show', $payment->service_order_id) }}">#{{ $payment->service_order_id }}</a></td>
                    <td>{{ $payment->serviceOrder->customer->name }}</td>
                    <td>{{ $payment->paid_at }}</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="text-end">
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data pembayaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada data pembayaran.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $payments->links() }}
    </div>
</div>
@endsection