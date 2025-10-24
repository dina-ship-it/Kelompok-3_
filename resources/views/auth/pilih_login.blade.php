<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pilih Login | SIP3D</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f3f4f6, #e0e7ff);
      min-height: 100vh;
      font-family: "Poppins", sans-serif;
    }
    .title {
      font-weight: 700;
      color: #1e3a8a;
      letter-spacing: 1px;
    }
    .subtitle {
      color: #475569;
      font-size: 16px;
      margin-bottom: 35px;
    }
    .card {
      border: none;
      border-radius: 18px;
      padding: 35px 25px;
      transition: all 0.3s ease;
      background-color: #fff;
    }
    .card:hover {
      transform: translateY(-7px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }
    .card i {
      margin-bottom: 12px;
    }
    .card h5 {
      font-weight: 600;
      margin-bottom: 10px;
      color: #1e293b;
    }
    .card p {
      font-size: 14px;
      color: #64748b;
      min-height: 40px; /* supaya tinggi rata antar card */
    }
    .btn {
      border-radius: 20px;
      padding: 8px 0;
      font-weight: 500;
      transition: 0.3s ease;
    }
    .btn:hover {
      transform: scale(1.05);
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
      <div class="col-md-3 col-sm-6">
        <div class="card shadow-sm">
          <i class="bi bi-person-gear text-danger fs-1"></i>
          <h5>Admin</h5>
          <p>Kelola seluruh data sistem dan pengguna</p>
          <a href="{{ route('login.admin') }}" class="btn btn-outline-danger mt-2 w-100">Login Admin</a>
        </div>
      </div>

      <!-- Dosen -->
      <div class="col-md-3 col-sm-6">
        <div class="card shadow-sm">
          <i class="bi bi-mortarboard text-primary fs-1"></i>
          <h5>Dosen</h5>
          <p>Kelola penelitian, pengabdian, dan prestasi</p>
          <a href="{{ route('login.dosen') }}" class="btn btn-outline-primary mt-2 w-100">Login Dosen</a>
        </div>
      </div>

      <!-- Mahasiswa -->
      <div class="col-md-3 col-sm-6">
        <div class="card shadow-sm">
          <i class="bi bi-book text-success fs-1"></i>
          <h5>Mahasiswa</h5>
          <p>Lihat informasi penelitian dan pengabdian</p>
          <a href="{{ route('login.mahasiswa') }}" class="btn btn-outline-success mt-2 w-100">Login Mahasiswa</a>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
