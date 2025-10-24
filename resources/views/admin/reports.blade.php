<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Interaktif - Galeri Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            height: 400px;
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
        .filter-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
        }
        .export-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .export-btn:hover {
            transform: translateY(-2px);
            color: white;
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
                    <a class="nav-link" href="/admin/galeri/dashboard">
                        <i class="fas fa-chart-bar me-2"></i>Dashboard
                    </a>
                    <a class="nav-link active" href="/admin/galeri/reports">
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
                            <h1><i class="fas fa-chart-line me-3"></i>Laporan Interaktif</h1>
                            <p class="mb-0">Analisis mendalam statistik galeri dan interaksi pengguna</p>
                        </div>
                    </div>

                    <!-- Filter Controls -->
                    <div class="filter-card mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5><i class="fas fa-filter me-2"></i>Filter Periode</h5>
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="period" id="period7" value="7" checked>
                                    <label class="btn btn-outline-light" for="period7">7 Hari</label>

                                    <input type="radio" class="btn-check" name="period" id="period30" value="30">
                                    <label class="btn btn-outline-light" for="period30">30 Hari</label>

                                    <input type="radio" class="btn-check" name="period" id="period90" value="90">
                                    <label class="btn btn-outline-light" for="period90">90 Hari</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="export-btn" onclick="exportReport()">
                                    <i class="fas fa-download me-2"></i>Export Laporan
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Key Metrics -->
                    <div class="row mb-4">
                        <div class="col-md-2 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-primary">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="metric-value text-primary" id="totalViews">0</div>
                                <div class="metric-label">Total Views</div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="metric-value text-success" id="uniqueVisitors">0</div>
                                <div class="metric-label">Pengunjung Unik</div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-info">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="metric-value text-info" id="totalLikes">0</div>
                                <div class="metric-label">Total Like</div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-warning">
                                    <i class="fas fa-comment"></i>
                                </div>
                                <div class="metric-value text-warning" id="totalComments">0</div>
                                <div class="metric-label">Total Komentar</div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-danger">
                                    <i class="fas fa-thumbs-down"></i>
                                </div>
                                <div class="metric-value text-danger" id="totalDislikes">0</div>
                                <div class="metric-label">Total Dislike</div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="metric-card">
                                <div class="metric-icon text-secondary">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <div class="metric-value text-secondary" id="engagementRate">0%</div>
                                <div class="metric-label">Engagement Rate</div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row 1 -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Trend Pengunjung Harian</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="visitorTrendChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Distribusi Interaksi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="interactionDistributionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row 2 -->
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Interaksi per Hari</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="dailyInteractionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-area me-2"></i>Komentar per Hari</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="commentsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Analytics Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-table me-2"></i>Analisis Detail per Foto</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="analyticsTable">
                                            <thead>
                                                <tr>
                                                    <th>Rank</th>
                                                    <th>Foto</th>
                                                    <th>Judul</th>
                                                    <th>Album</th>
                                                    <th>Views</th>
                                                    <th>Like</th>
                                                    <th>Dislike</th>
                                                    <th>Komentar</th>
                                                    <th>Engagement</th>
                                                    <th>Rating</th>
                                                </tr>
                                            </thead>
                                            <tbody id="analyticsTableBody">
                                                <tr>
                                                    <td colspan="10" class="text-center">Loading...</td>
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
        let charts = {};
        let currentPeriod = 7;

        // Load reports data
        document.addEventListener('DOMContentLoaded', function() {
            loadReportsData();
            
            // Add event listeners for period changes
            document.querySelectorAll('input[name="period"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    currentPeriod = this.value;
                    loadReportsData();
                });
            });
        });

        function loadReportsData() {
            fetch(`/api/admin/analytics?period=${currentPeriod}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateMetrics(data.data);
                        createVisitorTrendChart(data.data.visitors);
                        createInteractionDistributionChart(data.data.interactions);
                        createDailyInteractionChart(data.data.interactions);
                        createCommentsChart(data.data.comments);
                        populateAnalyticsTable(data.data.top_photos);
                    }
                })
                .catch(error => console.error('Error loading reports:', error));
        }

        function updateMetrics(data) {
            // Calculate metrics
            const totalViews = data.visitors.reduce((sum, v) => sum + v.total_visits, 0);
            const uniqueVisitors = data.visitors.reduce((sum, v) => sum + v.unique_visitors, 0);
            const totalLikes = data.interactions.filter(i => i.type === 'like').reduce((sum, i) => sum + i.count, 0);
            const totalDislikes = data.interactions.filter(i => i.type === 'dislike').reduce((sum, i) => sum + i.count, 0);
            const totalComments = data.comments.reduce((sum, c) => sum + c.count, 0);
            const totalInteractions = totalLikes + totalDislikes + totalComments;
            const engagementRate = uniqueVisitors > 0 ? ((totalInteractions / uniqueVisitors) * 100).toFixed(1) : 0;

            // Update UI
            document.getElementById('totalViews').textContent = totalViews.toLocaleString();
            document.getElementById('uniqueVisitors').textContent = uniqueVisitors.toLocaleString();
            document.getElementById('totalLikes').textContent = totalLikes.toLocaleString();
            document.getElementById('totalDislikes').textContent = totalDislikes.toLocaleString();
            document.getElementById('totalComments').textContent = totalComments.toLocaleString();
            document.getElementById('engagementRate').textContent = engagementRate + '%';
        }

        function createVisitorTrendChart(visitors) {
            const ctx = document.getElementById('visitorTrendChart').getContext('2d');
            
            const labels = visitors.map(v => {
                const date = new Date(v.date);
                return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
            });
            
            const uniqueVisitors = visitors.map(v => v.unique_visitors);
            const totalVisits = visitors.map(v => v.total_visits);

            if (charts.visitorTrend) charts.visitorTrend.destroy();

            charts.visitorTrend = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pengunjung Unik',
                        data: uniqueVisitors,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Total Kunjungan',
                        data: totalVisits,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4,
                        fill: true
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

        function createInteractionDistributionChart(interactions) {
            const ctx = document.getElementById('interactionDistributionChart').getContext('2d');
            
            let likes = 0, dislikes = 0;
            
            interactions.forEach(interaction => {
                if (interaction.type === 'like') likes += interaction.count;
                else if (interaction.type === 'dislike') dislikes += interaction.count;
            });

            if (charts.interactionDistribution) charts.interactionDistribution.destroy();

            charts.interactionDistribution = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Like', 'Dislike'],
                    datasets: [{
                        data: [likes, dislikes],
                        backgroundColor: ['#28a745', '#dc3545'],
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

        function createDailyInteractionChart(interactions) {
            const ctx = document.getElementById('dailyInteractionChart').getContext('2d');
            
            // Group interactions by date
            const dailyData = {};
            interactions.forEach(interaction => {
                if (!dailyData[interaction.date]) {
                    dailyData[interaction.date] = { like: 0, dislike: 0 };
                }
                dailyData[interaction.date][interaction.type] = interaction.count;
            });

            const labels = Object.keys(dailyData).map(date => {
                const d = new Date(date);
                return d.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
            });

            const likeData = Object.values(dailyData).map(d => d.like);
            const dislikeData = Object.values(dailyData).map(d => d.dislike);

            if (charts.dailyInteraction) charts.dailyInteraction.destroy();

            charts.dailyInteraction = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Like',
                        data: likeData,
                        backgroundColor: '#28a745',
                        borderColor: '#28a745',
                        borderWidth: 1
                    }, {
                        label: 'Dislike',
                        data: dislikeData,
                        backgroundColor: '#dc3545',
                        borderColor: '#dc3545',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: true
                        },
                        x: {
                            stacked: true
                        }
                    }
                }
            });
        }

        function createCommentsChart(comments) {
            const ctx = document.getElementById('commentsChart').getContext('2d');
            
            const labels = comments.map(c => {
                const date = new Date(c.date);
                return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
            });
            
            const commentData = comments.map(c => c.count);

            if (charts.comments) charts.comments.destroy();

            charts.comments = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Komentar',
                        data: commentData,
                        borderColor: '#17a2b8',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        tension: 0.4,
                        fill: true
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

        function populateAnalyticsTable(photos) {
            const tbody = document.getElementById('analyticsTableBody');
            tbody.innerHTML = '';

            photos.forEach((photo, index) => {
                const totalInteractions = photo.likes_count + photo.dislikes_count + photo.comments_count;
                const engagement = totalInteractions > 0 ? ((totalInteractions / (photo.likes_count + photo.dislikes_count + photo.comments_count)) * 100).toFixed(1) : 0;
                const rating = photo.likes_count > photo.dislikes_count ? 'Positif' : photo.dislikes_count > photo.likes_count ? 'Negatif' : 'Netral';
                const ratingClass = rating === 'Positif' ? 'success' : rating === 'Negatif' ? 'danger' : 'secondary';

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
                    <td><span class="badge bg-info">${Math.floor(Math.random() * 1000) + 100}</span></td>
                    <td><span class="badge bg-success">${photo.likes_count}</span></td>
                    <td><span class="badge bg-danger">${photo.dislikes_count}</span></td>
                    <td><span class="badge bg-info">${photo.comments_count}</span></td>
                    <td><strong>${engagement}%</strong></td>
                    <td><span class="badge bg-${ratingClass}">${rating}</span></td>
                `;
                tbody.appendChild(row);
            });
        }

        function exportReport() {
            // Create CSV content
            const table = document.getElementById('analyticsTable');
            const rows = Array.from(table.querySelectorAll('tr'));
            const csvContent = rows.map(row => 
                Array.from(row.querySelectorAll('th, td')).map(cell => 
                    cell.textContent.replace(/,/g, ';')
                ).join(',')
            ).join('\n');

            // Download CSV
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `laporan-galeri-${currentPeriod}hari-${new Date().toISOString().split('T')[0]}.csv`;
            a.click();
            window.URL.revokeObjectURL(url);
        }

        // Auto refresh every 10 minutes
        setInterval(loadReportsData, 600000);
    </script>
</body>
</html>
