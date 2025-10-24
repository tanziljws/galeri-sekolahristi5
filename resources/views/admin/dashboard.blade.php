<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Galeri Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .sidebar {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px 0;
        }
        .sidebar .nav-link {
            color: #495057;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .chart-container {
            position: relative;
            height: 300px;
            margin: 20px 0;
        }
        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .metric-card:hover {
            transform: translateY(-3px);
        }
        .metric-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .metric-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .metric-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="text-center mb-4">
                    <h4><i class="fas fa-cog me-2"></i>Admin Panel</h4>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="/admin/galeri/upload">
                        <i class="fas fa-upload me-2"></i>Upload Foto
                    </a>
                    <a class="nav-link active" href="/admin/galeri/dashboard">
                        <i class="fas fa-chart-bar me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="/admin/galeri/reports">
                        <i class="fas fa-chart-line me-2"></i>Laporan Interaktif
                    </a>
                    <a class="nav-link" href="/galeri-foto">
                        <i class="fas fa-eye me-2"></i>Lihat Galeri
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="container-fluid py-4">
                    <!-- Header -->
                    <div class="hero text-white py-4 mb-4 rounded">
                        <div class="container">
                            <h1><i class="fas fa-chart-bar me-3"></i>Dashboard Admin</h1>
                            <p class="mb-0">Statistik dan analisis galeri foto sekolah</p>
                        </div>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-primary">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div class="metric-value text-primary" id="totalPhotos">0</div>
                                <div class="metric-label">Total Foto</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-success">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="metric-value text-success" id="totalAlbums">0</div>
                                <div class="metric-label">Total Album</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-info">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="metric-value text-info" id="totalVisitors">0</div>
                                <div class="metric-label">Pengunjung Unik</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-warning">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="metric-value text-warning" id="totalLikes">0</div>
                                <div class="metric-label">Total Like</div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Statistik Pengunjung (7 Hari Terakhir)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="visitorChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Interaksi Pengguna</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="interactionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Photos -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Foto Terpopuler</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Rank</th>
                                                    <th>Foto</th>
                                                    <th>Judul</th>
                                                    <th>Album</th>
                                                    <th>Like</th>
                                                    <th>Dislike</th>
                                                    <th>Komentar</th>
                                                    <th>Total Interaksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="topPhotosTable">
                                                <tr>
                                                    <td colspan="8" class="text-center">Loading...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let visitorChart, interactionChart;

        // Load dashboard data
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardData();
        });

        function loadDashboardData() {
            // Load basic stats
            fetch('/api/admin/stats')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('totalPhotos').textContent = data.data.total_photos;
                        document.getElementById('totalAlbums').textContent = data.data.total_albums;
                        document.getElementById('totalVisitors').textContent = data.data.total_visitors;
                        document.getElementById('totalLikes').textContent = data.data.total_likes;
                    }
                })
                .catch(error => console.error('Error loading stats:', error));

            // Load analytics
            fetch('/api/admin/analytics?period=7')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        createVisitorChart(data.data.visitors);
                        createInteractionChart(data.data.interactions);
                        populateTopPhotos(data.data.top_photos);
                    }
                })
                .catch(error => console.error('Error loading analytics:', error));
        }

        function createVisitorChart(visitors) {
            const ctx = document.getElementById('visitorChart').getContext('2d');
            
            const labels = visitors.map(v => {
                const date = new Date(v.date);
                return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
            });
            
            const uniqueVisitors = visitors.map(v => v.unique_visitors);
            const totalVisits = visitors.map(v => v.total_visits);

            visitorChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pengunjung Unik',
                        data: uniqueVisitors,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'Total Kunjungan',
                        data: totalVisits,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function createInteractionChart(interactions) {
            const ctx = document.getElementById('interactionChart').getContext('2d');
            
            let likes = 0, dislikes = 0, comments = 0;
            
            interactions.forEach(interaction => {
                if (interaction.type === 'like') likes += interaction.count;
                else if (interaction.type === 'dislike') dislikes += interaction.count;
            });

            // Get comments count from separate API call
            fetch('/api/admin/stats')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        comments = data.data.total_comments;
                        
                        interactionChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Like', 'Dislike', 'Komentar'],
                                datasets: [{
                                    data: [likes, dislikes, comments],
                                    backgroundColor: ['#28a745', '#dc3545', '#17a2b8'],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                    }
                                }
                            }
                        });
                    }
                });
        }

        function populateTopPhotos(photos) {
            const tbody = document.getElementById('topPhotosTable');
            tbody.innerHTML = '';

            photos.forEach((photo, index) => {
                const totalInteractions = photo.likes_count + photo.dislikes_count + photo.comments_count;
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <span class="badge bg-${index < 3 ? 'warning' : 'secondary'}">
                            ${index + 1}
                        </span>
                    </td>
                    <td>
                        <img src="/storage/${photo.file}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;" alt="Foto">
                    </td>
                    <td>${photo.judul}</td>
                    <td>${photo.galery?.post?.judul || 'N/A'}</td>
                    <td><span class="badge bg-success">${photo.likes_count}</span></td>
                    <td><span class="badge bg-danger">${photo.dislikes_count}</span></td>
                    <td><span class="badge bg-info">${photo.comments_count}</span></td>
                    <td><strong>${totalInteractions}</strong></td>
                `;
                tbody.appendChild(row);
            });
        }

        // Auto refresh every 5 minutes
        setInterval(loadDashboardData, 300000);
    </script>
</body>
</html>
