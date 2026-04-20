@extends('layouts.dashboard')

@section('content')
<div class="p-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Gradient Header --}}
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-8 py-7 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                
                <div>
                    <h2 class="text-2xl font-bold tracking-wide">
                        📦 Daftar Alat
                    </h2>
                    <p class="text-sm opacity-90 mt-1">
                        List seluruh alat yang tersedia untuk dipinjam
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    {{-- Search Bar --}}
                    <div class="relative w-full md:w-72">
                        <input type="text"
                               placeholder="Cari alat..."
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl text-sm text-gray-700 bg-white shadow-md focus:ring-2 focus:ring-white focus:outline-none transition duration-300">
                        
                        <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400"
                             fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </div>
                    


                </div>

            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($alats as $alat)
                    <tr class="hover:bg-gray-50 transition-colors">

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $alat->nama_alat }}
                            </div>
                            @if($alat->kondisi_rusak > 0)
                            <div class="text-xs text-red-600">
                                {{ $alat->kondisi_rusak }} rusak
                            </div>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $alat->kategori->nama_kategori }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($alat->stok > 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $alat->stok }} tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center">

                                @if($alat->stok > 0)
                                <button onclick="openPinjamModal({{ $alat->id }}, '{{ $alat->nama_alat }}', {{ $alat->stok }})" 
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors cursor-pointer"
                                        type="button">
                                    <i class="fas fa-hand-holding mr-1"></i>
                                    Pinjam
                                </button>
                                @else
                                <button disabled 
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-ban mr-1"></i>
                                    Stok Habis
                                </button>
                                @endif

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-sm font-medium">Tidak ada data alat</p>
                                <p class="text-xs text-gray-400 mt-1">Tambahkan alat untuk memulai</p>
                            </div>
                        </td>   
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

{{-- Modal Pinjam --}}
@foreach($alats as $alat)
    @if($alat->stok > 0)
    <div id="pinjamModal{{ $alat->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full border-0">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-hand-holding text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white">Form Peminjaman</h3>
                        </div>
                        <button type="button" onclick="closePinjamModal('pinjamModal{{ $alat->id }}')" class="text-white/80 hover:text-white transition-colors p-2 hover:bg-white/20 rounded-lg">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">
                    <div class="px-6 py-4">
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tools mr-2"></i>Nama Alat
                                </label>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold mr-3">
                                        {{ substr($alat->nama_alat, 0, 1) }}
                                    </div>
                                    <input type="text" value="{{ $alat->nama_alat }}" readonly 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 font-medium">
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-cubes mr-2"></i>Jumlah
                                </label>
                                <div class="flex items-center">
                                    <input type="number" name="jumlah" min="1" max="{{ $alat->stok }}" required
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    <div class="ml-3 px-3 py-2 bg-purple-100 text-purple-700 rounded-lg font-medium">
                                        <i class="fas fa-box mr-2"></i>Stok: {{ $alat->stok }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-r from-orange-50 to-red-50 p-4 rounded-xl border border-orange-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>Tanggal Pinjam
                                </label>
                                <input type="date" name="tanggal_pinjam" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            </div>
                            
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl border border-green-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar-check mr-2"></i>Tanggal Rencana Kembali
                                </label>
                                <input type="date" name="tanggal_kembali_rencana" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pastikan tanggal pengembalian sesuai dengan kebutuhan Anda
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" onclick="closePinjamModal('pinjamModal{{ $alat->id }}')" class="px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </button>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Peminjaman
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endforeach

@push('scripts')
<script>
function openPinjamModal(alatId, alatNama, stok) {

    const modal = document.getElementById('pinjamModal' + alatId);
    
    if (modal) {
        modal.classList.remove('hidden');
        modal.style.display = 'block'; // Force display
        document.body.style.overflow = 'hidden';
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        const tanggalPinjamInput = modal.querySelector('input[name="tanggal_pinjam"]');
        const tanggalKembaliInput = modal.querySelector('input[name="tanggal_kembali_rencana"]');
                
        if (tanggalPinjamInput) {
            tanggalPinjamInput.min = today;
            tanggalPinjamInput.value = today;
        }
        
        if (tanggalKembaliInput) {
            tanggalKembaliInput.min = today;
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tanggalKembaliInput.value = tomorrow.toISOString().split('T')[0];
        }
    }
}

function closePinjamModal(modalId) {
    console.log(modalId);
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('fixed') || event.target.classList.contains('bg-opacity-50')) {
        const modals = document.querySelectorAll('[id^="pinjamModal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id^="pinjamModal"]:not(.hidden)');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});
</script>
@endpush
@endsection
