<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Absensi Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-6">
        <div class="text-center mb-10">
            <div class="bg-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0020 13c0-2.254-.74-4.33-1.99-6.01M15 7a3 3 0 11-6 0 3 3 0 016 0zm-3 8c1.333 0 4-1 4-3V7c0-2-2.667-3-4-3S8 5 8 7v5c0 2 2.667 3 4 3z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Selamat Datang</h1>
            <p class="text-slate-500 text-sm">Silakan login untuk mengelola absensi</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
            <form action="{{ route('login') }}" method="POST">
                
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <input type="text" name="username" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400" 
                        placeholder="Masukkan username" required autofocus>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder:text-slate-400" 
                        placeholder="••••••••" required>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-blue-200 flex items-center justify-center">
                    Masuk ke Sistem
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-slate-400 text-xs">
            &copy; 2026 E-Absensi Digital. All rights reserved.
        </p>
    </div>

</body>
</html>