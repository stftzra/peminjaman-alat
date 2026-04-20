<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .stat-box {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 18%;
        }
        .stat-box h3 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .stat-box p {
            margin: 5px 0 0;
            color: #666;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-disetujui {
            background-color: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-dipinjam {
            background-color: #cce5ff;
            color: #004085;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-selesai {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            z-index: 1000;
        }
        .print-button:hover {
            background: #0056b3;
        }
        @media print {
            .print-button {
                display: none;
            }
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak / Save PDF
    </button>

    <div class="header">
        <h1>LAPORAN PEMINJAMAN ALAT</h1>
        <p>Sistem Peminjaman Alat - Petugas</p>
        <p>Periode: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h3>{{ $totalPeminjaman }}</h3>
            <p>Total Peminjaman</p>
        </div>
        <div class="stat-box">
            <h3>{{ $menunggu }}</h3>
            <p>Menunggu</p>
        </div>
        <div class="stat-box">
            <h3>{{ $disetujui }}</h3>
            <p>Disetujui</p>
        </div>
        <div class="stat-box">
            <h3>{{ $dipinjam }}</h3>
            <p>Sedang Dipinjam</p>
        </div>
        <div class="stat-box">
            <h3>{{ $selesai }}</h3>
            <p>Selesai Dikembalikan</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Peminjaman</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>#{{ $peminjaman->id }}</td>
                <td>{{ $peminjaman->user->username ?? '-' }}</td>
                <td>{{ $peminjaman->alat->nama_alat ?? '-' }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->batas_kembali }}</td>
                <td>
                    @if($peminjaman->status == 'selesai' && $peminjaman->pengembalian)
                        {{ $peminjaman->pengembalian->tanggal_kembali }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($peminjaman->status == 'menunggu')
                        <span class="status-menunggu">Menunggu</span>
                    @elseif($peminjaman->status == 'disetujui')
                        <span class="status-disetujui">Disetujui</span>
                    @elseif($peminjaman->status == 'dipinjam')
                        <span class="status-dipinjam">Dipinjam</span>
                    @elseif($peminjaman->status == 'selesai')
                        <span class="status-selesai">Selesai</span>
                    @else
                        <span class="status-menunggu">{{ $peminjaman->status }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; padding: 20px;">
                    <strong>Tidak ada data peminjaman</strong><br>
                    <small>Belum ada pengajuan peminjaman saat ini</small>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Laporan ini dicetak secara otomatis pada {{ date('d F Y H:i:s') }}</strong></p>
        <p>© 2024 Sistem Peminjaman Alat - Laporan Petugas</p>
    </div>

    <script>
        // Auto print saat halaman dibuka
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>
</html>
