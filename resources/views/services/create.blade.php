@extends('layouts.app')

@section('title', 'Tambah Jasa')

@section('content')
<h2 class="mb-4">Tambah Jasa Servis</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Jasa</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection