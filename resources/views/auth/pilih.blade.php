<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP3D | Select Login</title>
    @vite('resources/css/app.css')
    <style>
        /* Tambahan animasi & efek glowing */
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-200 via-sky-100 to-pink-100 min-h-screen flex flex-col items-center justify-center relative overflow-hidden">

    {{-- Background glowing circles --}}
    <div class="absolute w-[500px] h-[500px] bg-pink-300/40 rounded-full blur-3xl top-[-100px] left-[-150px] animate-pulse"></div>
    <div class="absolute w-[500px] h-[500px] bg-indigo-300/40 rounded-full blur-3xl bottom-[-120px] right-[-150px] animate-pulse"></div>

    {{-- Logo dan Judul --}}
    <div class="fade-in text-center mb-10">
        <img src="{{ asset('images/logo-politala.png') }}" class="w-20 h-20 mx-auto mb-4 rounded-full shadow-lg ring-4 ring-white/60" alt="Logo">
        <h1 class="text-5xl font-extrabold text-gray-800 tracking-wide drop-shadow-lg">SIP3D</h1>
        <p class="text-gray-600 mt-2 text-sm">Information System for Lecturer Community Service, Research, and Achievements</p>
    </div>

    {{-- Pilihan Login --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl w-full px-6 fade-in">

        {{-- ADMIN --}}
        <div class="glass p-8 rounded-3xl shadow-2xl text-center hover:scale-105 transition-all duration-500 hover:shadow-red-300/70">
            <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4 1.79 4 4 4zM6 20v-2a4 4 0 018 0v2" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Admin</h2>
            <p class="text-gray-500 mt-2 text-sm">Manage all system and user data</p>
            <a href="{{ route('login.admin') }}" class="inline-block mt-5 px-6 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-full shadow-md hover:shadow-xl hover:from-red-600 hover:to-pink-600 transition">Login</a>
        </div>

        {{-- LECTURER --}}
        <div class="glass p-8 rounded-3xl shadow-2xl text-center hover:scale-105 transition-all duration-500 hover:shadow-blue-300/70">
            <div class="bg-blue-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14v7m0 0l-3-3m3 3l3-3" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Lecturer</h2>
            <p class="text-gray-500 mt-2 text-sm">Manage research, service, and achievements</p>
            <a href="{{ route('login.dosen') }}" class="inline-block mt-5 px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-full shadow-md hover:shadow-xl hover:from-blue-600 hover:to-indigo-600 transition">Login</a>
        </div>

        {{-- STUDENT --}}
        <div class="glass p-8 rounded-3xl shadow-2xl text-center hover:scale-105 transition-all duration-500 hover:shadow-green-300/70">
            <div class="bg-green-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5zM12 4v16" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Student</h2>
            <p class="text-gray-500 mt-2 text-sm">View research and community service information</p>
            <a href="{{ route('login.mahasiswa') }}" class="inline-block mt-5 px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full shadow-md hover:shadow-xl hover:from-green-600 hover:to-emerald-600 transition">Login</a>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="mt-14 text-gray-500 text-sm fade-in">
        &copy; {{ date('Y') }} Politeknik Negeri Tanah Laut. All rights reserved.
    </footer>

</body>
</html>
