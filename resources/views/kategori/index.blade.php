<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Post | Web Galeri Sekolah</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><path d='M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z' fill='%231e40af'/><rect x='15' y='15' width='70' height='12' fill='%23dc2626'/><text x='50' y='24' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='8' font-weight='bold'>SMK NEGERI 4</text><rect x='35' y='30' width='30' height='8' fill='%23dc2626'/><rect x='40' y='38' width='20' height='4' fill='%23dc2626'/><rect x='45' y='42' width='10' height='8' fill='%23dc2626'/><path d='M25 35 L35 35 L30 45 Z' fill='%23dc2626'/><path d='M65 35 L75 35 L70 45 Z' fill='%23dc2626'/><rect x='70' y='38' width='8' height='4' fill='%231f2937'/><circle cx='50' cy='60' r='12' fill='%23f97316'/><circle cx='50' cy='60' r='8' fill='%231e40af'/><circle cx='50' cy='60' r='4' fill='%23f97316'/><rect x='38' y='48' width='4' height='6' fill='%23f97316'/><rect x='58' y='48' width='4' height='6' fill='%23f97316'/><rect x='48' y='38' width='4' height='6' fill='%23f97316'/><rect x='48' y='56' width='4' height='6' fill='%23f97316'/><path d='M40 70 L60 70 L60 80 L40 80 Z' fill='white' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='72' x2='55' y2='72' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='75' x2='55' y2='75' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='78' x2='55' y2='78' stroke='%231e40af' stroke-width='0.5'/><text x='50' y='90' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='6' font-weight='bold'>KOTA BOGOR</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #7c3aed;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: #ffffff;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-header {
            padding: 2rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Custom SMK Logo */
        .smk-logo {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
        }

        .smk-logo svg {
            width: 100%;
            height: 100%;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .logo-text .galeri {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e40af;
        }

        .logo-text .sekolah {
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 1.5rem 0.75rem;
        }

        .nav-item {
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            background-color: #f9fafb;
            margin: 2px 8px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .nav-link:hover {
            background: #f3f4f6;
            color: #374151;
            border-left-color: #d1d5db;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            background: #1e40af;
            color: #ffffff;
            border-left-color: #1e40af;
            border: 1px solid #1e40af;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            color: inherit;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-greeting {
            color: var(--dark-color);
            font-weight: 600;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Kategori Content */
        .kategori-content {
            padding: 2rem;
        }

        .page-header {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .btn-add-kategori {
            background: linear-gradient(135deg, var(--success-color), #059669);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-add-kategori:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            color: white;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: none;
            padding: 1rem;
            font-weight: 700;
            color: var(--dark-color);
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .table tbody td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Action Buttons */
        .btn-edit {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }

        /* Toggle Sidebar */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }

        .sidebar.show {
            transform: translateX(0);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <div class="smk-logo">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <!-- Shield Background -->
                        <path d="M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z" fill="#1e40af"/>
                        
                        <!-- Top Banner -->
                        <rect x="15" y="15" width="70" height="12" fill="#dc2626"/>
                        <text x="50" y="24" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8" font-weight="bold">SMK NEGERI 4</text>
                        
                        <!-- Central Red Mechanical Elements -->
                        <rect x="35" y="30" width="30" height="8" fill="#dc2626"/>
                        <rect x="40" y="38" width="20" height="4" fill="#dc2626"/>
                        <rect x="45" y="42" width="10" height="8" fill="#dc2626"/>
                        
                        <!-- Wings/Gears -->
                        <path d="M25 35 L35 35 L30 45 Z" fill="#dc2626"/>
                        <path d="M65 35 L75 35 L70 45 Z" fill="#dc2626"/>
                        
                        <!-- Black Rectangle -->
                        <rect x="70" y="38" width="8" height="4" fill="#1f2937"/>
                        
                        <!-- Orange Gear -->
                        <circle cx="50" cy="60" r="12" fill="#f97316"/>
                        <circle cx="50" cy="60" r="8" fill="#1e40af"/>
                        <circle cx="50" cy="60" r="4" fill="#f97316"/>
                        
                        <!-- Gear Teeth -->
                        <rect x="38" y="48" width="4" height="6" fill="#f97316"/>
                        <rect x="58" y="48" width="4" height="6" fill="#f97316"/>
                        <rect x="48" y="38" width="4" height="6" fill="#f97316"/>
                        <rect x="48" y="56" width="4" height="6" fill="#f97316"/>
                        
                        <!-- White Open Book -->
                        <path d="M40 70 L60 70 L60 80 L40 80 Z" fill="white" stroke="#1e40af" stroke-width="0.5"/>
                        <line x1="45" y1="72" x2="55" y2="72" stroke="#1e40af" stroke-width="0.5"/>
                        <line x1="45" y1="75" x2="55" y2="75" stroke="#1e40af" stroke-width="0.5"/>
                        <line x1="45" y1="78" x2="55" y2="78" stroke="#1e40af" stroke-width="0.5"/>
                        
                        <!-- Bottom Text -->
                        <text x="50" y="90" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="6" font-weight="bold">KOTA BOGOR</text>
                    </svg>
                </div>
                <div class="logo-text">
                    <span class="galeri">GALERI</span>
                    <span class="sekolah">SEKOLAH</span>
                </div>
            </a>
        </div>
        
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            
            <div class="nav-section">
                <div class="nav-section-title">APPLICATIONS</div>
                
                <li class="nav-item">
                    <a href="/admin/galeri/dashboard" class="nav-link">
                        <i class="fas fa-users-cog"></i>
                        Manajemen Admin
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link active">
                        <i class="fas fa-tags"></i>
                        Kategori Post
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('post.index') }}" class="nav-link">
                        <i class="fas fa-newspaper"></i>
                        Berita
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('galeri.index') }}" class="nav-link">
                        <i class="fas fa-images"></i>
                        Galeri
                    </a>
                </li>
                
                
            </div>
            
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <div class="d-flex align-items-center">
                <button class="sidebar-toggle me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="d-flex align-items-center me-3">
                    <div class="smk-logo" style="width: 40px; height: 40px;">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <!-- Shield Background -->
                            <path d="M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z" fill="#1e40af"/>
                            
                            <!-- Top Banner -->
                            <rect x="15" y="15" width="70" height="12" fill="#dc2626"/>
                            <text x="50" y="24" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8" font-weight="bold">SMK NEGERI 4</text>
                            
                            <!-- Central Red Mechanical Elements -->
                            <rect x="35" y="30" width="30" height="8" fill="#dc2626"/>
                            <rect x="40" y="38" width="20" height="4" fill="#dc2626"/>
                            <rect x="45" y="42" width="10" height="8" fill="#dc2626"/>
                            
                            <!-- Wings/Gears -->
                            <path d="M25 35 L35 35 L30 45 Z" fill="#dc2626"/>
                            <path d="M65 35 L75 35 L70 45 Z" fill="#dc2626"/>
                            
                            <!-- Black Rectangle -->
                            <rect x="70" y="38" width="8" height="4" fill="#1f2937"/>
                            
                            <!-- Orange Gear -->
                            <circle cx="50" cy="60" r="12" fill="#f97316"/>
                            <circle cx="50" cy="60" r="8" fill="#1e40af"/>
                            <circle cx="50" cy="60" r="4" fill="#f97316"/>
                            
                            <!-- Gear Teeth -->
                            <rect x="38" y="48" width="4" height="6" fill="#f97316"/>
                            <rect x="58" y="48" width="4" height="6" fill="#f97316"/>
                            <rect x="48" y="38" width="4" height="6" fill="#f97316"/>
                            <rect x="48" y="56" width="4" height="6" fill="#f97316"/>
                            
                            <!-- White Open Book -->
                            <path d="M40 70 L60 70 L60 80 L40 80 Z" fill="white" stroke="#1e40af" stroke-width="0.5"/>
                            <line x1="45" y1="72" x2="55" y2="72" stroke="#1e40af" stroke-width="0.5"/>
                            <line x1="45" y1="75" x2="55" y2="75" stroke="#1e40af" stroke-width="0.5"/>
                            <line x1="45" y1="78" x2="55" y2="78" stroke="#1e40af" stroke-width="0.5"/>
                            
                            <!-- Bottom Text -->
                            <text x="50" y="90" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="6" font-weight="bold">KOTA BOGOR</text>
                        </svg>
                    </div>
                </div>
                <h1 class="page-title">Kategori Post</h1>
            </div>
            
            <div class="user-info">
                <span class="user-greeting">Hello, {{ session('username') }}</span>
                <div class="user-avatar">
                    {{ strtoupper(substr(session('username'), 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Kategori Content -->
        <div class="kategori-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <h1>Kategori Post</h1>
                <a href="{{ route('kategori.create') }}" class="btn-add-kategori">
                    <i class="fas fa-plus"></i>
                    + Kategori
                </a>
            </div>

            <!-- Table Container -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kategori->judul }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-edit">
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <i class="fas fa-trash me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>All Rights Reserved by Smart4 bogor. Designed and Developed by Risti RahmaDania.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Prevent default behavior for problematic links
        document.addEventListener('DOMContentLoaded', function() {
            // Remove any event listeners that might be blocking navigation
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                // Remove any existing event listeners
                link.onclick = null;
                
                // Ensure links work properly
                link.addEventListener('click', function(e) {
                    // Only prevent default if it's a hash link
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                        return false;
                    }
                    // Allow normal navigation for other links
                });
            });

            // Ensure form submissions work properly
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Allow normal form submission
                    return true;
                });
            });
        });

        // Force page refresh if there are any blocking issues
        window.addEventListener('beforeunload', function() {
            // Clean up any blocking operations
        });
    </script>
</body>
</html>
