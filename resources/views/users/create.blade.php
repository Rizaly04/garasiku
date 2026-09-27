@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<h2 class="mb-4">Tambah Pengguna</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin/Kasir</option>
                    <option value="mekanik" {{ old('role') == 'mekanik' ? 'selected' : '' }}>Mekanik</option>
                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection