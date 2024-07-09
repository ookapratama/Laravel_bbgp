<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peserta_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->string('no_ktp');
            $table->string('signature')->nullable();
            $table->enum('status_keikutpesertaan', ['peserta', 'panitia', 'narasumber']);
            $table->string('instansi');
            $table->string('golongan');
            $table->enum('jkl', ['Laki-laki', 'Perempuan']);
            $table->string('kelengkapan_peserta_transport');
            $table->string('kelengkapan_peserta_biodata');
            $table->string('no_hp');
            $table->string('no_wa');
            $table->string('kabupaten');
            $table->string('no_surat_tugas')->nullable();
            $table->date('tgl_surat_tugas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_kegiatans');
    }
};
