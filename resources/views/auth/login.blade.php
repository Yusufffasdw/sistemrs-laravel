<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Healty-ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: sans-serif; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 40px; width: 100%; max-width: 400px; }
        .logo { text-align: center; margin-bottom: 30px; }
        .logo h1 { font-size: 28px; font-weight: 700; color: #2563eb; margin: 0; }
        .input-group-text { cursor: pointer; background: white; border-left: none; }
        .form-control:focus { border-color: #dee2e6; box-shadow: none; }
        .password-input { border-right: none; }
    </style>
</head>
<body>
    
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <h1>🏥 HEALTY-ID</h1>
                <p class="text-muted small">Sistem Informasi Rumah Sakit</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger small py-2">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control password-input" placeholder="Masukkan password" required>
                        <span class="input-group-text" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eye-icon"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label small" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Login</button>
            </form>

            <hr class="my-4">

            <div class="text-center">
                <a href="{{ route('beranda') }}" class="text-decoration-none small text-muted">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            const icon = document.getElementById("eye-icon");
            if (pass.type === "password") {
                pass.type = "text";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                pass.type = "password";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            }
        }
    </script>
</body>
</html>