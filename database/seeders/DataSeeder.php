<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Pegawai::create([
                'nama_lengkap' => 'Pegawai ' . $i,
                'email' => 'pegawai' . $i . '@example.com',
                'no_ktp' => '1234567890' . $i,
                'nip' => '0987654321' . $i,
                'tempat_lahir' => 'Tempat Lahir ' . $i,
                'tgl_lahir' => '1990-01-01',
                'gender' => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'jabatan' => 'Jabatan ' . $i,
                'status' => $i % 2 == 0 ? 'Kawin' : 'Belum Kawin',
                'status_kepegawaian' => $i % 2 == 0 ? 'PNS' : 'Non-PNS',
                'agama' => $i % 3 == 0 ? 'Islam' : ($i % 3 == 1 ? 'Kristen' : 'Katolik'),
                'pendidikan' => 'S1',
                'kabupaten' => 'Kabupaten ' . $i,
                'satuan_pendidikan' => 'Universitas ' . $i,
                'alamat_satuan' => 'Jl. Universitas ' . $i . ' No. ' . $i,
                'alamat_rumah' => 'Jl. Rumah ' . $i . ' No. ' . $i,
                'no_hp' => '08123456789' . $i,
                'no_wa' => '08123456789' . $i,
                'pas_foto' => 'default.jpg',
                'no_rek' => '1234567890' . $i,
                'is_verif' => $i <= 3 ? 'sudah' : 'belum',
            ]);
        }

        // Generate 10 Guru
        for ($i = 1; $i <= 10; $i++) {
            Guru::create([
                'nama_lengkap' => 'John Doe ' . $i,
                'email' => 'john' . $i . '@example.com',
                'no_ktp' => '1234567890' . $i,
                'nip' => '0987654321' . $i,
                'tempat_lahir' => 'Tempat Lahir ' . $i,
                'tgl_lahir' => '1990-01-01',
                'gender' => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'jabatan' => 'Jabatan ' . $i,
                'status' => $i % 2 == 0 ? 'Kawin' : 'Belum Kawin',
                'status_kepegawaian' => $i % 2 == 0 ? 'PNS' : 'Guru Bantu Sekolah',
                'agama' => $i % 3 == 0 ? 'Islam' : ($i % 3 == 1 ? 'Kristen' : 'Katolik'),
                'pendidikan' => 'S1',
                'kabupaten' => $i % 2 == 0 ? 'Kabupaten Soppeng' : 'Kabupaten Toraja Utara',
                'satuan_pendidikan' => $i % 2 == 0 ? 'SPS' : 'SMA Negeri',
                'alamat_satuan' => 'Jl. Universitas ' . $i . ' No. ' . $i++,
                'alamat_rumah' => 'Jl. Rumah ' . $i . ' No. ' . $i,
                'no_hp' => '08123456789' . $i,
                'no_wa' => '08123456789' . $i,
                'pas_foto' => '',
                'no_rek' => '1234567890' . $i,
                'npsn_sekolah' => '1234567890' . $i,
                'npwp' => '2343290' . $i,
                'nuptk' => '7267890' . $i,
                'eksternal_jabatan' => $i % 3 == 0 ? 'Tenaga Pendidik' : ($i % 3 == 1 ? 'Stakeholder' : 'Tenaga Kependidikan'),
                'jenis_jabatan' => $i % 3 == 0 ? 'Konselor' : ($i % 3 == 1 ? 'Kepala Sekolah' : 'Pengawas'),
                'kategori_jabatan' => $i % 3 == 0 ? 'GP (Guru Penggerak)' : 'NoN GP (Guru Penggerak)',
                'tugas_jabatan' => $i % 3 == 0 ? 'Fasil (Fasilitator)' : ($i % 3 == 1 ? 'PP (Pengajar Praktik)' : 'Instruktur'),
                'is_verif' => $i <= 5 ? 'sudah' : 'belum',
            ]);
        }
    }
}
