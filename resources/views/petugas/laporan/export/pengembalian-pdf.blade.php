<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengembalian</title>
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
        .status-tepat {
            background-color: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-telat {
            background-color: #f8d7da;
            color: #721c24;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .denda-ada {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .denda-tidak {
            background-color: #e2e3e5;
            color: #383d41;
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
        <h1>LAPORAN PENGEMBALIAN ALAT</h1>
        <p>Sistem Peminjaman Alat</p>
        <p>Periode: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h3>{{ $totalPengembalian }}</h3>
            <p>Total Pengembalian</p>
        </div>
        <div class="stat-box">
            <h3>{{ $tepatWaktu }}</h3>
            <p>Tepat Waktu</p>
        </div>
        <div class="stat-box">
            <h3>{{ $terlambat }}</h3>
            <p>Terlambat</p>
        </div>
        <div class="stat-box">
            <h3>Rp {{ number_format($totalDenda) }}</h3>
            <p>Total Denda</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Kembali</th>
                <th>Telat</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengembalians as $index => $pengembalian)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>#{{ $pengembalian->id }}</td>
                <td>{{ $pengembalian->peminjaman->user->name ?? '-' }}</td>
                <td>{{ $pengembalian->peminjaman->user->email ?? '-' }}</td>
                <td>{{ $pengembalian->peminjaman->alat->nama_alat ?? '-' }}</td>
                <td>{{ $pengembalian->peminjaman->jumlah }}</td>
                <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                <td>
                    @if($pengembalian->telat > 0)
                        <span class="status-telat">{{ $pengembalian->telat }} hari</span>
                    @else
                        <span class="status-tepat">Tepat waktu</span>
                    @endif
                </td>
                <td>
                    @if($pengembalian->denda > 0)
                        <span class="denda-ada">Rp {{ number_format($pengembalian->denda) }}</span>
                    @else
                        <span class="denda-tidak">Tidak ada</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; padding: 20px;">
                    Tidak ada data pengembalian
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dicetak secara otomatis pada {{ date('d F Y H:i:s') }}</p>
        <p>© 2024 Sistem Peminjaman Alat</p>
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
