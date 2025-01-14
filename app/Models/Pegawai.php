<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public $timestamps = false;
    protected $table = 'pegawais';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'jabatan',
        'gaji',
        'alamat',
        'tanggal_lahir',
        'email',
        'password',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_pegawai');
    }


}
