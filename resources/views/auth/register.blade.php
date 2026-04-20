<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Healty-ID</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Decorations -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl float-animation"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl float-animation" style="animation-delay: 2s"></div>
    
    <div class="w-full max-w-md relative z-10">
        
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-2xl mb-4">
                <i data-lucide="hospital" class="w-10 h-10 text-blue-600"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">HEALTY-ID</h1>
            <p class="text-white/80 text-sm">Sistem Informasi Rumah Sakit</p>
        </div>

        <!-- Register Card -->
        <div class="glass-card rounded-3xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Akun Baru</h2>
            <p class="text-gray-500 text-sm mb-6">Lengkapi data untuk membuat akun</p>

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-start gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                    <div class="text-sm">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            class="input-field w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-300 @enderror"
                            placeholder="Dr. John Doe"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="input-field w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-300 @enderror"
                            placeholder="dokter@healty-id.com"
                            required
                        >
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            class="input-field w-full pl-12 pr-12 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-300 @enderror"
                            placeholder="Minimal 8 karakter"
                            required
                        >
                        <button 
                            type="button"
                            onclick="togglePassword('password', 'eye-icon-1')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600"
                        >
                            <i data-lucide="eye" id="eye-icon-1" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            class="input-field w-full pl-12 pr-12 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Ulangi password"
                            required
                        >
                        <button 
                            type="button"
                            onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600"
                        >
                            <i data-lucide="eye" id="eye-icon-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 flex items-center justify-center gap-2 group"
                >
                    <span>Daftar Sekarang</span>
                    <i data-lucide="user-plus" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Login di sini</a>
                </p>
            </div>
        </div>

    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Toggle Password Visibility
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            
            lucide.createIcons();
        }
    </script>

</body>
</html>
