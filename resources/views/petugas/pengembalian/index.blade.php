@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 bg-white border-b border-gray-200 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pengembalian Alat</h1>
                <p class="text-sm text-gray-500 mt-1">Proses pengembalian alat yang dipinjam</p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter
                </button>
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export
                </button>
            </div>
        </div>
        {{-- Success Alert --}}
        @if (session('success'))
        <div class="px-8 py-4 bg-green-50 border-b border-green-200">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Kembali</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($peminjamans as $p)
                        @php
                            $tanggalRencana = \Carbon\Carbon::parse($p->tanggal_kembali_rencana);
                            $hariIni = \Carbon\Carbon::today();

                            $hariTelat = $hariIni->greaterThan($tanggalRencana)
                                ? $tanggalRencana->diffInDays($hariIni)
                                : 0;

                            $denda = $hariTelat * $p->alat->harga_denda;
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center bg-gradient-to-br from-green-500 to-emerald-600 rounded-full text-white font-bold text-sm">
                                        {{ substr($p->user->username ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $p->user->username ?? 'Unknown' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $p->user->email ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg text-white font-bold text-sm">
                                        {{ substr($p->alat->nama ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $p->alat->nama ?? 'Unknown' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Kategori: {{ $p->alat->kategori->nama_kategori ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-900">{{ $p->jumlah }} unit</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}</span>
                                    @if($hariTelat > 0)
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $hariTelat }} hari telat
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                               <a href="{{ route('petugas.pengembalian.show', $p->id) }}"
                           class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                            Proses
                        </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</div>

{{-- MODALS --}}
@foreach ($peminjamans as $p)
    @php
        $tanggalRencana = \Carbon\Carbon::parse($p->tanggal_kembali_rencana);
        $hariIni = \Carbon\Carbon::today();

        $hariTelat = $hariIni->greaterThan($tanggalRencana)
            ? $tanggalRencana->diffInDays($hariIni)
            : 0;

        $denda = $hariTelat * $p->alat->harga_denda;
    @endphp

    <!-- Modal -->
    <div id="modal{{ $p->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Konfirmasi Pengembalian</h3>
                        <button type="button" onclick="closeModal('modal{{ $p->id }}')" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Peminjam:</span>
                            <span class="text-sm text-gray-900">{{ $p->user->username }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Alat:</span>
                            <span class="text-sm text-gray-900">{{ $p->alat->nama }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Jumlah:</span>
                            <span class="text-sm text-gray-900">{{ $p->jumlah }} unit</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Tanggal Kembali:</span>
                            <span class="text-sm text-gray-900">{{ \Carbon\Carbon::today()->toDateString() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Hari Telat:</span>
                            <span class="text-sm font-medium {{ $hariTelat > 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $hariTelat }} hari
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Harga Denda per Hari:</span>
                            <span class="text-sm text-gray-900">Rp {{ number_format($p->alat->harga_denda, 0, ',', '.') }}/hari</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Total Denda:</span>
                            <span class="text-sm font-medium {{ $denda > 0 ? 'text-red-600' : 'text-green-600' }}">
                                Rp {{ number_format($denda, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('modal{{ $p->id }}')" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Batal
                    </button>
                    <form action="{{ route('petugas.pengembalian.store') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="peminjaman_id" value="{{ $p->id }}">
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Selesaikan Peminjaman
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script>
// Debug function
function debugModal() {
    console.log('Debug modal function');
    const modals = document.querySelectorAll('[id^="modal"]');
    console.log('Found modals:', modals.length);
    modals.forEach((modal, index) => {
        console.log(`Modal ${index}:`, modal.id);
    });
}

function openModal(modalId) {
    console.log('Opening modal:', modalId);
    console.log('Available modals:', document.querySelectorAll('[id^="modal"]').length);
    
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        console.log('Modal found and opened');
        
        // Add animation
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.style.opacity = '1';
        }, 10);
    } else {
        console.error('Modal not found:', modalId);
        console.log('All elements with IDs:', Array.from(document.querySelectorAll('[id]')).map(el => el.id));
    }
}

function closeModal(modalId) {
    console.log('Closing modal:', modalId);
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        console.log('Modal closed');
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed') || event.target.classList.contains('bg-opacity-50')) {
        const modals = document.querySelectorAll('[id^="modal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id^="modal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});

// Test on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded');
    debugModal();
    
    // Test first modal button
    const firstButton = document.querySelector('button[onclick*="openModal"]');
    if (firstButton) {
        console.log('First modal button found:', firstButton);
        firstButton.addEventListener('click', function(e) {
            console.log('Button clicked!', e);
        });
    } else {
        console.error('No modal buttons found');
    }
});
</script>
@endpush
@endsection
