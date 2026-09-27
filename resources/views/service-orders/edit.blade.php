@extends('layouts.app')

@section('title', 'Edit Order Servis')

@section('content')
<h2 class="mb-4">Edit Order Servis #{{ $serviceOrder->id }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('service-orders.update', $serviceOrder) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="customer_id" class="form-select" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $serviceOrder->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kendaraan</label>
                <select name="vehicle_id" class="form-select" required>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $serviceOrder->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->plate_number }} - {{ $vehicle->brand }} {{ $vehicle->model }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Mekanik</label>
                <select name="mechanic_id" class="form-select">
                    <option value="">-- Belum Ditentukan --</option>
                    @foreach($mechanics as $mechanic)
                        <option value="{{ $mechanic->id }}" {{ old('mechanic_id', $serviceOrder->mechanic_id) == $mechanic->id ? 'selected' : '' }}>{{ $mechanic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach(['check_in' => 'Check-in', 'dikerjakan' => 'Dikerjakan', 'selesai' => 'Selesai', 'dibayar' => 'Dibayar'] as $value => $label)
                        <option value="{{ $value }}" {{ old('status', $serviceOrder->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Check-in</label>
                <input type="date" name="check_in_date" class="form-control" value="{{ old('check_in_date', $serviceOrder->check_in_date) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="complete_date" class="form-control" value="{{ old('complete_date', $serviceOrder->complete_date) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('service-orders.show', $serviceOrder) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection