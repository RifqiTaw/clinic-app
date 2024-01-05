@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div id="content">
  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
          <img class="img-profile rounded-circle" src="{{ asset('img/user.gif') }}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->
  
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
        Selamat Datang, {{ Auth::user()->name }}!
      </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Jumlah Dokter</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dokter }}</div>
              </div>
              <div class="col-auto">
                <i class="fa-solid fa-stethoscope fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Jumlah Pasien
                </div>
                @if (Auth::user()->role == 'dokter' && $perjanjians->count())
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $perjanjians->count() }}
                </div>
                @elseif (Auth::user()->role == 'admin')
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $pasien }}
                </div>
                @else
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  {{ $pasien }}
                </div>
                @endif
              </div>
              <div class="col-auto">
                <!-- <i class="fas fa-dollar-sign fa-2x text-black-300"></i> -->
                <i class="fa-solid fa-bed-pulse fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Jenis Obat</div>
                <div class="row align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 font-weight-bold text-black-800">
                      {{ $obat }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <!-- <i class="fas fa-2x fa-prescription-bottle-alt"></i> -->
                <i class="fa-solid fa-syringe fa-2x text-black-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          @if (Auth::user()->role == 'dokter' && $perjanjians->count())
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Perjanjian Dengan Pasien</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi Dokter</th>
                    <th>Waktu Perjanjian</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($perjanjians as $perjanjian)
                  <tr>
                    <td>{{ $perjanjian->nama_pasien }}</td>
                    <td>{{ $perjanjian->nama_dokter }}</td>
                    <td>{{ $perjanjian->spesialiasi_dokter }}</td>
                    <td>{{ $perjanjian->waktu_perjanjian }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    
  </div>

  <!-- /.container-fluid -->
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/rs1.jpg" width="1200" height="300">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Jumlah Dokter</h1>
            <p>Jumlah Dokter yang tersedia di Klinik Care</p>
            <!-- <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p> -->
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/rs1.jpg" width="1200" height="300">
          <div class="carousel-caption">
            <h1>Jumlah Pasien</h1>
            <p>Jumlah Pasien adalah total pasien yang telah menggunakan klinik care</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/rs1.jpg" width="1200" height="300">
          <div class="carousel-caption text-end">
            <h1>Jenis Obat</h1>
            <p>Jenis Obat berisikan obat yang tersedia di klinik care</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse Obat</a></p>
          </div>
        </div>
      </div>
    </div>
    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button> -->
  </div>
</div>
<!-- End of Main Content -->
@endsection