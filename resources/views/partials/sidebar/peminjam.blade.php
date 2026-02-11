<nav class="space-y-2">
    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-home w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }} group-hover:text-blue-600 transition-colors duration-300"></i>
        <span class="ml-3">Dashboard</span>
    </a>

    {{-- Daftar Alat --}}
    <a href="{{ route('peminjam.alat.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('peminjam.alat.*') ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-tools w-5 h-5 {{ request()->routeIs('peminjam.alat.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-emerald-600 transition-colors duration-300"></i>
        <span class="ml-3">Daftar Alat</span>
    </a>

    {{-- Peminjaman Saya --}}
    <a href="{{ route('peminjam.peminjaman.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('peminjam.peminjaman.*') ? 'bg-gradient-to-r from-purple-500 to-violet-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-clipboard-list w-5 h-5 {{ request()->routeIs('peminjam.peminjaman.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span class="ml-3">Peminjaman Saya</span>
    </a>

    {{-- Pengembalian --}}
    <a href="{{ route('peminjam.pengembalian.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('peminjam.pengembalian.*') ? 'bg-gradient-to-r from-orange-500 to-amber-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-undo w-5 h-5 {{ request()->routeIs('peminjam.pengembalian.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-orange-600 transition-colors duration-300"></i>
        <span class="ml-3">Pengembalian</span>
    </a>
</nav>
