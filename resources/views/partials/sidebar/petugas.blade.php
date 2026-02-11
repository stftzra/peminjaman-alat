<nav class="space-y-2">
    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('dashboard') 
            ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-home w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }} group-hover:text-blue-600 transition-colors duration-300"></i>
        <span class="ml-3">Dashboard</span>
    </a>

    {{-- Kelola Peminjaman --}}
    <a href="{{ route('petugas.peminjaman.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.peminjaman.*') 
            ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-clipboard-list w-5 h-5 {{ request()->routeIs('petugas.peminjaman.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-emerald-600 transition-colors duration-300"></i>
        <span class="ml-3">Kelola Peminjaman</span>
    </a>

    {{-- Kelola Pengembalian --}}
    <a href="{{ route('petugas.pengembalian.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.pengembalian.index') 
            ? 'bg-gradient-to-r from-orange-500 to-amber-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-undo w-5 h-5 {{ request()->routeIs('petugas.pengembalian.index') ? 'text-white' : 'text-gray-500' }} group-hover:text-orange-600 transition-colors duration-300"></i>
        <span class="ml-3">Kelola Pengembalian</span>
    </a>

    {{-- History Pengembalian --}}
    <a href="{{ route('petugas.pengembalian.history') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.pengembalian.history') 
            ? 'bg-gradient-to-r from-purple-500 to-violet-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-history w-5 h-5 {{ request()->routeIs('petugas.pengembalian.history') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span class="ml-3">History Pengembalian</span>
    </a>

    {{-- Laporan --}}
    <a href="{{ route('petugas.laporan.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('petugas.laporan.*') 
            ? 'bg-gradient-to-r from-indigo-500 to-blue-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-chart-bar w-5 h-5 {{ request()->routeIs('petugas.laporan.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-indigo-600 transition-colors duration-300"></i>
        <span class="ml-3">Laporan</span>
    </a>
</nav>
