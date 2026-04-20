<!DOCTYPE html>
<html>
<head>
    <title>Laporan Alat</title>
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
        .status-tersedia {
            background-color: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-terbatas {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-habis {
            background-color: #f8d7da;
            color: #721c24;
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
        <h1>LAPORAN DATA ALAT</h1>
        <p>Sistem Peminjaman Alat</p>
        <p>Tanggal: {{ date('d F Y') }}</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h3>{{ $totalAlat }}</h3>
            <p>Total Alat</p>
        </div>
        <div class="stat-box">
            <h3>{{ $tersedia }}</h3>
            <p>Tersedia</p>
        </div>
        <div class="stat-box">
            <h3>{{ $stokRendah }}</h3>
            <p>Stok Rendah</p>
        </div>
        <div class="stat-box">
            <h3>{{ $habis }}</h3>
            <p>Habis</p>
        </div>
        <div class="stat-box">
            <h3>{{ $totalStok }}</h3>
            <p>Total Stok</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alats as $index => $alat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $alat->nama_alat }}</td>
                <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $alat->stok }}</td>
                <td>
                    @if($alat->stok == 0)
                        <span class="status-habis">Stok Habis</span>
                    @elseif($alat->stok <= 5)
                        <span class="status-terbatas">Stok Terbatas</span>
                    @else
                        <span class="status-tersedia">Tersedia</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">
                    Tidak ada data alat
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
