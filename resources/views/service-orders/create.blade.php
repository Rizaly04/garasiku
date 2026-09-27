@extends('layouts.app')

@section('title', 'Order Servis Baru')

@section('content')
<h2 class="mb-4">Buat Order Servis Baru</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('service-orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="customer_id" class="form-select" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kendaraan</label>
                <select name="vehicle_id" class="form-select" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->plate_number }} - {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->customer->name }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mekanik (opsional)</label>
                <select name="mechanic_id" class="form-select">
                    <option value="">-- Belum Ditentukan --</option>
                    @foreach($mechanics as $mechanic)
                        <option value="{{ $mechanic->id }}" {{ old('mechanic_id') == $mechanic->id ? 'selected' : '' }}>{{ $mechanic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Check-in</label>
                <input type="date" name="check_in_date" class="form-control" value="{{ old('check_in_date', date('Y-m-d')) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Buat Order</button>
            <a href="{{ route('service-orders.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection