<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Web Galeri Sekolah</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><path d='M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z' fill='%231e40af'/><rect x='15' y='15' width='70' height='12' fill='%23dc2626'/><text x='50' y='24' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='8' font-weight='bold'>SMK NEGERI 4</text><rect x='35' y='30' width='30' height='8' fill='%23dc2626'/><rect x='40' y='38' width='20' height='4' fill='%23dc2626'/><rect x='45' y='42' width='10' height='8' fill='%23dc2626'/><path d='M25 35 L35 35 L30 45 Z' fill='%23dc2626'/><path d='M65 35 L75 35 L70 45 Z' fill='%23dc2626'/><rect x='70' y='38' width='8' height='4' fill='%231f2937'/><circle cx='50' cy='60' r='12' fill='%23f97316'/><circle cx='50' cy='60' r='8' fill='%231e40af'/><circle cx='50' cy='60' r='4' fill='%23f97316'/><rect x='38' y='48' width='4' height='6' fill='%23f97316'/><rect x='58' y='48' width='4' height='6' fill='%23f97316'/><rect x='48' y='38' width='4' height='6' fill='%23f97316'/><rect x='48' y='56' width='4' height='6' fill='%23f97316'/><path d='M40 70 L60 70 L60 80 L40 80 Z' fill='white' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='72' x2='55' y2='72' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='75' x2='55' y2='75' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='78' x2='55' y2='78' stroke='%231e40af' stroke-width='0.5'/><text x='50' y='90' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='6' font-weight='bold'>KOTA BOGOR</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8e7ff 0%, #e0f2fe 50%, #f0fdf4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(248, 231, 255, 0.6) 0%, transparent 60%),
                radial-gradient(circle at 80% 20%, rgba(224, 242, 254, 0.6) 0%, transparent 60%),
                radial-gradient(circle at 40% 40%, rgba(240, 253, 244, 0.4) 0%, transparent 60%);
            z-index: -1;
        }
        
        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        }
        
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #6b7280;
            cursor: pointer;
            transition: color 0.3s ease;
            display: none;
        }
        
        .back-btn:hover {
            color: #374151;
        }
        
        .back-btn.show {
            display: block;
        }
        
        .auth-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1f2937;
            text-align: center;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }
        
        .auth-subtitle {
            color: #6b7280;
            text-align: center;
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        
        .auth-switch {
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        .auth-switch a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .auth-switch a:hover {
            text-decoration: underline;
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        
        .form-hidden {
            display: none;
        }
        
        .form-visible {
            display: block;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .smk-logo {
            width: 80px;
            height: auto;
            margin: 0 auto 1rem;
            display: block;
        }
        
        .school-name {
            color: #1f2937;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        @media (max-width: 480px) {
            .auth-container {
                padding: 2rem;
                margin: 10px;
            }
            
            .auth-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <button class="back-btn" id="backBtn" onclick="showLogin()">
            <i class="fas fa-arrow-left"></i>
        </button>
        
        <div class="logo-container">
            <img src="{{ asset('images/smk-logo.png') }}" alt="SMK NEGERI 4 KOTA BOGOR" class="smk-logo">
            <div class="school-name">SMK NEGERI 4 KOTA BOGOR</div>
        </div>
        
        <!-- Login Form -->
        <div id="loginForm" class="form-visible">
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Sign in to your account</p>
        
        @if(session('error'))
                <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
                <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Email</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       id="username" name="username" value="{{ old('username', 'Admin') }}" 
                           placeholder="Enter your email" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
                <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" value="{{ old('password', '123') }}" 
                           placeholder="Enter your password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-primary">
                    Log in
                </button>
            </form>
            
            <div class="forgot-password">
                <a href="#" onclick="alert('Contact administrator for password reset')">Forgot Password?</a>
            </div>
            
            <div class="auth-switch">
                Don't have an account? <a href="#" onclick="showRegister()">Sign in</a>
            </div>
        </div>
        
        <!-- Register Form -->
        <div id="registerForm" class="form-hidden">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Sign up for a new account</p>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="fullname" class="form-label">Full name</label>
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" 
                           id="fullname" name="fullname" value="{{ old('fullname') }}" 
                           placeholder="Enter your full name" required>
                    @error('fullname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="reg_email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="reg_email" name="email" value="{{ old('email') }}" 
                           placeholder="Enter your email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="reg_password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="reg_password" name="password" 
                           placeholder="Create a password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-primary">
                    Sign up
            </button>
        </form>
        
            <div class="auth-switch">
                Already have an account? <a href="#" onclick="showLogin()">Log in</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showLogin() {
            document.getElementById('loginForm').classList.remove('form-hidden');
            document.getElementById('loginForm').classList.add('form-visible');
            document.getElementById('registerForm').classList.remove('form-visible');
            document.getElementById('registerForm').classList.add('form-hidden');
            document.getElementById('backBtn').classList.remove('show');
        }
        
        function showRegister() {
            document.getElementById('registerForm').classList.remove('form-hidden');
            document.getElementById('registerForm').classList.add('form-visible');
            document.getElementById('loginForm').classList.remove('form-visible');
            document.getElementById('loginForm').classList.add('form-hidden');
            document.getElementById('backBtn').classList.add('show');
        }
        
        // Show register form if there are registration errors
        @if($errors->has('fullname') || $errors->has('email') || $errors->has('password') || $errors->has('password_confirmation'))
            showRegister();
        @endif
    </script>
</body>
</html>
