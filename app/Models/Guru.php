<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_ktp',
        'nip',
        'tempat_lahir',
        'tgl_lahir',
        'gender',
        'jabatan',
        'status',
        'agama',
        'pendidikan',
        'kabupaten',
        'satuan_pendidikan',
        'alamat_satuan',
        'alamat_rumah',
        'no_hp',
        'no_wa',
        'pas_foto',
        'no_rek',
    ];
}
