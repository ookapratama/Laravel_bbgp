<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internal extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nip',
        'jenis',
        'golongan',
        'jabatan',
        'kegiatan',
        'tempat',
        'tgl_kegiatan',
        'is_verif',
    ];
}
