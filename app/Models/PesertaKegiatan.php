<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKegiatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kegiatan',
        'id_pegawai',
        // 'no_ktp',
        'signature',
        'status_keikutpesertaan',
        // 'instansi',
        // 'golongan',
        // 'jkl',
        'kelengkapan_peserta_transport',
        'kelengkapan_peserta_biodata',
        // 'no_hp',
        // 'no_wa',
        // 'kabupaten',
        // 'jam_mengajar',
        // 'jam_selesai',
        'no_surat_tugas',
        'tgl_surat_tugas',
    ];

    public function kegiatan() {
        return $this->hasOne(Kegiatan::class, 'id', 'id_kegiatan');
    }

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
    }

}
