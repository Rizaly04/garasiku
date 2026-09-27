@extends('layouts.app')

@section('title', 'Tambah Sparepart')

@section('content')
<h2 class="mb-4">Tambah Sparepart</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('parts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Sparepart</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection