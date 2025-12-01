<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>SIP3D - Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
    body { background: #f8fafc; color: #0f172a; margin: 0; }

    /* Navbar */
    .navbar-custom {
      background-color: #4f46e5;
      padding: 10px 28px;
    }
    .navbar-custom .navbar-brand {
      color:#fff;
      font-weight:700;
      display:flex;
      align-items:center;
      gap:8px;
    }
    .navbar-custom .nav-link { color:#fff !important; font-weight:500; }
    .logout-link { color:#fff; text-decoration:none; }

    /* Layout */
    .container-dashboard {
      max-width: 1200px;
      margin: 28px auto;
      padding: 0 18px 60px;
    }

    h4.section-title { font-weight:700; margin-bottom: 6px; }

    /* KPI boxes */
    .stat-box {
      background:#fff;
      border-radius:12px;
      padding:18px;
      box-shadow:0 6px 18px rgba(15,23,42,0.04);
      border:1px solid rgba(15,23,42,0.03);
      text-align:center;
      height:100%;
      display:flex;
      flex-direction:column;
      justify-content:center;
    }
    .stat-number { font-size:1.9rem; font-weight:800; }
    .stat-label { color:#6b7280; margin-top:8px; }

    /* Action cards */
    .action-card {
      background:#fff;
      border-radius:12px;
      padding:20px;
      box-shadow:0 8px 24px rgba(15,23,42,0.04);
      border:1px solid rgba(15,23,42,0.03);
      height:100%;
      display:flex;
      flex-direction:column;
      justify-content:space-between;
    }
    .card-title { font-weight:700; margin-bottom:6px; }
    .card-desc { color:#6b7280; font-size:0.92rem; margin-bottom:14px; }

    .btn-manage {
      border-radius:10px;
      border:none;
      font-weight:700;
      padding:9px 22px;
      transition:.15s;
      width: fit-content;
      margin: 0 auto;
      display: block;
      text-align:center;
    }
    .btn-manage:hover { transform:translateY(-2px); opacity:.95; }

    .btn-blue { background:#3b82f6; color:#fff; }
    .btn-green { background:#10b981; color:#fff; }
    .btn-gray { background:#6b7280; color:#fff; }
    .btn-yellow { background:#facc15; color:#1e293b; }
    .btn-red { background:#ef4444; color:#fff; }
  </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/images/logo-politala.png" alt="logo" width="28"> SIP3D
    </a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Mahasiswa</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Dosen</a></li>
        <li class="nav-item ms-3">
          <a href="#" class="logout-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-dashboard">

  <h4 class="section-title">Administrator Dashboard</h4>

  <p class="text-muted mb-3">
    Selamat datang, <span class="fw-semibold text-primary">{{ ucfirst($displayNameSafe ?? 'User') }}</span> 👋
  </p>

  <!-- KPI -->
  <div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="stat-box">
        <div class="stat-number text-primary">{{ $data['lecturers'] }}</div>
        <div class="stat-label">Total Dosen</div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="stat-box">
        <div class="stat-number text-success">{{ $data['students'] }}</div>
        <div class="stat-label">Total Mahasiswa</div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="stat-box">
        <div class="stat-number text-warning">{{ $data['research'] }}</div>
        <div class="stat-label">Total Penelitian</div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="stat-box">
        <div class="stat-number text-danger">{{ $data['service'] }}</div>
        <div class="stat-label">Total Pengabdian</div>
      </div>
    </div>
  </div>

  <!-- Action Cards -->
  <div class="row g-3">

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="action-card">
        <div>
          <div class="card-title">Kelola Dosen</div>
          <div class="card-desc">Tambah, edit, dan hapus data dosen.</div>
        </div>
        <a href="{{ route('dosen.index') }}" class="btn-manage btn-blue">Kelola</a>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="action-card">
        <div>
          <div class="card-title">Kelola Mahasiswa</div>
          <div class="card-desc">Tambah, edit, dan hapus data mahasiswa.</div>
        </div>
        <a href="{{ route('mahasiswa.index') }}" class="btn-manage btn-green">Kelola</a>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="action-card">
        <div>
          <div class="card-title">Kelola Penelitian</div>
          <div class="card-desc">Monitor dan kelola data penelitian.</div>
        </div>
        <a href="{{ route('penelitian.index') }}" class="btn-manage btn-gray">Kelola</a>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="action-card">
        <div>
          <div class="card-title">Kelola Pengabdian</div>
          <div class="card-desc">Monitor data pengabdian.</div>
        </div>
        <a href="{{ route('pengabdian.index') }}" class="btn-manage btn-yellow">Kelola</a>
      </div>
    </div>

    <!-- FINAL TPK -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="action-card">
        <div>
          <div class="card-title">TPK</div>
          <div class="card-desc">Mengelola data TPK.</div>
        </div>
        <a href="{{ route('prestasi.index') }}" class="btn-manage btn-red">Kelola</a>
      </div>
    </div>

  </div>
</div>

</body>
</html>
