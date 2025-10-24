<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pilih Login | SIP3D</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f3f4f6, #e0e7ff);
      min-height: 100vh;
    }
    .card {
      border: none;
      border-radius: 15px;
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .btn {
      border-radius: 20px;
    }
    .title {
      font-weight: 700;
      color: #1e3a8a;
    }
    .subtitle {
      color: #64748b;
      font-size: 15px;
      margin-bottom: 25px;
    }
  </style>
</head>
<body class="d-flex vh-100 justify-content-center align-items-center">

  <div class="container text-center">
    <h2 class="mb-1 title">SIP3D</h2>
    <p class="subtitle">Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>
    <p class="mb-4 text-secondary">Pilih jenis akun untuk masuk ke sistem</p>
    
    <div class="row justify-content-center g-4">
      
      <!-- Admin -->
      <div class="col-md-3">
        <div class="card shadow-sm p-4">
          <i class="bi bi-person-gear text-danger fs-1 mb-2"></i>
          <h5 class="mt-2 fw-semibold">Admin</h5>
          <p class="text-muted small">Kelola seluruh data sistem dan pengguna</p>
          <a href="{{ route('login.admin') }}" class="btn btn-outline-danger mt-2">Login Admin</a>
        </div>
      </div>

      <!-- Dosen -->
      <div class="col-md-3">
        <div class="card shadow-sm p-4">
          <i class="bi bi-mortarboard text-primary fs-1 mb-2"></i>
          <h5 class="mt-2 fw-semibold">Dosen</h5>
          <p class="text-muted small">Kelola penelitian, pengabdian, dan prestasi</p>
          <a href="{{ route('login.dosen') }}" class="btn btn-outline-primary mt-2">Login Dosen</a>
        </div>
      </div>

      <!-- Mahasiswa -->
      <div class="col-md-3">
        <div class="card shadow-sm p-4">
          <i class="bi bi-book text-success fs-1 mb-2"></i>
          <h5 class="mt-2 fw-semibold">Mahasiswa</h5>
          <p class="text-muted small">Lihat informasi penelitian dan pengabdian</p>
          <a href="{{ route('login.mahasiswa') }}" class="btn btn-outline-success mt-2">Login Mahasiswa</a>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
