<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'stok',
        'harga_denda',
        'kondisi_baik',
        'kondisi_rusak',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Accessor untuk nama alat
    public function getNamaAttribute()
    {
        return $this->nama_alat;
    }
}
