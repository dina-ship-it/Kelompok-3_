<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIP3D - Sistem Informasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      background: url('{{ asset('images/politala.jpg') }}') center/cover no-repeat fixed;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #1e3a8a;
      position: relative;
      overflow: hidden;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(0.5px);
      z-index: 1;
    }

    .glow {
      position: absolute;
      width: 900px;
      height: 900px;
      background: radial-gradient(circle, rgba(99,102,241,0.3), transparent 70%);
      top: -150px;
      left: -200px;
      animation: moveGlow 12s ease-in-out infinite alternate;
      filter: blur(120px);
      z-index: 0;
    }

    @keyframes moveGlow {
      0% { transform: translate(0, 0) scale(1); }
      100% { transform: translate(80px, 60px) scale(1.2); }
    }

    .header-top-left {
      position: fixed;
      top: 20px;
      left: 25px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 12px;
      z-index: 10;
    }

    .logo-row {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .logo {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      object-fit: contain;
      filter: drop-shadow(0 0 8px rgba(0,0,0,0.25));
    }

    .logo-ti,
    .logo-sip3d {
      width: 75px;
      height: 75px;
    }

    .container-main {
      position: relative;
      z-index: 2;
      text-align: center;
      animation: fadeIn 1.5s ease forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .title {
      font-size: 4rem;
      font-weight: 700;
      background: linear-gradient(90deg, #2563eb, #4f46e5, #06b6d4);
      background-size: 200%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: shimmer 6s ease-in-out infinite;
      text-shadow: 0 0 25px rgba(79,70,229,0.4);
      margin-bottom: 10px;
    }

    @keyframes shimmer {
      0% { background-position: 0%; }
      100% { background-position: 200%; }
    }

    .desc {
      font-size: 1.25rem;
      font-weight: 500;
      margin: 20px auto 40px;
      width: 80%;
      color: #ffffff;
      text-shadow: 0 0 10px rgba(79,70,229,0.6), 0 0 25px rgba(6,182,212,0.4);
    }

    .btn-glow {
      background: linear-gradient(90deg, #2563eb, #4f46e5);
      border: none;
      padding: 14px 50px;
      border-radius: 50px;
      color: white;
      font-weight: 600;
      font-size: 1.05rem;
      box-shadow: 0 0 25px rgba(99, 102, 241, 0.4);
      transition: 0.4s ease;
    }

    .btn-glow:hover {
      transform: scale(1.08);
      box-shadow: 0 0 40px rgba(99, 102, 241, 0.6);
    }

    footer {
      position: fixed;
      bottom: 10px;
      width: 100%;
      text-align: center;
      color: white;
      font-size: 0.9rem;
      z-index: 10;
      text-shadow: 0 0 8px rgba(0,0,0,0.4);
    }

    @media (max-width: 768px) {
      .header-top-left {
        top: 10px;
        left: 10px;
      }

      .logo {
        width: 45px;
        height: 45px;
      }

      .logo-ti,
      .logo-sip3d {
        width: 60px;
        height: 60px;
      }

      .title {
        font-size: 2.5rem;
      }

      .desc {
        font-size: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="overlay"></div>
  <div class="glow"></div>

  <div class="header-top-left">
    <div class="logo-row">
      <img src="{{ asset('images/logo-politala.png') }}" alt="Logo Politala" class="logo">
      <img src="{{ asset('images/logo-ti.png') }}" alt="Logo TI" class="logo logo-ti">
      <img src="{{ asset('images/logo-sip3d.png') }}" alt="Logo SIP3D" class="logo logo-sip3d">
    </div>
  </div>

  <div class="container-main">
    <h1 class="title">SIP3D</h1>
    <p class="desc">Sistem Informasi Pengabdian Masyarakat, Penelitian, dan Prestasi Dosen</p>
    <a href="{{ route('login.pilih') }}" class="btn btn-glow">Masuk ke Sistem</a>
  </div>

  <footer>
    © 2025 SIP3D | Powered by <strong>RINODER</strong>
  </footer>
</body>
</html>
