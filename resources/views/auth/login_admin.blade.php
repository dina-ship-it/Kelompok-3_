<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin | SIP3D</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e0f2fe, #dbeafe);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Poppins", sans-serif;
    }

    .login-container {
      background: #fff;
      width: 400px;
      padding: 40px 35px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
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
      box-shadow: 0 4px 10px rgba(220, 38, 38, 0.4);
    }

    h3 {
      font-weight: 700;
      color: #1e3a8a;
    }

    .subtitle {
      color: #64748b;
      font-size: 14px;
      margin-bottom: 25px;
    }

    .btn-google {
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: white;
      transition: all 0.3s;
      font-weight: 500;
    }

    .btn-google:hover {
      background-color: #f8fafc;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .btn-primary {
      background-color: #2563eb;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
      transform: translateY(-2px);
    }

    .divider {
      position: relative;
      text-align: center;
      margin: 20px 0;
      color: #94a3b8;
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
    }

    .footer {
      margin-top: 25px;
      font-size: 0.85rem;
      color: #6b7280;
    }

    .footer a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 500;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="icon-admin">
    <i class="bi bi-person-fill-lock"></i>
  </div>
  <h3>Login Admin</h3>
  <p class="subtitle">SIP3D — Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>

  <!-- Tombol Login dengan Google -->
  <a href="{{ route('login.google.redirect') }}" class="btn btn-google w-100 py-2 mb-3">
    <img src="https://developers.google.com/identity/images/g-logo.png" width="20" class="me-2">
    Masuk dengan Google
  </a>

  <div class="divider"><span>atau</span></div>

  <!-- Form Login Manual -->
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

  <div class="footer mt-3">
    <small>Lupa password? <a href="#">Reset di sini</a></small>
  </div>
</div>

</body>
</html>
