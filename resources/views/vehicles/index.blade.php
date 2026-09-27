@extends('layouts.app')

@section('title', 'Kendaraan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Kendaraan</h2>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Kendaraan</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plat Nomor</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Tahun</th>
                    <th>Pemilik</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $vehicle)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->year ?? '-' }}</td>
                    <td>{{ $vehicle->customer->name }}</td>
                    <td class="text-end">
                        <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus kendaraan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada data kendaraan.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $vehicles->links() }}
    </div>
</div>
@endsection