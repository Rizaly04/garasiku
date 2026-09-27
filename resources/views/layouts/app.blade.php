<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - GARASIKU</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.min.css') }}">
    @stack('styles')
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🔧 GARASIKU</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      @auth
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('customers.index') }}"><i class="bi bi-people-fill me-1"></i>Pelanggan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('vehicles.index') }}"><i class="bi bi-car-front-fill me-1"></i>Kendaraan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('service-orders.index') }}"><i class="bi bi-clipboard2-check-fill me-1"></i>Order Servis</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}"><i class="bi bi-tools me-1"></i>Jasa</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('parts.index') }}"><i class="bi bi-box-seam-fill me-1"></i>Sparepart</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}"><i class="bi bi-cash-coin me-1"></i>Pembayaran</a></li>
        @if(in_array(auth()->user()->role, ['admin', 'owner']))
        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><i class="bi bi-person-badge-fill me-1"></i>Pengguna</a></li>
        @endif
      </ul>

      <ul class="navbar-nav align-items-lg-center">
        <li class="nav-item text-light me-lg-3 mb-2 mb-lg-0">
          <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
          <span class="badge bg-secondary ms-1">{{ ucfirst(auth()->user()->role) }}</span>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
          </form>
        </li>
      </ul>
      @endauth
    </div>
  </div>
</nav>

<div class="container mt-4 mb-5">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle-fill me-1"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @yield('content')
</div>

<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
</body>
</html>