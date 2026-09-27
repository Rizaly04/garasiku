@extends('layouts.app')

@section('title', 'Edit Jasa')

@section('content')
<h2 class="mb-4">Edit Jasa Servis</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Jasa</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="2">{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $service->price) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection