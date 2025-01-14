<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'peminjamans';
    protected $primaryKey = 'no_peminjaman';

    protected $fillable = [
        'suku_bunga',
        'periode_peminjaman',
        'status_peminjaman',
        'jumlah_peminjaman',
        'tanggal_peminjaman',
        'tanggal_pelunasan',
        'nomor_rekening',
        'id_pegawai',
    ];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'nomor_rekening');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
