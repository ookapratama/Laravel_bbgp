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
                'nama_lengkap' => 'Guru ' . $i,
                'email' => 'guru' . $i . '@example.com',
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
    }
}
