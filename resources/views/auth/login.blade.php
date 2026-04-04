<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Poliklinik Sejahtera</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-600 to-blue-900 min-h-screen flex items-center justify-center" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="w-full max-w-md px-4">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            <div class="bg-blue-700 px-8 py-8 text-center">
                <div class="bg-white bg-opacity-20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-hospital text-white text-4xl"></i>
                </div>
                <h1 class="text-white text-2xl font-bold">Poliklinik Sejahtera</h1>
                <p class="text-blue-200 text-sm mt-1">Sistem Informasi Poliklinik</p>
            </div>

            <div class="px-8 py-8">
                <h2 class="text-gray-700 text-xl font-bold mb-6 text-center">Masuk ke Sistem</h2>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-300 text-red-600 px-4 py-3 rounded-lg mb-4 flex items-center gap-2 text-sm">
                        <i class="fa fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            <i class="fa fa-envelope mr-1 text-blue-500"></i>Email
                        </label>
                        <input type="email" name="email" placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            class="border border-gray-300 rounded-lg w-full px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            <i class="fa fa-lock mr-1 text-blue-500"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Masukkan password"
                                class="border border-gray-300 rounded-lg w-full px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm pr-12">
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="fa fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white w-full py-3 rounded-lg font-semibold transition text-sm">
                        <i class="fa fa-right-to-bracket mr-2"></i>Masuk
                    </button>
                </form>
            </div>

            <div class="bg-gray-50 px-8 py-4 text-center text-xs text-gray-400 border-t">
                &copy; 2026 Poliklinik Sejahtera. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
