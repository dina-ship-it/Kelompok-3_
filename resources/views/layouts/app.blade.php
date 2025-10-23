<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIP3D - Admin')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

    <!-- 🔵 NAVBAR -->
    <nav class="bg-indigo-600 shadow text-white">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="bg-white text-indigo-600 px-3 py-1 rounded-md font-bold shadow">
                    <i class="fa-solid fa-book"></i>
                </div>
                <h1 class="text-xl font-semibold tracking-wide">SIP3D</h1>
            </div>

            <!-- Menu -->
            <div class="flex items-center space-x-8 text-base">
                <a href="/" class="hover:underline">Home</a>
                <a href="{{ route('mahasiswa.dashboard') }}" class="hover:underline">Mahasiswa</a>
                <a href="{{ route('dosen.index') }}" class="hover:underline">Dosen</a>
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin</a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline flex items-center space-x-1">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- 📄 KONTEN -->
    <main class="flex-grow py-10 px-6">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- ⚙️ FOOTER -->
    <footer class="bg-white border-t mt-16 py-6 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} <strong>SIP3D</strong> |
        Sistem Informasi Penelitian & Pengabdian kepada Masyarakat
    </footer>

</body>
</html>
