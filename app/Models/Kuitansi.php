<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kuitansi extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_bukti',
        'tahun_anggaran',
        'no_MAK',
        'biaya_penginapan',
        'biaya_uang_harian',
        'durasi_penginapan',
        'durasi_uang_harian',
        'total_biaya_penginapan',
        'total_biaya_harian',
        'kategori'
    ];
    public function transportasis()
    {
        return $this->hasMany(Transportasi::class);
    }
}
