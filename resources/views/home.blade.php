<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Alat - Solusi Modern untuk Manajemen Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes slideInFromLeft {
            0% { transform: translateX(-100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideInFromRight {
            0% { transform: translateX(100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideInFromBottom {
            0% { transform: translateY(50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .hero-gradient {
            background: linear-gradient(-45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #667eea 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        .floating { animation: float 6s ease-in-out infinite; }
        .slide-in-left { animation: slideInFromLeft 1s ease-out; }
        .slide-in-right { animation: slideInFromRight 1s ease-out; }
        .slide-in-bottom { animation: slideInFromBottom 1s ease-out; }
        .pulse-animation { animation: pulse 2s ease-in-out infinite; }
        
        .card-hover {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .feature-icon {
            transition: all 0.3s ease;
        }
        
        .feature-icon:hover {
            transform: scale(1.15) rotate(5deg);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
</head>
<body class="bg-gray-50 overflow-x-hidden">
    
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-20 h-20 bg-purple-300 rounded-full opacity-20 floating"></div>
        <div class="absolute top-40 right-20 w-32 h-32 bg-blue-300 rounded-full opacity-10 floating" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-pink-300 rounded-full opacity-15 floating" style="animation-delay: 4s;"></div>
        <div class="absolute top-1/2 right-1/3 w-16 h-16 bg-indigo-300 rounded-full opacity-20 floating" style="animation-delay: 1s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center slide-in-left">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Sistem Peminjaman Alat</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4 slide-in-right">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium transition-all hover:bg-white hover:shadow-md">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition-all hover:shadow-lg hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="mb-8 slide-in-bottom">
                    <div class="inline-flex items-center justify-center w-32 h-32 bg-white/20 backdrop-blur-sm rounded-2xl mb-6 pulse-animation shadow-2xl">
                        <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl">
                            <i class="fas fa-tools text-5xl text-white"></i>
                        </div>
                    </div>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold mb-6 slide-in-bottom" style="animation-delay: 0.2s;">
                    Sistem Peminjaman Alat
                </h1>
                <div class="flex flex-col sm:flex-row gap-6 justify-center slide-in-bottom" style="animation-delay: 0.6s;">
                    <a href="{{ route('login') }}" class="glass-effect text-white px-10 py-4 rounded-xl text-lg font-semibold transition-all hover:bg-white hover:text-indigo-600 hover:shadow-2xl hover:scale-105">
                        <i class="fas fa-rocket mr-3"></i>Mulai Sekarang
                    </a>
                    <a href="#features" class="border-2 border-white text-white px-10 py-4 rounded-xl text-lg font-semibold transition-all hover:bg-white hover:text-indigo-600 hover:shadow-2xl hover:scale-105">
                        <i class="fas fa-info-circle mr-3"></i>Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-20" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,64L80,69.3C160,74.7,320,85.3,480,90.7C640,96,800,96,960,90.7C1120,85.3,1280,74.7,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="white" fill-opacity="0.1"/>
                <path d="M0,32L80,37.3C160,42.7,320,53.3,480,58.7C640,64,800,64,960,58.7C1120,53.3,1280,42.7,1360,37.3L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="white" fill-opacity="0.2"/>
                <path d="M0,96L80,101.3C160,106.7,320,117.3,480,122.7C640,128,800,128,960,122.7C1120,117.3,1280,106.7,1360,101.3L1440,96L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="white"/>
            </svg>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gradient mb-4">Statistik Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Angka-angka yang menunjukkan kepercayaan dan kinerja sistem kami</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center card-hover bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl border border-blue-100">
                    <div class="feature-icon text-blue-600 text-5xl mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-tools"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ number_format($totalAlat) }}</h3>
                    <p class="text-lg text-gray-600">Total Alat</p>
                    <div class="mt-4 text-sm text-blue-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+12% dari bulan lalu
                    </div>
                </div>
                
                <div class="text-center card-hover bg-gradient-to-br from-green-50 to-emerald-100 p-8 rounded-2xl border border-green-100">
                    <div class="feature-icon text-green-600 text-5xl mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ number_format($totalKategori) }}</h3>
                    <p class="text-lg text-gray-600">Kategori</p>
                    <div class="mt-4 text-sm text-green-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+5% dari bulan lalu
                    </div>
                </div>
                
                <div class="text-center card-hover bg-gradient-to-br from-yellow-50 to-orange-100 p-8 rounded-2xl border border-yellow-100">
                    <div class="feature-icon text-yellow-600 text-5xl mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ number_format($totalStok) }}</h3>
                    <p class="text-lg text-gray-600">Total Stok</p>
                    <div class="mt-4 text-sm text-yellow-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+8% dari bulan lalu
                    </div>
                </div>
                
                <div class="text-center card-hover bg-gradient-to-br from-purple-50 to-pink-100 p-8 rounded-2xl border border-purple-100">
                    <div class="feature-icon text-purple-600 text-5xl mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ number_format($activePeminjaman) }}</h3>
                    <p class="text-lg text-gray-600">Peminjaman Aktif</p>
                    <div class="mt-4 text-sm text-purple-600 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+15% dari bulan lalu
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-bold text-gradient mb-6">Fitur Unggulan Kami</h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto">Sistem kami dilengkapi dengan berbagai fitur canggih untuk memudahkan manajemen peminjaman alat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="bg-white p-10 rounded-2xl shadow-xl card-hover border border-gray-100">
                    <div class="feature-icon text-indigo-600 text-6xl mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Dashboard Modern</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Pantau semua aktivitas peminjaman dengan dashboard yang intuitif, real-time, dan penuh dengan visualisasi data yang menarik
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            <i class="fas fa-star mr-1"></i>Popular
                        </span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-xl card-hover border border-gray-100">
                    <div class="feature-icon text-green-600 text-6xl mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Manajemen Mudah</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Kelola stok, kategori, dan kondisi alat dengan sistem yang terorganisir dan user-friendly
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>Essential
                        </span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-xl card-hover border border-gray-100">
                    <div class="feature-icon text-yellow-600 text-6xl mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Laporan Lengkap</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Dapatkan laporan detail dan analisis mendalam untuk pengambilan keputusan yang lebih baik dan strategis
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-chart-bar mr-1"></i>Analytics
                        </span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-xl card-hover border border-gray-100">
                    <div class="feature-icon text-red-600 text-6xl mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-bell"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Notifikasi Cerdas</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Dapatkan notifikasi otomatis dan real-time untuk pengembalian alat, update status, dan reminder penting
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-bell mr-1"></i>Smart
                        </span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-xl card-hover border border-gray-100">
                    <div class="feature-icon text-purple-600 text-6xl mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Multi-Role System</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Support Admin, Petugas, dan Peminjam dengan sistem hak akses yang aman dan terkelola dengan baik
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-shield-alt mr-1"></i>Secure
                        </span>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-xl card-hover border border-gray-100">
                    <div class="feature-icon text-blue-600 text-6xl mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center text-white shadow-xl">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Export & Report</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Export laporan ke berbagai format (PDF, Excel) untuk dokumentasi dan keperluan administrasi yang lengkap
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-download mr-1"></i>Export
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Tools Section -->
    @if($featuredAlat->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-bold text-gradient mb-6">Alat Tersedia</h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto">Beberapa alat unggulan yang tersedia untuk dipinjam</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredAlat as $alat)
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 card-hover border border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            {{ substr($alat->nama_alat, 0, 1) }}
                        </div>
                        <div class="ml-6">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $alat->nama_alat }}</h3>
                            <p class="text-lg text-gray-600">{{ $alat->kategori->nama_kategori ?? 'Tidak ada kategori' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-lg text-gray-700">
                            <i class="fas fa-boxes text-green-500 mr-2"></i>
                            <span class="font-semibold">Stok:</span> {{ $alat->stok }}
                        </div>
                        <div class="text-lg text-gray-700">
                            <i class="fas fa-tag text-blue-500 mr-2"></i>
                            <span class="font-semibold">Kode:</span> {{ $alat->kode_alat }}
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-lg">
                            @if($alat->stok > 0)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>Habis
                                </span>
                            @endif
                        </div>
                        <div class="text-lg text-gray-600">
                            <i class="fas fa-wrench text-orange-500 mr-1"></i>
                            {{ $alat->kondisi_baik }} baik / {{ $alat->kondisi_rusak }} rusak
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('login') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-12 py-4 rounded-2xl text-xl font-semibold transition-all hover:shadow-2xl hover:scale-105">
                    <i class="fas fa-search mr-3"></i>Lihat Semua Alat
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-32 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="mb-12">
                <div class="inline-flex items-center justify-center w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full pulse-animation">
                    <i class="fas fa-rocket text-6xl"></i>
                </div>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-8">Siap Memulai?</h2>
            <p class="text-2xl text-white/90 mb-12 max-w-4xl mx-auto">
                Bergabunglah dengan sistem peminjaman alat modern dan kelola inventaris Anda dengan lebih efisien dan profesional
            </p>
            <div class="flex flex-col sm:flex-row gap-8 justify-center">
                <a href="{{ route('register') }}" class="glass-effect text-white px-12 py-4 rounded-2xl text-xl font-semibold transition-all hover:bg-white hover:text-indigo-600 hover:shadow-2xl hover:scale-105">
                    <i class="fas fa-user-plus mr-3"></i>Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white px-12 py-4 rounded-2xl text-xl font-semibold transition-all hover:bg-white hover:text-indigo-600 hover:shadow-2xl hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-3"></i>Masuk ke Sistem
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold mr-3">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span class="text-2xl font-bold">Sistem Peminjaman Alat</span>
                    </div>
                    <p class="text-gray-400 text-lg leading-relaxed">
                         manajemen peminjaman alat yang efisien, dan mudah digunakan.
                    </p>
                    <div class="mt-6 flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-indigo-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400 text-lg">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-sign-in-alt mr-2"></i>Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors flex items-center"><i class="fas fa-user-plus mr-2"></i>Daftar</a></li>
                        <li><a href="#features" class="hover:text-white transition-colors flex items-center"><i class="fas fa-star mr-2"></i>Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition-colors flex items-center"><i class="fas fa-question-circle mr-2"></i>Bantuan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Kontak</h3>
                    <ul class="space-y-4 text-gray-400 text-lg">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-indigo-400"></i>
                            <span>info@peminjaman-alat.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-indigo-400"></i>
                            <span>+62 888297174082</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-indigo-400"></i>
                            <span>Bogor, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8">
                <!-- Logo Section -->
                <div class="flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-12 mb-8">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center shadow-xl mb-3">
                            <img src="https://i.ibb.co/3s6Qk2v/logo-smk-ciomas.png" alt="Logo Sekolah" class="w-20 h-20 object-contain" onerror="this.src='https://via.placeholder.com/80x80/1e40af/ffffff?text=SMK'; this.onerror=null;">
                        </div>
                        <p class="text-gray-400 font-semibold">SMK NEGRI 1 CIOMAS</p>
                    </div>
                    <div class="text-center">
                        <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center shadow-xl mb-3">
                            <img src="https://via.placeholder.com/80x80/dc2626/ffffff?text=LOGO+JURUSAN" alt="Logo Jurusan" class="w-20 h-20 object-contain">
                        </div>
                        <p class="text-gray-400 font-semibold">Pengembangan Perangkat Lunak dan Gim</p>
                    </div>
                </div>
                
                <div class="text-center text-gray-400">
                    <p class="text-lg">&copy; 2024 Sistem Peminjaman Alat. All rights reserved.</p>
                    <p class="mt-2 text-sm">SITI FATIMAH AZZAHRA <i class="fas fa-heart text-red-500"></i> in Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards and sections
        document.querySelectorAll('.card-hover').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(card);
        });

        // Add parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero-gradient');
            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add floating animation to background elements
        document.addEventListener('DOMContentLoaded', () => {
            // Add staggered animations to elements
            const elements = document.querySelectorAll('.slide-in-bottom, .slide-in-left, .slide-in-right');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Add interactive hover effects
        document.querySelectorAll('.feature-icon').forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.15) rotate(5deg)';
            });
            icon.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });
    </script>
</body>
</html>
