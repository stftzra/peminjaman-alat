@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 bg-white border-b border-gray-200">
            <div class="flex items-center">
                <a href="{{ route('admin.users.index') }}" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Role User</h1>
                    <p class="text-sm text-gray-500 mt-1">Ubah peran akses pengguna</p>
                </div>
            </div>
        </div>
        {{-- Form --}}
        <div class="px-8 py-6">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- User Info Card --}}
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 h-16 w-16 flex items-center justify-center bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full text-white font-bold text-2xl">
                            {{ substr($user->username ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900">{{ $user->username }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <p class="text-xs text-gray-400 mt-1">User ID: #{{ $user->id }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            @if($user->role == 'admin')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12a3 3 0 100-6 3 3 0 000 6zm-1 0a1 1 0 112 0v3a1 1 0 11-2 0V9a1 1 0 011-1z"></path>
                                    </svg>
                                    Admin
                                </span>
                            @elseif($user->role == 'petugas')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-1 0a1 1 0 112 0v3a1 1 0 11-2 0V9a1 1 0 011-1z"></path>
                                    </svg>
                                    Petugas
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-1 0a1 1 0 112 0v3a1 1 0 11-2 0V9a1 1 0 011-1z"></path>
                                    </svg>
                                    {{ ucfirst($user->role) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Role Selection --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Role <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="role" 
                                name="role" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none" 
                                required>
                            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin - Akses penuh sistem</option>
                            <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas - Kelola alat dan peminjaman</option>
                            <option value="peminjam" {{ $user->role=='peminjam'?'selected':'' }}>Peminjam - Pinjam alat saja</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Pilih peran akses yang sesuai untuk pengguna ini</p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Role
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
