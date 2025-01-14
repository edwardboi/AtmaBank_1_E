<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    // public $timestamps = false;
    protected $table = 'rekenings';
    protected $primaryKey = 'nomor_rekening';

    protected $fillable = [
        'tipe_rekening',
        'saldo',
        'id_nasabah',
        'tujuan',
        'income',
        'pin',
        'id_pegawai',
    ];

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'id_nasabah');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'nomor_rekening');
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }
}
