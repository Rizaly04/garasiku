@extends('layouts.app')

@section('title', 'Edit Sparepart')

@section('content')
<h2 class="mb-4">Edit Sparepart</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('parts.update', $part) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Sparepart</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $part->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $part->price) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $part->stock) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection