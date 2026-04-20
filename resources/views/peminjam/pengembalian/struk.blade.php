<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pengembalian Alat</title>
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
            border-left: 4px solid #28a745;
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
            color: #28a745;
            display: block;
            margin-bottom: 5px;
        }
        .denda-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            text-align: center;
        }
        .denda-box h3 {
            color: #856404;
            margin: 0 0 10px 0;
        }
        .denda-amount {
            font-size: 24px;
            font-weight: bold;
            color: #dc3545;
        }
        .status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        .status-tepat {
            background: #d4edda;
            color: #155724;
        }
        .status-terlambat {
            background: #f8d7da;
            color: #721c24;
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
            <h1>🔄 STRUK PENGEMBALIAN ALAT</h1>
            <p>No. {{ $pengembalian->id }}</p>
        </div>
        
        <div class="content">
            <div class="info-box">
                <h3>📋 Informasi Pengembalian</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama Pengembali</strong>
                        {{ auth()->user()->username ?? auth()->user()->email }}
                    </div>
                    <div class="info-item">
                        <strong>Tanggal Kembali</strong>
                        {{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d F Y - H:i') }}
                    </div>
                    <div class="info-item">
                        <strong>Status Kembali</strong>
                        <span class="status {{ $pengembalian->telat > 0 ? 'status-terlambat' : 'status-tepat' }}">
                            {{ $pengembalian->telat > 0 ? 'Terlambat' : 'Tepat Waktu' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <strong>Telat</strong>
                        {{ $pengembalian->telat }} hari
                    </div>
                </div>
            </div>
            
            <div class="info-box">
                <h3>🔧 Detail Alat</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama Alat</strong>
                        {{ $pengembalian->peminjaman->alat->nama }}
                    </div>
                    <div class="info-item">
                        <strong>Kode Alat</strong>
                        {{ $pengembalian->peminjaman->alat->kode ?? '-' }}
                    </div>
                    <div class="info-item">
                        <strong>Kategori</strong>
                        {{ $pengembalian->peminjaman->alat->kategori->nama }}
                    </div>
                    <div class="info-item">
                        <strong>Jumlah</strong>
                        {{ $pengembalian->peminjaman->jumlah }} unit
                    </div>
                </div>
            </div>
            
            @if($pengembalian->denda > 0)
            <div class="denda-box">
                <h3>💰 Denda Keterlambatan</h3>
                <div class="denda-amount">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</div>
                <p style="margin-top: 10px; font-size: 12px;">*Denda dihitung: {{ $pengembalian->telat }} hari × Rp {{ number_format($pengembalian->peminjaman->alat->harga_denda, 0, ',', '.') }}/hari</p>
            </div>
            @endif
            
            <div class="barcode">
                <p style="margin-bottom: 10px; color: #666;">Kode Pengembalian:</p>
                <div class="barcode-number">{{ str_pad($pengembalian->id, 8, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>📅 Dicetak:</strong> {{ now()->format('d F Y - H:i') }}</p>
            <p><strong>📍 Lokasi:</strong> Gudang Alat</p>
            <p><strong>📞 Kontak:</strong> 0812-3456-7890</p>
            <p style="margin-top: 10px; font-size: 10px;">*Terima kasih telah mengembalikan alat dengan baik</p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
