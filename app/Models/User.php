<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    // public $timestamps = false;
    protected $table = 'users';
    protected $primaryKey = 'id_nasabah';

    protected $fillable = [
        'nama_nasabah',
        'email',
        'alamat',
        'nomor_telepon',
        'tanggal_lahir',
        'password',
        'foto_profile',
        'id_number',
        'foto_idnumber'
    ];

    public function rekening()
    {
        return $this->hasOne(Rekening::class, 'id_nasabah');
    }

}
