@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
<h2 class="mb-4">Tambah Kendaraan</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('vehicles.store') }}" method="POST">
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
                <label class="form-label">Plat Nomor</label>
                <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Merk</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Model</label>
                <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ old('year') }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection