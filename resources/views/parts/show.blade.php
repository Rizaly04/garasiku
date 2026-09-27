@extends('layouts.app')

@section('title', 'Detail Sparepart')

@section('content')
<h2 class="mb-4">Detail Sparepart</h2>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr><th width="180">Nama</th><td>{{ $part->name }}</td></tr>
            <tr><th>Harga</th><td>Rp {{ number_format($part->price, 0, ',', '.') }}</td></tr>
            <tr><th>Stok</th><td>{{ $part->stock }}</td></tr>
        </table>
    </div>
</div>

<a href="{{ route('parts.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection