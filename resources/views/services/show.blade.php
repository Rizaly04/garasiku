@extends('layouts.app')

@section('title', 'Detail Jasa')

@section('content')
<h2 class="mb-4">Detail Jasa Servis</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Nama</th><td>{{ $service->name }}</td></tr>
            <tr><th>Deskripsi</th><td>{{ $service->description ?? '-' }}</td></tr>
            <tr><th>Harga</th><td>Rp {{ number_format($service->price, 0, ',', '.') }}</td></tr>
        </table>
    </div>
</div>

<a href="{{ route('services.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection