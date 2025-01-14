<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'transfers';
    protected $primaryKey = 'no_transfer';

    protected $fillable = [
        'nomor_rekening',
        'rekening_tujuan',
        'jenis_transfer',
        'jumlah_transfer',
        'tanggal_transfer',
        'deskripsi'
    ];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'nomor_rekening');
    }   

    
}
