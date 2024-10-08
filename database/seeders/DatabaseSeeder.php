<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LatarJabatan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(StatusKepegawaianSeeder::class);
        $this->call(StatusPendidikanSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(KabupatenSeeder::class);
        $this->call(KecamatanSeeder::class);
        // $this->call(SekolahSeeder::class);
        $this->call(JabatanPendidikSeeder::class);
        $this->call(JabatanKependidikanSeeder::class);
        $this->call(JabatanStakeHolderSeeder::class);
        $this->call(JenisTugasSeeder::class);
        $this->call(LatarJabatanSeeder::class);
        $this->call(JabatanPenugasanSeeder::class);
    }
}
