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

    {{-- Kelola User --}}
    <a href="{{ route('admin.users.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('admin.users.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-users w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Kelola User</span>
    </a>

    {{-- Kelola Alat --}}
    <a href="{{ route('admin.alat.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('admin.alat.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-tools w-5 h-5 {{ request()->routeIs('admin.alat.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Kelola Alat</span>
    </a>

    {{-- Kelola Kategori --}}
    <a href="{{ route('admin.kategori.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('admin.kategori.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-folder w-5 h-5 {{ request()->routeIs('admin.kategori.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Kelola Kategori</span>
    </a>

    {{-- Data Peminjaman --}}
    <a href="{{ route('admin.peminjaman.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('admin.peminjaman.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-exchange-alt w-5 h-5 {{ request()->routeIs('admin.peminjaman.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Data Peminjaman</span>
    </a>

    {{-- Data Pengembalian --}}
    <a href="{{ route('admin.pengembalian.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('admin.pengembalian.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-undo w-5 h-5 {{ request()->routeIs('admin.pengembalian.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Data Pengembalian</span>
    </a>

    {{-- Log Aktivitas --}}
    <a href="{{ route('admin.log.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-300
       {{ request()->routeIs('admin.log.*') 
            ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' 
            : 'text-gray-700 hover:bg-gray-100' }} group">
        <i class="fas fa-history w-5 h-5 {{ request()->routeIs('admin.log.*') ? 'text-white' : 'text-gray-500' }} group-hover:text-purple-600 transition-colors duration-300"></i>
        <span>Log Aktivitas</span>
    </a>
</nav>
