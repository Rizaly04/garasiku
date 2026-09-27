@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card text-bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Total Pelanggan</h6>
                    <p class="fs-3 fw-bold mb-0">{{ \App\Models\Customer::count() }}</p>
                </div>
                <i class="bi bi-people-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Order Aktif</h6>
                    <p class="fs-3 fw-bold mb-0">{{ \App\Models\ServiceOrder::where('status', '!=', 'dibayar')->count() }}</p>
                </div>
                <i class="bi bi-clipboard2-pulse-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Kendaraan Terdaftar</h6>
                    <p class="fs-3 fw-bold mb-0">{{ \App\Models\Vehicle::count() }}</p>
                </div>
                <i class="bi bi-car-front-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-info">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-1">Sparepart</h6>
                    <p class="fs-3 fw-bold mb-0">{{ \App\Models\Part::count() }}</p>
                </div>
                <i class="bi bi-box-seam-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>
@endsection