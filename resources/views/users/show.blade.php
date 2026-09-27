@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<h2 class="mb-4">Detail Pengguna</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Nama</th><td>{{ $user->name }}</td></tr>
            <tr><th>Email</th><td>{{ $user->email }}</td></tr>
            <tr><th>Role</th><td><span class="badge bg-secondary">{{ ucfirst($user->role) }}</span></td></tr>
        </table>
    </div>
</div>

<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection