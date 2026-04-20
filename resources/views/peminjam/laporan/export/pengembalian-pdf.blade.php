<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian Saya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        .info-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #495057;
        }
        .info-box p {
            margin: 5px 0;
            color: #6c757d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        .status-tepat {
            background-color: #d4edda;
            color: #155724;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
        }
        .status-terlambat {
            background-color: #f8d7da;
            color: #721c24;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>LAPORAN PENGEMBALIAN ALAT</h1>
        <p>{{ auth()->user()->username ?? auth()->user()->email }}</p>
        <p>Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
    </div>

    <div class="info-box">
        <h3>RINGKASAN PENGEMBALIAN</h3>
        <p><strong>Total Pengembalian:</strong> {{ $totalPengembalian }}</p>
        <p><strong>Tepat Waktu:</strong> {{ $tepatWaktu }}</p>
        <p><strong>Terlambat:</strong> {{ $terlambat }}</p>
        <p><strong>Total Denda:</strong> Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Alat</th>
                <th>Tanggal Kembali</th>
                <th>Telat (Hari)</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengembalians as $pengembalian)
            <tr>
                <td>{{ $pengembalian->id }}</td>
                <td>{{ $pengembalian->peminjaman->alat->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</td>
                <td>{{ $pengembalian->telat }}</td>
                <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                <td>
                    @if($pengembalian->telat > 0)
                        <span class="status-terlambat">Terlambat</span>
                    @else
                        <span class="status-tepat">Tepat Waktu</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">
                    Tidak ada data pengembalian dalam periode ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
        <p>Sistem Peminjaman Alat</p>
    </div>

</body>
</html>
