<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Kependudukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            border-radius: 10px;
            margin: 5px 0;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stat-card-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .stat-card-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white"><i class="fas fa-users"></i> Kependudukan</h4>
                        <small class="text-white-50">Sistem Data Penduduk</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('warga.index') }}" class="nav-link">
                            <i class="fas fa-user me-2"></i> Data Warga
                        </a>
                        <a href="{{ route('anggota-keluarga.index') }}" class="nav-link">
                            <i class="fas fa-users me-2"></i> Anggota Keluarga
                        </a>
                        <a href="#" class="nav-link">
                            <i class="fas fa-home me-2"></i> Keluarga KK
                        </a>
                        <a href="#" class="nav-link">
                            <i class="fas fa-baby me-2"></i> Kelahiran
                        </a>
                        <a href="#" class="nav-link">
                            <i class="fas fa-cross me-2"></i> Kematian
                        </a>
                        <a href="#" class="nav-link">
                            <i class="fas fa-truck me-2"></i> Pindah
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <div class="main-content">
                    <!-- Top Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <h5 class="mb-0">Dashboard</h5>
                            <div class="d-flex align-items-center">
                                <span class="text-muted me-3">Selamat datang di Sistem Kependudukan</span>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user me-1"></i> Admin
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Content -->
                    <div class="p-4">
                        <!-- Stats Cards -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-2x mb-3"></i>
                                        <h3 class="mb-1">1,234</h3>
                                        <p class="mb-0">Total Penduduk</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card stat-card-2">
                                    <div class="card-body text-center">
                                        <i class="fas fa-home fa-2x mb-3"></i>
                                        <h3 class="mb-1">456</h3>
                                        <p class="mb-0">Keluarga</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card stat-card-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-baby fa-2x mb-3"></i>
                                        <h3 class="mb-1">89</h3>
                                        <p class="mb-0">Kelahiran Bulan Ini</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <a href="{{ route('anggota-keluarga.create') }}" class="btn btn-primary w-100">
                                                    <i class="fas fa-plus me-2"></i>Tambah Anggota
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-success w-100">
                                                    <i class="fas fa-file-export me-2"></i>Export Data
                                                </button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-info w-100">
                                                    <i class="fas fa-chart-bar me-2"></i>Laporan
                                                </button>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button class="btn btn-warning w-100">
                                                    <i class="fas fa-cog me-2"></i>Pengaturan
                                                </button>
                                            </div>
                                        </div>
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
</body>
</html>