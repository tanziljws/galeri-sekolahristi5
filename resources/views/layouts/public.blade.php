<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMKN 4 Kota Bogor')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .navbar-brand img { height: 36px; }
        .page-header { background: linear-gradient(135deg,#e0ecff,#f0f9ff); }
    </style>
    @stack('head')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/smk-logo.png') }}" alt="SMKN 4">
                <span class="ms-2 fw-semibold">SMKN 4 Kota Bogor</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('galeri.public') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('berita.index') }}">Berita</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @hasSection('page-title')
    <header class="page-header py-5 mb-4">
        <div class="container">
            <h1 class="mb-0">@yield('page-title')</h1>
            @yield('page-subtitle')
        </div>
    </header>
    @endif

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="border-top py-4 bg-white">
        <div class="container small text-muted">
            © {{ date('Y') }} SMKN 4 Kota Bogor
        </div>
    </footer>
</body>
</html>


