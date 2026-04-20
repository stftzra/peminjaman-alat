<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Alat</title>
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
        .peminjaman-item {
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
        .status-menunggu { background: #ffc107; color: #856404; }
        .status-disetujui { background: #28a745; color: white; }
        .status-dipinjam { background: #17a2b8; color: white; }
        .status-selesai { background: #6c757d; color: white; }
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
        <h1>📊 Laporan Peminjaman Alat</h1>
        <p>Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
        <p>Dikirim ke: {{ $user->email }}</p>
    </div>

    <div class="content">
        <h2>📋 Ringkasan Peminjaman</h2>
        <p>Berikut adalah ringkasan peminjaman alat Anda dalam periode yang dipilih:</p>
        
        @foreach($peminjamans as $peminjaman)
        <div class="peminjaman-item">
            <table>
                <tr>
                    <td><strong>ID Peminjaman:</strong></td>
                    <td>{{ $peminjaman->id }}</td>
                </tr>
                <tr>
                    <td><strong>Alat:</strong></td>
                    <td>{{ $peminjaman->alat->nama }}</td>
                </tr>
                <tr>
                    <td><strong>Jumlah:</strong></td>
                    <td>{{ $peminjaman->jumlah }} unit</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Pinjam:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Kembali:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td><strong>Status:</strong></td>
                    <td>
                        <span class="status status-{{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </td>
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
