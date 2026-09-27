@extends('layouts.app')

@section('title', 'Jasa Servis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Master Jasa Servis</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Jasa</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Nama Jasa</th><th>Deskripsi</th><th>Harga</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description ?? '-' }}</td>
                    <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td class="text-end">
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus jasa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data jasa.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $services->links() }}
    </div>
</div>
@endsection