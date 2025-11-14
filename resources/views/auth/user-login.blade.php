<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(config('app.env') === 'production' || config('app.env') === 'staging')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <title>Login User - SMK Negeri 4 Kota Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/school-bg.jpg.png') }}') center/cover no-repeat fixed;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            background: rgba(168, 197, 230, 0.85);
            backdrop-filter: blur(10px);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: 0;
        }
        
        .login-header > * {
            position: relative;
            z-index: 1;
        }
        .login-body {
            padding: 40px;
        }
        .form-control:focus {
            border-color: #a8c5e6;
            box-shadow: 0 0 0 0.2rem rgba(168, 197, 230, 0.25);
        }
        .btn-login {
            background: #a8c5e6;
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            background: #8fb3d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(168, 197, 230, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card mx-auto">
            <div class="login-header">
                <img src="{{ asset('images/smk-logo.png') }}" alt="Logo" width="80" class="mb-3">
                <h3 class="mb-0">Login User</h3>
                <p class="mb-0 small">SMK Negeri 4 Kota Bogor</p>
            </div>
            <div class="login-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>

                    <div class="text-center">
                        <p class="mb-2">Belum punya akun? <a href="{{ route('user.register.form') }}" class="text-decoration-none">Daftar di sini</a></p>
                        <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
