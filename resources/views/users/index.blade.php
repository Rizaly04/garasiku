@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manajemen Pengguna</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Pengguna</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($user->role) }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection