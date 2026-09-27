@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<h2 class="mb-4">Detail Pelanggan</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Nama</th><td>{{ $customer->name }}</td></tr>
            <tr><th>Telepon</th><td>{{ $customer->phone }}</td></tr>
            <tr><th>Alamat</th><td>{{ $customer->address ?? '-' }}</td></tr>
        </table>
    </div>
</div>

<a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection