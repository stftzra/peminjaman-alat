<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian Alat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 20px;
            background: #f9f9f9;
            border-radius: 0 0 10px 10px;
        }
        .pengembalian-item {
            background: white;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-tepat-waktu { background: #28a745; color: white; }
        .status-terlambat { background: #dc3545; color: white; }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #f1f3f4;
            border-radius: 8px;
            font-size: 14px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔄 Laporan Pengembalian Alat</h1>
        <p>Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
        <p>Dikirim ke: {{ $user->email }}</p>
    </div>

    <div class="content">
        <h2>📋 Ringkasan Pengembalian</h2>
        <p>Berikut adalah ringkasan pengembalian alat yang telah Anda lakukan:</p>
        
        @foreach($pengembalians as $pengembalian)
        <div class="pengembalian-item">
            <table>
                <tr>
                    <td><strong>ID Pengembalian:</strong></td>
                    <td>{{ $pengembalian->id }}</td>
                </tr>
                <tr>
                    <td><strong>Alat:</strong></td>
                    <td>{{ $pengembalian->peminjaman->alat->nama }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Kembali:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Telat:</strong></td>
                    <td>{{ $pengembalian->telat }} hari</td>
                </tr>
                <tr>
                    <td><strong>Denda:</strong></td>
                    <td>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>

    <div class="footer">
        <p>📧 Email ini dikirim otomatis oleh Sistem Peminjaman Alat</p>
        <p>📅 Tanggal: {{ now()->format('d M Y H:i') }}</p>
        <p>🔗 <a href="{{ url('/login') }}">Login ke Sistem</a></p>
    </div>
</body>
</html>
