<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pengembalian Alat</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background: white;
        }
        .struk {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            border: 2px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 16px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 11px;
        }
        .content {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        .content .field {
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content .field-label {
            font-weight: bold;
            color: #333;
            min-width: 120px;
        }
        .content .field-value {
            text-align: right;
            color: #000;
            flex: 1;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            border-top: 2px solid #000;
            padding-top: 15px;
        }
        .footer p {
            margin: 5px 0;
            font-size: 11px;
        }
        .button-container {
            margin-top: 15px;
            text-align: center;
        }
        .print-btn {
            background: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .gmail-btn {
            background: #ea4335;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
            padding: 20px;
            font-size: 12px;
        }
        @media print {
            body { 
                background: white; 
                padding: 0;
            }
            .struk {
                border: 1px solid #000;
                margin: 0;
                padding: 15px;
            }
            .content {
                border: 1px solid #ccc;
                background: #fff;
            }
        }
    </style>
</head>
<body>
    <div class="struk">
        @if($pengembalian)
            <div class="header">
                <h2>BUKTI PENGEMBALIAN</h2>
                <p>Sistem Peminjaman Alat</p>
            </div>
            
            <div class="content">
                <div class="field">
                    <span class="field-label">ID Pengembalian</span>
                    <span class="field-value">#{{ $pengembalian->id }}</span>
                </div>
                <div class="field">
                    <span class="field-label">Peminjam</span>
                    <span class="field-value">
                        @if($pengembalian->peminjaman && $pengembalian->peminjaman->user)
                            {{ $pengembalian->peminjaman->user->username }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field">
                    <span class="field-label">Alat</span>
                    <span class="field-value">
                        @if($pengembalian->peminjaman && $pengembalian->peminjaman->alat)
                            {{ $pengembalian->peminjaman->alat->nama }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field">
                    <span class="field-label">Jumlah</span>
                    <span class="field-value">
                        @if($pengembalian->peminjaman)
                            {{ $pengembalian->peminjaman->jumlah }} unit
                        @else
                            0 unit
                        @endif
                    </span>
                </div>
                <div class="field">
                    <span class="field-label">Tanggal Pinjam</span>
                    <span class="field-value">
                        @if($pengembalian->peminjaman)
                            {{ $pengembalian->peminjaman->tanggal_pinjam ?? '-' }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="field">
                    <span class="field-label">Tanggal Kembali</span>
                    <span class="field-value">{{ $pengembalian->tanggal_pengembalian ?? '-' }}</span>
                </div>
                <div class="field">
                    <span class="field-label">Status</span>
                    <span class="field-value">
                        @if($pengembalian->telat > 0)
                            Terlambat {{ $pengembalian->telat }} hari
                        @else
                            Tepat Waktu
                        @endif
                    </span>
                </div>
                <div class="field">
                    <span class="field-label">Kondisi Alat</span>
                    <span class="field-value">
                        @if($pengembalian->kondisi === 'rusak')
                            <span style="color: #dc2626; font-weight: bold;">RUSAK</span>
                        @else
                            <span style="color: #16a34a; font-weight: bold;">BAIK</span>
                        @endif
                    </span>
                </div>
                @if($pengembalian->denda > 0)
                <div class="field">
                    <span class="field-label">Denda</span>
                    <span class="field-value">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="field">
                    <span class="field-label">Petugas</span>
                    <span class="field-value">{{ auth()->user()->username ?? '-' }}</span>
                </div>
            </div>
            
            <div class="footer">
                <p>Terima Kasih</p>
                <p>{{ now()->format('d-m-Y H:i') }}</p>
                <div class="button-container">
                    <button onclick="window.print()" class="print-btn">
                        🖨️ Cetak
                    </button>
                    <form action="{{ route('petugas.pengembalian.kirimEmail', $pengembalian->id) }}" method="POST">
    @csrf
    <button type="submit" class="gmail-btn">
        📧 Kirim Email (PDF)
    </button>
</form>
                </div>
            </div>
        @else
            <div class="error">
                <h2>DATA PENGEMBALIAN TIDAK DITEMUKAN</h2>
                <p>Maaf, data pengembalian yang Anda cari tidak tersedia.</p>
                <p>Silakan periksa kembali ID pengembalian atau hubungi administrator.</p>
            </div>
        @endif
    </div>
    
  @if($pengembalian)
<script>
    function sendToGmail() {

        const id = '#{{ $pengembalian->id }}';
        const peminjam = '{{ $pengembalian->peminjaman->user->username ?? "-" }}';
        const alat = '{{ $pengembalian->peminjaman->alat->nama ?? "-" }}';
        const jumlah = '{{ $pengembalian->peminjaman->jumlah ?? "-" }} unit';
        const tanggalPinjam = '{{ $pengembalian->peminjaman->tanggal_pinjam ?? "-" }}';
        const tanggalKembali = '{{ $pengembalian->tanggal_pengembalian ?? "-" }}';
        const status = '{{ $pengembalian->telat > 0 ? "Terlambat $pengembalian->telat hari" : "Tepat Waktu" }}';
        const denda = '{{ $pengembalian->denda > 0 ? "Rp " . number_format($pengembalian->denda, 0, ",", ".") : "" }}';
        const petugas = '{{ auth()->user()->username ?? "-" }}';

        const emailBody = `BUKTI PENGEMBALIAN
Sistem Peminjaman Alat
================================
ID Pengembalian: ${id}
Peminjam: ${peminjam}
Alat: ${alat}
Jumlah: ${jumlah}
Tanggal Pinjam: ${tanggalPinjam}
Tanggal Kembali: ${tanggalKembali}
Status: ${status}
${denda ? `Denda: ${denda}` : ''}
Petugas: ${petugas}
================================
Terima Kasih
${new Date().toLocaleString('id-ID')}`;

        const subject = encodeURIComponent('Bukti Pengembalian Alat - #{{ $pengembalian->id }}');
        const body = encodeURIComponent(emailBody);

        const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=&su=${subject}&body=${body}`;

        window.open(gmailUrl, '_blank');
    }

</script>
@endif
</body>
</html>
