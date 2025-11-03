<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIP3D - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; }

    body {
      background-color: #f9fafb;
    }

    /* Navbar */
    .navbar-custom {
      background-color: #4f46e5;
      padding: 10px 40px;
    }
    .navbar-custom .navbar-brand {
      color: #fff;
      font-weight: 700;
      font-size: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .navbar-custom .nav-link {
      color: #fff !important;
      font-weight: 500;
      transition: 0.3s;
    }
    .navbar-custom .nav-link:hover {
      opacity: 0.85;
    }
    .logout-link {
      color: #fff;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 5px;
      text-decoration: none;
      transition: 0.3s;
    }
    .logout-link:hover {
      opacity: 0.85;
    }

    /* Dashboard */
    .dashboard-section {
      margin-top: 40px;
    }

    .stat-box {
      background-color: #fff;
      border-radius: 10px;
      text-align: center;
      padding: 20px 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .stat-number {
      font-size: 2rem;
      font-weight: 700;
    }
    .btn-manage {
      font-weight: 600;
      color: #fff;
      border: none;
      padding: 8px 0;
      border-radius: 8px;
      width: 100%;
      text-decoration: none;
      display: inline-block;
      transition: 0.3s;
    }
    .btn-blue { background-color: #3b82f6; }
    .btn-green { background-color: #10b981; }
    .btn-gray { background-color: #6b7280; }
    .btn-yellow { background-color: #facc15; color: #1e293b; }
    .btn-red { background-color: #ef4444; }
    .btn-manage:hover { opacity: 0.9; transform: scale(1.02); }

  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="/images/logo-politala.png" alt="Logo" width="28"> SIP3D
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Mahasiswa</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Dosen</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Admin</a></li>
          <li class="nav-item ms-2">
            <a href="#" class="logout-link">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Dashboard -->
  <div class="container dashboard-section">
    <h4 class="fw-bold mb-4">Administrator Dashboard</h4>

    <!-- Baris atas -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="stat-box border-primary">
          <div class="stat-number text-primary">{{ $data['lecturers'] ?? 45 }}</div>
          <div>Total Dosen</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-box border-success">
          <div class="stat-number text-success">{{ $data['students'] ?? 1250 }}</div>
          <div>Total Mahasiswa</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-box border-warning">
          <div class="stat-number text-warning">{{ $data['research'] ?? 78 }}</div>
          <div>Total Penelitian</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="stat-box border-danger">
          <div class="stat-number text-danger">{{ $data['service'] ?? 32 }}</div>
          <div>Total Pengabdian</div>
        </div>
      </div>
    </div>

    <!-- Baris bawah -->
    <div class="row g-3">
      <div class="col-md-3">
        <div class="stat-box">
          <h6>Kelola Dosen</h6>
          <small>Tambah, edit, dan hapus data dosen</small>
          <a href="{{ route('dosen.index') }}" class="btn-manage btn-blue mt-2">Kelola</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="stat-box">
          <h6>Kelola Mahasiswa</h6>
          <small>Tambah, edit, dan hapus data mahasiswa</small>
          <a href="{{ route('mahasiswa.index') }}" class="btn-manage btn-green mt-2">Kelola</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="stat-box">
          <h6>Kelola Penelitian</h6>
          <small>Monitor dan kelola data penelitian</small>
          <a href="{{ route('penelitian.index') }}" class="btn-manage btn-gray mt-2">Kelola</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="stat-box">
          <h6>Kelola Pengabdian</h6>
          <small>Monitor dan kelola data pengabdian</small>
          <a href="{{ route('pengabdian.index') }}" class="btn-manage btn-yellow mt-2">Kelola</a>
        </div>
      </div>

      <div class="col-md-3">
        <div class="stat-box">
          <h6>Kelola Prestasi</h6>
          <small>Monitor dan kelola data prestasi</small>
          <a href="{{ route('prestasi.index') }}" class="btn-manage btn-red mt-2">Kelola</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
