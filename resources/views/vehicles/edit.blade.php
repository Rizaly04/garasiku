@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')
<h2 class="mb-4">Edit Kendaraan</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="customer_id" class="form-select" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $vehicle->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Plat Nomor</label>
                <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $vehicle->plate_number) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Merk</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', $vehicle->brand) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Model</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $vehicle->year) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection