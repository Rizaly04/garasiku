@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<h2 class="mb-4">Edit Pelanggan</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('customers.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $customer->address) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection