<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Peminjaman Alat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 18px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        .info-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        .info-item strong {
            color: #667eea;
            display: block;
            margin-bottom: 5px;
        }
        .status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        .status-menunggu {
            background: #ffc107;
            color: #856404;
        }
        .status-disetujui {
            background: #28a745;
            color: white;
        }
        .status-dipinjam {
            background: #17a2b8;
            color: white;
        }
        .status-selesai {
            background: #6c757d;
            color: white;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #6c757d;
            font-size: 12px;
        }
        .barcode {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .barcode-number {
            font-family: 'Courier New', monospace;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            background: white;
            padding: 10px 20px;
            border: 2px solid #333;
            display: inline-block;
        }
        @media print {
            body { background: white; }
            .container { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 STRUK PEMINJAMAN ALAT</h1>
            <p>No. {{ $peminjaman->id }}</p>
        </div>
        
        <div class="content">
            <div class="info-box">
                <h3>📋 Informasi Peminjaman</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama Peminjam</strong>
                        {{ auth()->user()->username ?? auth()->user()->email }}
                    </div>
                    <div class="info-item">
                        <strong>Tanggal Pinjam</strong>
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d F Y - H:i') }}
                    </div>
                    <div class="info-item">
                        <strong>Rencana Kembali</strong>
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->format('d F Y') }}
                    </div>
                    <div class="info-item">
                        <strong>Status</strong>
                        <span class="status status-{{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="info-box">
                <h3>🔧 Detail Alat</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama Alat</strong>
                        {{ $peminjaman->alat->nama }}
                    </div>
                    <div class="info-item">
                        <strong>Kode Alat</strong>
                        {{ $peminjaman->alat->kode ?? '-' }}
                    </div>
                    <div class="info-item">
                        <strong>Kategori</strong>
                        {{ $peminjaman->alat->kategori->nama }}
                    </div>
                    <div class="info-item">
                        <strong>Jumlah</strong>
                        {{ $peminjaman->jumlah }} unit
                    </div>
                </div>
            </div>
            
            <div class="barcode">
                <p style="margin-bottom: 10px; color: #666;">Kode Peminjaman:</p>
                <div class="barcode-number">{{ str_pad($peminjaman->id, 8, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>📅 Dicetak:</strong> {{ now()->format('d F Y - H:i') }}</p>
            <p><strong>📍 Lokasi:</strong> Gudang Alat</p>
            <p><strong>📞 Kontak:</strong> 0812-3456-7890</p>
            <p style="margin-top: 10px; font-size: 10px;">*Harap membawa alat sesuai kondisi saat dikembalikan</p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
