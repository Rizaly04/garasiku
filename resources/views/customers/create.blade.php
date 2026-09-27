@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<h2 class="mb-4">Tambah Pelanggan</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection