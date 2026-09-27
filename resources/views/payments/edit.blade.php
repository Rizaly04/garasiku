@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<h2 class="mb-4">Edit Pembayaran</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Jumlah Bayar (Rp)</label>
                <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-select" required>
                    @foreach(['cash' => 'Cash', 'transfer' => 'Transfer', 'qris' => 'QRIS', 'debit' => 'Kartu Debit'] as $value => $label)
                        <option value="{{ $value }}" {{ old('payment_method', $payment->payment_method) == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection