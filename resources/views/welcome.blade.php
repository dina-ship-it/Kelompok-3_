<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP3D - Sistem Informasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eaf0ff; /* warna lembut biru muda */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .title {
            font-weight: 700;
            color: #1e2a5a;
        }
        .desc {
            color: #444;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="title mb-3">SIP3D</h1>
        <p class="desc">Sistem Informasi Pengabdian, Penelitian, dan Prestasi Dosen</p>
        <a href="{{ route('login.pilih') }}" class="btn btn-primary">Masuk ke Sistem</a>
    </div>
</body>
</html>
