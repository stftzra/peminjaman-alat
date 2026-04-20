@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    {{-- Elegant Header --}}
    <div class="bg-gradient-to-r from-orange-600 to-red-600 text-white">
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Log Aktivitas</h1>
                    <p class="text-orange-100 text-lg">Monitor semua aktivitas pengguna dalam sistem</p>
                    <div class="mt-4 flex items-center space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-history mr-2"></i>
                            <span>{{ $logs->count() }} total aktivitas</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            <span>{{ $logs->unique('user_id')->count() }} user aktif</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-center">
                            <i class="fas fa-shield-alt text-4xl mb-2"></i>
                            <p class="text-sm">Keamanan</p>
                            <p class="text-2xl font-bold">Termonitor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8">
        {{-- Elegant Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-history text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Total Aktivitas</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $logs->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Semua aktivitas</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">User Aktif</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $logs->unique('user_id')->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Pengguna terlibat</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-calendar-day text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">Hari Ini</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $logs->where('waktu', '>=', now()->startOfDay())->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Aktivitas hari ini</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4">
                    <div class="flex items-center justify-between">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div class="text-white/80 text-sm">7 Hari Terakhir</div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-3xl font-bold text-gray-900">{{ $logs->where('waktu', '>=', now()->subDays(7))->count() }}</p>
                    <p class="text-sm text-gray-500 mt-1">Minggu ini</p>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-history text-orange-600 text-xl mr-3"></i>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Aktivitas</h2>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>

            {{-- Elegant Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($logs as $log)
                        <tr class="hover:bg-orange-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-clock text-sm"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($log->waktu)->format('d M Y') }}</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-clock text-blue-500 text-xs mr-2"></i>
                                            <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($log->waktu)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                        {{ substr($log->user->username ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-900">{{ $log->user->username ?? 'Unknown' }}</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-envelope text-green-500 text-xs mr-2"></i>
                                            <span class="text-sm text-gray-600">{{ $log->user->email ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 mb-2">
                                    {{ $log->aktivitas }}
                                </div>
                                @if($log->ip_address)
                                <div class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    <i class="fas fa-globe mr-1"></i>
                                    IP: {{ $log->ip_address }}
                                </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16">
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                        <i class="fas fa-history text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Aktivitas</h3>
                                    <p class="text-gray-500 mb-4">Belum ada aktivitas yang tercatat dalam sistem</p>
                                    <button class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-orange-600 rounded-xl hover:bg-orange-700 transition-colors shadow-lg">
                                        <i class="fas fa-sync mr-2"></i>
                                        Refresh Data
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
