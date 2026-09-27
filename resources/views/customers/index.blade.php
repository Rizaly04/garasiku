@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pelanggan</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Pelanggan</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address ?? '-' }}</td>
                    <td class="text-end">
                        <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i></a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus pelanggan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data pelanggan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $customers->links() }}
    </div>
</div>
@endsection