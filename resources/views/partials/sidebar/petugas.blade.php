<nav class="space-y-2">
    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('dashboard') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-home w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Dashboard</span>
    </a>

    {{-- Daftar Alat --}}
    <a href="{{ route('petugas.alat.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.alat.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-tools w-5 h-5 {{ request()->routeIs('petugas.alat.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Daftar Alat</span>
    </a>

    {{-- Peminjaman Saya --}}
    <a href="{{ route('petugas.peminjaman.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.peminjaman.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-clipboard-list w-5 h-5 {{ request()->routeIs('petugas.peminjaman.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Daftar Peminjaman</span>
    </a>

    {{-- Pengembalian --}}
    <a href="{{ route('petugas.pengembalian.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.pengembalian.index') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-undo w-5 h-5 {{ request()->routeIs('petugas.pengembalian.index') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Pengembalian</span>
    </a>

    {{-- Laporan --}}
    <a href="{{ route('petugas.laporan.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.laporan.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-chart-bar w-5 h-5 {{ request()->routeIs('petugas.laporan.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Laporan</span>
    </a>
</nav>
