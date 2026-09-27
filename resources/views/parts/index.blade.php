@extends('layouts.app')

@section('title', 'Sparepart')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Master Sparepart</h2>
    <a href="{{ route('parts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Sparepart</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Nama</th><th>Harga</th><th>Stok</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse($parts as $part)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $part->name }}</td>
                    <td>Rp {{ number_format($part->price, 0, ',', '.') }}</td>
                    <td>
                        @if($part->stock <= 5)
                            <span class="badge bg-danger">{{ $part->stock }}</span>
                        @else
                            <span class="badge bg-success">{{ $part->stock }}</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('parts.edit', $part) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('parts.destroy', $part) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus sparepart ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data sparepart.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $parts->links() }}
    </div>
</div>
@endsection