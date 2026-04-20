<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Peminjaman System</title>
    <meta name="description" content="Modern peminjaman management system dengan elegant design">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Sidebar Transition */
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg sidebar-transition">
            <!-- Sidebar Header -->
            <div class="h-16 bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center px-6">
                <i class="fas fa-box-open text-white text-xl"></i>
                <span class="ml-3 text-white font-semibold">Peminjaman</span>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="mt-6 px-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        @include('partials.sidebar.admin')
                    @elseif(auth()->user()->role === 'petugas')
                        @include('partials.sidebar.petugas')
                    @elseif(auth()->user()->role === 'peminjam')
                        @include('partials.sidebar.peminjam')
                    @endif
                @endauth
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Header -->
            <header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-6">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        {{ auth()->user()->name ?? auth()->user()->username }}
                    </span>
                    
                    <div class="relative">
                        <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-8 w-8 rounded-full bg-gradient-to-r from-purple-400 to-indigo-400 flex items-center justify-center">
                                <i class="fas fa-user text-white text-xs"></i>
                            </div>
                        </button>
                    </div>
                    
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <button type="button" onclick="logout()" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Auto-hide sidebar on mobile
        if (window.innerWidth < 768) {
            document.querySelector('aside').classList.add('hidden');
        }
        
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('aside');
            sidebar.classList.toggle('hidden');
        }
        
        // Logout function
        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    </script>
</body>
</html>