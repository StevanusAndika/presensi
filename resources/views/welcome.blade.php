<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Presensi - Dokumentasi Interaktif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #1e293b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #06b6d4;
            --dark: #0f172a;
            --light: #f8fafc;
            --text-light: #f1f5f9;
            --text-dark: #1e293b;
            --bg-dark: #0f172a;
            --bg-card-dark: #1e293b;
            --bg-card-light: #ffffff;
            --border-dark: #334155;
            --border-light: #e2e8f0;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-dark: linear-gradient(135deg, #1e3a8a 0%, #7e22ce 100%);
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .dark-mode {
            --bg-primary: var(--bg-dark);
            --bg-card: var(--bg-card-dark);
            --text-primary: var(--text-light);
            --text-secondary: #cbd5e1;
            --border-color: var(--border-dark);
            --bg-light: #1e293b;
        }

        .light-mode {
            --bg-primary: #f8fafc;
            --bg-card: var(--bg-card-light);
            --text-primary: var(--text-dark);
            --text-secondary: #64748b;
            --border-color: var(--border-light);
            --bg-light: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
            transition: all 0.3s ease;
        }

        .glass-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            color: var(--text-primary);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .hero-section {
            background: var(--gradient-dark);
            padding: 80px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="1000,0 1000,100 0,100"></polygon></svg>');
            background-size: cover;
        }

        .api-endpoint {
            border-left: 4px solid;
            transition: all 0.3s ease;
            background: var(--bg-card);
        }

        .api-endpoint:hover {
            transform: translateX(5px);
        }

        .method-get { border-left-color: var(--success); }
        .method-post { border-left-color: var(--primary); }
        .method-put { border-left-color: var(--warning); }
        .method-delete { border-left-color: var(--danger); }

        .badge-method {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            color: white;
        }

        .badge-get { background: var(--success); }
        .badge-post { background: var(--primary); }
        .badge-delete { background: var(--danger); }

        .endpoint-url {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            margin: 15px 0;
            word-break: break-all;
            color: var(--text-primary);
        }

        .test-btn {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .test-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .response-area {
            background: #1a202c;
            color: #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            font-family: 'Fira Code', monospace;
            font-size: 0.85rem;
            min-height: 120px;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #2d3748;
        }

        .nav-tabs {
            border-bottom: 2px solid var(--border-color);
        }

        .nav-tabs .nav-link {
            border: none;
            padding: 15px 25px;
            font-weight: 600;
            color: var(--text-secondary);
            border-radius: 10px 10px 0 0;
            margin-right: 5px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .nav-tabs .nav-link:hover:not(.active) {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .feature-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            background: var(--bg-card);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
            color: white;
        }

        .copy-btn {
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.7;
            color: var(--text-secondary);
        }

        .copy-btn:hover {
            opacity: 1;
            transform: scale(1.1);
            color: var(--primary);
        }

        .stats-card {
            background: var(--gradient-2);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
            color: var(--text-primary);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .theme-toggle:hover {
            transform: rotate(30deg);
        }

        .request-body pre {
            background: var(--bg-light) !important;
            color: var(--text-primary) !important;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin: 0;
        }

        .request-body code {
            color: var(--text-primary) !important;
            background: transparent !important;
        }

        .text-muted {
            color: var(--text-secondary) !important;
        }

        .bg-light {
            background: var(--bg-light) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }

            .nav-tabs .nav-link {
                padding: 12px 15px;
                font-size: 0.9rem;
            }

            .endpoint-url {
                font-size: 0.8rem;
            }

            .theme-toggle {
                top: 10px;
                right: 10px;
                width: 40px;
                height: 40px;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body class="dark-mode">
    <!-- Theme Toggle -->
    <div class="theme-toggle" onclick="toggleTheme()">
        <i class="fas fa-moon" id="theme-icon"></i>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3 floating">
                        <i class="fas fa-calendar-check me-3"></i>
                        API Presensi Laravel
                    </h1>
                    <p class="lead mb-4 fs-5">
                        Dokumentasi interaktif untuk sistem manajemen kehadiran yang powerful dan mudah digunakan
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="fas fa-bolt me-2"></i>RESTful API
                        </span>
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="fas fa-shield-alt me-2"></i>Secure
                        </span>
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="fas fa-rocket me-2"></i>Fast
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="stats-card glass-card mt-4 mt-lg-0">
                        <i class="fas fa-code-branch fa-3x mb-3"></i>
                        <h3 class="fw-bold">12+</h3>
                        <p class="mb-0">Endpoint Tersedia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5>Manajemen Pengguna</h5>
                        <p class="text-muted">Kelola data pengguna dengan operasi CRUD lengkap</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5>Jadwal Kehadiran</h5>
                        <p class="text-muted">Atur jam masuk dan pulang untuk setiap hari</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h5>Presensi Real-time</h5>
                        <p class="text-muted">Catat dan pantau kehadiran secara live</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="glass-card p-4">
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs mb-4" id="apiTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pengguna-tab" data-bs-toggle="tab" data-bs-target="#pengguna" type="button">
                            <i class="fas fa-users me-2"></i>Manajemen Pengguna
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button">
                            <i class="fas fa-calendar me-2"></i>Jadwal Kehadiran
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="presensi-tab" data-bs-toggle="tab" data-bs-target="#presensi" type="button">
                            <i class="fas fa-clock me-2"></i>Presensi Harian
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="apiTabsContent">

                    <!-- Pengguna Tab -->
                    <div class="tab-pane fade show active" id="pengguna" role="tabpanel">
                        <div class="row g-4">
                            <!-- Get All Users -->
                            <div class="col-12">
                                <div class="api-endpoint method-get glass-card p-4 fade-in">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="mb-3">
                                            <span class="badge-method badge-get me-2">GET</span>
                                            <h5 class="d-inline-block mb-0">Ambil Semua Data Pengguna</h5>
                                        </div>
                                        <button class="test-btn" onclick="testEndpoint('getAllUsers')">
                                            <i class="fas fa-play me-1"></i>Test Endpoint
                                        </button>
                                    </div>
                                    <div class="endpoint-url">
                                        GET http://localhost:8000/api/pengguna/list-data
                                    </div>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Mengambil daftar lengkap semua pengguna yang terdaftar dalam sistem
                                    </p>

                                    <div class="test-section mt-3">
                                        <h6><i class="fas fa-code me-2"></i>Response:</h6>
                                        <div class="response-area" id="response-getAllUsers">
                                            Klik "Test Endpoint" untuk melihat response...
                                        </div>
                                        <div class="loading-spinner" id="loading-getAllUsers">
                                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                            <p class="mt-2">Memuat data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Create User -->
                            <div class="col-12">
                                <div class="api-endpoint method-post glass-card p-4 fade-in">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="mb-3">
                                            <span class="badge-method badge-post me-2">POST</span>
                                            <h5 class="d-inline-block mb-0">Tambah Pengguna Baru</h5>
                                        </div>
                                        <button class="test-btn" onclick="testEndpoint('createUser')">
                                            <i class="fas fa-play me-1"></i>Test Endpoint
                                        </button>
                                    </div>
                                    <div class="endpoint-url">
                                        POST http://localhost:8000/api/pengguna/simpan-data
                                    </div>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Menambahkan pengguna baru ke dalam sistem dengan data lengkap
                                    </p>

                                    <div class="request-body mb-4">
                                        <h6><i class="fas fa-paper-plane me-2"></i>Request Body:</h6>
                                        <div class="bg-light p-3 rounded position-relative">
                                            <pre class="mb-0"><code id="code-createUser">{
    "nip": "123456789",
    "nama": "Stevanus Andika Galih Setiawan",
    "level": "A",
    "sandi": "Andi124443"
}</code></pre>
                                            <i class="fas fa-copy copy-btn position-absolute top-0 end-0 m-3"
                                               onclick="copyCode('createUser')"></i>
                                        </div>
                                    </div>

                                    <div class="test-section">
                                        <h6><i class="fas fa-code me-2"></i>Response:</h6>
                                        <div class="response-area" id="response-createUser">
                                            Klik "Test Endpoint" untuk melihat response...
                                        </div>
                                        <div class="loading-spinner" id="loading-createUser">
                                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                            <p class="mt-2">Mengirim data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Tab -->
                    <div class="tab-pane fade" id="jadwal" role="tabpanel">
                        <div class="row g-4">
                            <!-- Get All Schedules -->
                            <div class="col-12">
                                <div class="api-endpoint method-get glass-card p-4 fade-in">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="mb-3">
                                            <span class="badge-method badge-get me-2">GET</span>
                                            <h5 class="d-inline-block mb-0">Ambil Semua Jadwal</h5>
                                        </div>
                                        <button class="test-btn" onclick="testEndpoint('getAllSchedules')">
                                            <i class="fas fa-play me-1"></i>Test Endpoint
                                        </button>
                                    </div>
                                    <div class="endpoint-url">
                                        GET http://localhost:8000/api/peta-kehadiran/list-data
                                    </div>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Mengambil semua jadwal kehadiran standar untuk Senin hingga Minggu
                                    </p>

                                    <div class="test-section mt-3">
                                        <h6><i class="fas fa-code me-2"></i>Response:</h6>
                                        <div class="response-area" id="response-getAllSchedules">
                                            Klik "Test Endpoint" untuk melihat response...
                                        </div>
                                        <div class="loading-spinner" id="loading-getAllSchedules">
                                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                            <p class="mt-2">Memuat data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Create Schedule -->
                            <div class="col-12">
                                <div class="api-endpoint method-post glass-card p-4 fade-in">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="mb-3">
                                            <span class="badge-method badge-post me-2">POST</span>
                                            <h5 class="d-inline-block mb-0">Buat Jadwal Baru</h5>
                                        </div>
                                        <button class="test-btn" onclick="testEndpoint('createSchedule')">
                                            <i class="fas fa-play me-1"></i>Test Endpoint
                                        </button>
                                    </div>
                                    <div class="endpoint-url">
                                        POST http://localhost:8000/api/peta-kehadiran/simpan-data
                                    </div>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Menambahkan jadwal kehadiran baru untuk hari tertentu (1-7: Senin-Minggu)
                                    </p>

                                    <div class="request-body mb-4">
                                        <h6><i class="fas fa-paper-plane me-2"></i>Request Body:</h6>
                                        <div class="bg-light p-3 rounded position-relative">
                                            <pre class="mb-0"><code id="code-createSchedule">{
    "no_hari": 1,
    "jam_masuk": "07:00:00",
    "jam_keluar": "17:00:00"
}</code></pre>
                                            <i class="fas fa-copy copy-btn position-absolute top-0 end-0 m-3"
                                               onclick="copyCode('createSchedule')"></i>
                                        </div>
                                    </div>

                                    <div class="test-section">
                                        <h6><i class="fas fa-code me-2"></i>Response:</h6>
                                        <div class="response-area" id="response-createSchedule">
                                            Klik "Test Endpoint" untuk melihat response...
                                        </div>
                                        <div class="loading-spinner" id="loading-createSchedule">
                                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                            <p class="mt-2">Mengirim data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Presensi Tab -->
                    <div class="tab-pane fade" id="presensi" role="tabpanel">
                        <div class="row g-4">
                            <!-- Get All Attendance -->
                            <div class="col-12">
                                <div class="api-endpoint method-get glass-card p-4 fade-in">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="mb-3">
                                            <span class="badge-method badge-get me-2">GET</span>
                                            <h5 class="d-inline-block mb-0">Ambil Semua Presensi</h5>
                                        </div>
                                        <button class="test-btn" onclick="testEndpoint('getAllAttendance')">
                                            <i class="fas fa-play me-1"></i>Test Endpoint
                                        </button>
                                    </div>
                                    <div class="endpoint-url">
                                        GET http://localhost:8000/api/presensi-harian/list-data
                                    </div>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Mengambil semua data presensi harian yang tercatat dalam sistem
                                    </p>

                                    <div class="test-section mt-3">
                                        <h6><i class="fas fa-code me-2"></i>Response:</h6>
                                        <div class="response-area" id="response-getAllAttendance">
                                            Klik "Test Endpoint" untuk melihat response...
                                        </div>
                                        <div class="loading-spinner" id="loading-getAllAttendance">
                                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                            <p class="mt-2">Memuat data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Create Attendance -->
                            <div class="col-12">
                                <div class="api-endpoint method-post glass-card p-4 fade-in">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="mb-3">
                                            <span class="badge-method badge-post me-2">POST</span>
                                            <h5 class="d-inline-block mb-0">Catat Presensi Baru</h5>
                                        </div>
                                        <button class="test-btn" onclick="testEndpoint('createAttendance')">
                                            <i class="fas fa-play me-1"></i>Test Endpoint
                                        </button>
                                    </div>
                                    <div class="endpoint-url">
                                        POST http://localhost:8000/api/presensi-harian/simpan-data
                                    </div>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Mencatat data absensi harian pengguna dengan informasi lengkap
                                    </p>

                                    <div class="request-body mb-4">
                                        <h6><i class="fas fa-paper-plane me-2"></i>Request Body:</h6>
                                        <div class="bg-light p-3 rounded position-relative">
                                            <pre class="mb-0"><code id="code-createAttendance">{
    "tgl_masuk": "2024-01-16 08:05:00",
    "tgl_pulang": "2024-01-16 17:10:00",
    "ket_hari": "H",
    "nip": "123456789",
    "ip_masuk": "192.168.1.101",
    "ip_keluar": "192.168.1.101",
    "peta_kehadiran_id": 1,
    "jam_harus_masuk": "08:00:00",
    "jam_harus_pulang": "17:00:00"
}</code></pre>
                                            <i class="fas fa-copy copy-btn position-absolute top-0 end-0 m-3"
                                               onclick="copyCode('createAttendance')"></i>
                                        </div>
                                    </div>

                                    <div class="test-section">
                                        <h6><i class="fas fa-code me-2"></i>Response:</h6>
                                        <div class="response-area" id="response-createAttendance">
                                            Klik "Test Endpoint" untuk melihat response...
                                        </div>
                                        <div class="loading-spinner" id="loading-createAttendance">
                                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                            <p class="mt-2">Mengirim data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-center text-white" style="background: var(--bg-card-dark);">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-heart text-danger mx-1"></i>
                Dibuat oleh <a class="text-white"href ="https://github.com/StevanusAndika">Stevanus Andika </a>
                <i class="fas fa-heart text-danger mx-1"></i>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme management
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');

            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            const themeIcon = document.getElementById('theme-icon');

            if (savedTheme === 'light') {
                document.body.classList.remove('dark-mode');
                document.body.classList.add('light-mode');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                document.body.classList.remove('light-mode');
                document.body.classList.add('dark-mode');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        });

        // Endpoint configurations
        const endpoints = {
            getAllUsers: {
                url: 'http://localhost:8000/api/pengguna/list-data',
                method: 'GET'
            },
            createUser: {
                url: 'http://localhost:8000/api/pengguna/simpan-data',
                method: 'POST',
                body: {
                    nip: "123456789",
                    nama: "Stevanus Andika Galih Setiawan",
                    level: "A",
                    sandi: "Andi124443"
                }
            },
            getAllSchedules: {
                url: 'http://localhost:8000/api/peta-kehadiran/list-data',
                method: 'GET'
            },
            createSchedule: {
                url: 'http://localhost:8000/api/peta-kehadiran/simpan-data',
                method: 'POST',
                body: {
                    no_hari: 1,
                    jam_masuk: "07:00:00",
                    jam_keluar: "17:00:00"
                }
            },
            getAllAttendance: {
                url: 'http://localhost:8000/api/presensi-harian/list-data',
                method: 'GET'
            },
            createAttendance: {
                url: 'http://localhost:8000/api/presensi-harian/simpan-data',
                method: 'POST',
                body: {
                    tgl_masuk: "2024-01-16 08:05:00",
                    tgl_pulang: "2024-01-16 17:10:00",
                    ket_hari: "H",
                    nip: "123456789",
                    ip_masuk: "192.168.1.101",
                    ip_keluar: "192.168.1.101",
                    peta_kehadiran_id: 1,
                    jam_harus_masuk: "08:00:00",
                    jam_harus_pulang: "17:00:00"
                }
            }
        };

        // Test endpoint function
        async function testEndpoint(endpointName) {
            const endpoint = endpoints[endpointName];
            const responseArea = document.getElementById(`response-${endpointName}`);
            const loadingSpinner = document.getElementById(`loading-${endpointName}`);

            // Show loading, hide response
            responseArea.style.display = 'none';
            loadingSpinner.style.display = 'block';

            try {
                const options = {
                    method: endpoint.method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                };

                if (endpoint.body) {
                    options.body = JSON.stringify(endpoint.body);
                }

                const response = await fetch(endpoint.url, options);
                const data = await response.json();

                // Format the response
                const formattedResponse = JSON.stringify(data, null, 2);
                responseArea.innerHTML = `✅ Status: ${response.status} ${response.statusText}\n\n${formattedResponse}`;

            } catch (error) {
                responseArea.innerHTML = `❌ Error: ${error.message}\n\n🔧 Pastikan:\n• Server Laravel berjalan di http://localhost:8000\n• CORS sudah dikonfigurasi\n• Endpoint tersedia`;
            } finally {
                // Hide loading, show response
                loadingSpinner.style.display = 'none';
                responseArea.style.display = 'block';

                // Add fade-in effect
                responseArea.style.animation = 'fadeIn 0.5s ease-in';
            }
        }

        // Copy code function
        function copyCode(endpointName) {
            const codeElement = document.getElementById(`code-${endpointName}`);
            const text = codeElement.textContent;

            navigator.clipboard.writeText(text).then(() => {
                const copyBtn = event.target;
                const originalIcon = copyBtn.classList.contains('fa-copy');

                // Change icon to check
                copyBtn.classList.replace('fa-copy', 'fa-check');
                copyBtn.classList.add('text-success');

                // Revert after 2 seconds
                setTimeout(() => {
                    copyBtn.classList.replace('fa-check', 'fa-copy');
                    copyBtn.classList.remove('text-success');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.6s ease-out';
                }
            });
        }, observerOptions);

        // Observe all API endpoint cards
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.api-endpoint');
            cards.forEach(card => {
                observer.observe(card);
            });
        });

        // Add active tab persistence
        document.addEventListener('DOMContentLoaded', function() {
            const triggerTabList = [].slice.call(document.querySelectorAll('#apiTabs button'));
            triggerTabList.forEach(function (triggerEl) {
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    const tabTrigger = new bootstrap.Tab(triggerEl);
                    tabTrigger.show();
                });
            });
        });
    </script>
</body>
</html>
