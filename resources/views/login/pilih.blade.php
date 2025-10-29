<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIP3D | Select Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #e0e7ff 0%, #f5f3ff 40%, #f0f9ff 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
    }

    /* Animasi gradient lembut */
    .gradient-bg {
      position: absolute;
      width: 150%;
      height: 150%;
      background: radial-gradient(circle at 20% 30%, #a5b4fc 0%, transparent 70%),
                  radial-gradient(circle at 80% 80%, #93c5fd 0%, transparent 70%),
                  radial-gradient(circle at 50% 60%, #c7d2fe 0%, transparent 60%);
      filter: blur(120px);
      animation: moveBg 12s ease-in-out infinite alternate;
    }

    @keyframes moveBg {
      0% { transform: translate(0, 0); }
      100% { transform: translate(-40px, 40px); }
    }

    .container-login {
      position: relative;
      z-index: 2;
      text-align: center;
      color: #1e3a8a;
      animation: fadeIn 1.5s ease forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      font-weight: 700;
      font-size: 2.8rem;
      background: linear-gradient(90deg, #6366f1, #60a5fa, #818cf8);
      -webkit-background-clip: text;
      color: transparent;
      animation: shimmer 3s ease-in-out infinite alternate;
    }

    @keyframes shimmer {
      0% { letter-spacing: 1px; opacity: 0.9; }
      100% { letter-spacing: 3px; opacity: 1; }
    }

    p {
      color: #64748b;
      margin-bottom: 50px;
      font-size: 1.05rem;
      animation: fadeIn 2s ease forwards;
    }

    .card-group {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }

    .card-login {
      width: 270px;
      padding: 35px 25px;
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(12px);
      box-shadow: 0 10px 30px rgba(99, 102, 241, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.4);
      animation: fadeUp 1.5s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-login:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 15px 35px rgba(99, 102, 241, 0.25);
    }

    .card-login i {
      font-size: 40px;
      margin-bottom: 15px;
    }

    .card-login h4 {
      font-weight: 600;
      color: #1e3a8a;
      margin-bottom: 8px;
    }

    .card-login p {
      font-size: 0.9rem;
      color: #6b7280;
      margin-bottom: 20px;
    }

    .btn-login {
      border-radius: 30px;
      padding: 10px 25px;
      font-weight: 600;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-admin {
      background: #f87171;
      color: white;
    }

    .btn-admin:hover {
      background: #ef4444;
      box-shadow: 0 0 20px rgba(239, 68, 68, 0.4);
    }

    .btn-lecturer {
      background: #60a5fa;
      color: white;
    }

    .btn-lecturer:hover {
      background: #3b82f6;
      box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
    }

    .btn-student {
      background: #34d399;
      color: white;
    }

    .btn-student:hover {
      background: #10b981;
      box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
    }

    footer {
      position: absolute;
      bottom: 15px;
      left: 0;
      right: 0;
      text-align: center;
      font-size: 14px;
      color: #64748b;
      animation: fadeIn 3s ease;
    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="gradient-bg"></div>

  <div class="container-login">
    <h1>SIP3D</h1>
    <p>Information System for Lecturer Community Service, Research, and Achievements</p>
    
    <div class="card-group">
      <div class="card-login">
        <i class="fas fa-user-cog" style="color:#ef4444;"></i>
        <h4>Admin</h4>
        <p>Manage all system and user data</p>
        <a href="{{ route('login.admin') }}" class="btn btn-login btn-admin">Admin Login</a>
      </div>

      <div class="card-login">
        <i class="fas fa-graduation-cap" style="color:#3b82f6;"></i>
        <h4>Lecturer</h4>
        <p>Manage research, service, and achievements</p>
        <a href="{{ route('login.dosen') }}" class="btn btn-login btn-lecturer">Lecturer Login</a>
      </div>

      <div class="card-login">
        <i class="fas fa-book-open" style="color:#10b981;"></i>
        <h4>Student</h4>
        <p>View research and community service information</p>
        <a href="{{ route('login.mahasiswa') }}" class="btn btn-login btn-student">Student Login</a>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2025 SIP3D | Sistem Informasi Dosen | Politala
  </footer>
</body>
</html>
