<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #e8f0ff;
    }
    .login-container {
      max-width: 420px;
      margin: 5% auto;
      background: white;
      border-radius: 14px;
      padding: 40px 35px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .icon-admin {
      background-color: #dc2626;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 38px;
      margin: 0 auto 20px;
    }
    .btn-google {
      border: 1px solid #ddd;
      border-radius: 8px;
      font-weight: 500;
      background-color: white;
    }
    .btn-google:hover {
      background-color: #f5f5f5;
    }
    .btn-primary {
      background-color: #2563eb;
      border: none;
      border-radius: 8px;
      font-weight: 600;
    }
    .btn-primary:hover {
      background-color: #1d4ed8;
    }
    .divider {
      text-align: center;
      position: relative;
      margin: 20px 0;
    }
    .divider::before,
    .divider::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 40%;
      height: 1px;
      background: #ccc;
    }
    .divider::before { left: 0; }
    .divider::after { right: 0; }
    .divider span {
      background: white;
      padding: 0 10px;
      color: #666;
    }
  </style>
</head>
<body>

<div class="login-container text-center">
  <div class="icon-admin">
    <i class="bi bi-person-fill-lock"></i>
  </div>
  <h3 class="fw-bold">Login Admin</h3>
  <p class="text-muted mb-4">SIP3D - Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>

  <!-- Tombol Google -->
  <a href="{{ route('login.google.redirect') }}" class="btn btn-google w-100 py-2 mb-2">
    <img src="https://developers.google.com/identity/images/g-logo.png" width="20" class="me-2">
    Masuk dengan Google
  </a>

  <div class="divider"><span>atau</span></div>

  <form method="POST" action="{{ route('login.admin.post') }}">
    @csrf
    <div class="mb-3 text-start">
      <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
      <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
    </div>
    <div class="mb-3 text-start">
      <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
      <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2">Masuk sebagai Admin</button>
  </form>

  <p class="mt-3">
    <small>Lupa password? <a href="#" class="text-primary text-decoration-none">Reset di sini</a></small>
  </p>
</div>

</body>
</html>