@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<h2 class="mb-4">Detail Pembayaran</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Order</th><td><a href="{{ route('service-orders.show', $payment->service_order_id) }}">#{{ $payment->service_order_id }}</a></td></tr>
            <tr><th>Tanggal</th><td>{{ $payment->paid_at }}</td></tr>
            <tr><th>Metode</th><td>{{ ucfirst($payment->payment_method) }}</td></tr>
            <tr><th>Jumlah</th><td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td></tr>
        </table>
    </div>
</div>

<a href="{{ route('payments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection