<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIP3D - Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { font-family: 'Poppins', sans-serif; }

    body {
      background-color: #f4f6fb;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    /* Navbar */
    nav {
      background: linear-gradient(90deg, #3b82f6, #6366f1);
      color: white;
      padding: 15px 30px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav .brand {
      font-weight: 700;
      font-size: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    nav ul li a:hover { opacity: 0.85; }

    /* Container */
    .container {
      margin-top: 50px;
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-title {
      font-weight: 700;
      color: #1e3a8a;
      margin-bottom: 25px;
      text-align: center;
    }

    /* Card utama */
    .stat-card {
      border: none;
      border-radius: 15px;
      background: white;
      box-shadow: 0 6px 20px rgba(0,0,0,0.05);
      transition: 0.3s;
      padding: 25px;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      animation: pop 0.5s ease;
    }

    @keyframes pop {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    .stat-label {
      font-size: 1rem;
      color: #64748b;
    }

    /* Tombol */
    .btn-manage {
      border: none;
      border-radius: 8px;
      padding: 10px 25px;
      font-weight: 600;
      color: white;
      transition: 0.3s;
      margin-top: 15px;
    }

    .btn-blue { background: #3b82f6; }
    .btn-yellow { background: #facc15; color: #1e293b; }
    .btn-red { background: #ef4444; }
    .btn-gray { background: #475569; }

    .btn-manage:hover {
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 25px 0;
      color: #64748b;
      font-size: 14px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <div class="brand">
      <img src="/images/logo-politala.png" alt="Logo" style="width:35px;">
      SIP3D Admin Panel
    </div>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Lecturer</a></li>
      <li><a href="#">Student</a></li>
      <li><a href="#">Admin</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </nav>

  <div class="container">
    <h2 class="dashboard-title">Admin Dashboard</h2>

    <div class="row g-4">
      <!-- Statistik dinamis -->
      <div class="col-md-4">
        <div class="stat-card text-center border-top border-primary">
          <div class="stat-number text-primary">{{ $data['lecturers'] }}</div>
          <div class="stat-label">Total Lecturers</div>
          <button class="btn-manage btn-blue">Manage Lecturers</button>
        </div>
      </div>

      <div class="col-md-4">
        <div class="stat-card text-center border-top border-warning">
          <div class="stat-number text-warning">{{ $data['research'] }}</div>
          <div class="stat-label">Total Research</div>
          <button class="btn-manage btn-gray">Manage Research</button>
        </div>
      </div>

      <div class="col-md-4">
        <div class="stat-card text-center border-top border-danger">
          <div class="stat-number text-danger">{{ $data['service'] }}</div>
          <div class="stat-label">Total Devotion</div>
          <button class="btn-manage btn-yellow">Manage Devotion</button>
        </div>
      </div>

      <div class="col-md-12 mt-4">
        <div class="stat-card text-center border-top border-indigo">
          <h5 class="mb-2">Manage Achievements</h5>
          <div class="stat-number text-indigo">{{ $data['achievement'] }}</div>
          <p>Monitor and manage performance data</p>
          <button class="btn-manage btn-red">Manage Achievements</button>
        </div>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2025 SIP3D | Tanah Laut State Polytechnic
  </footer>

</body>
</html>
