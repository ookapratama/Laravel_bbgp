<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\InternalPpnpn;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Internal;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = array(
            'guruGP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')->where('jenis_jabatan', 'Guru')->get()->count(),
            'konselorGP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')->where('jenis_jabatan', 'Konselor')->get()->count(),
            'pengawasGP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')->where('jenis_jabatan', 'Pengawas')->get()->count(),

            'kepsekGP' => Guru::where('tugas_jabatan', 'GP (Guru Penggerak)')
                ->where('jenis_jabatan', 'Kepala Sekolah')->get()->count(),

            'kepsekSertifGP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak))')->
                where('jenis_jabatan', 'Kepala Sekolah')->
                where('tugas_jabatan', 'GP (Guru Penggerak)')->get()->count(),

            'kepsekCakep' => Guru::where('kategori_jabatan', 'Diklat Cakep')
                ->where('jenis_jabatan', 'Kepala Sekolah')
                ->where('tugas_jabatan', 'GP (Guru Penggerak)')->get()->count(),

            'kepsekLainGP' => Guru::where('kategori_jabatan', 'Diklat Cakep')->where('jenis_jabatan', 'Kepala Sekolah')
                ->where('tugas_jabatan', 'GP (Guru Penggerak)')->get()->count(),


            'pengawasCawas' => Guru::where('kategori_jabatan', 'Diklat Cawas')
                ->where('jenis_jabatan', 'Pengawas')
                ->where('tugas_jabatan', 'GP (Guru Penggerak)')->get()->count(),

            'pengawasSertifGP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')
                ->where('jenis_jabatan', 'Pengawas')
                ->where('tugas_jabatan', 'GP (Guru Penggerak)')->get()->count(),

            'pengawasLainGP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')
                ->where('jenis_jabatan', 'Pengawas')
                ->where('tugas_jabatan', 'GP (Guru Penggerak)')->get()->count(),

            'guruPP' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')
                ->where('jenis_jabatan', 'Guru')
                ->where('tugas_jabatan', 'PP (Pengajar Praktik)')->get()->count(),

            'guruFasil' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')
                ->where('jenis_jabatan', 'Guru')
                ->where('tugas_jabatan', 'Fasil (Fasilitator)')->get()->count(),

            'guruInstruktur' => Guru::where('kategori_jabatan', 'GP (Guru Penggerak)')
                ->where('jenis_jabatan', 'Guru')
                ->where('tugas_jabatan', 'Instruktur')->get()->count(),

            // 'jadwalLokakarya' => Internal::where('jenis', 'Penugasan Lokakarya')->get(),

        );
        // dd($datas['jadwalLokakarya']);

        return view('pages.admin.dashboard.index', ['menu' => 'dashboard', 'datas' => $datas]);
    }

    public function jadwal()
    {
        // Ambil jadwal dari Internal
        $jadwalLokakarya = Internal::select('jenis','deskripsi','kegiatan', 'tgl_kegiatan', 'tgl_selesai_kegiatan', 'jam_mulai', 'jam_selesai', 'nama')
            ->where('jenis', 'Pendamping Lokakarya')
            ->get();

        // Ambil jadwal dari InternalPpnpn dengan relasi ke PegawaiPpnpn
        $jadwalPpnpn = InternalPpnpn::with('pegawai:id,nama')
            ->select('deskripsi','kegiatan', 'tgl_kegiatan', 'tgl_selesai_kegiatan', 'jam_mulai', 'jam_selesai', 'id_pegawai')
            ->get()
            ->map(function ($item) {
                return [
                    'kegiatan' => $item->kegiatan,
                    'tgl_kegiatan' => $item->tgl_kegiatan,
                    'tgl_selesai_kegiatan' => $item->tgl_selesai_kegiatan,
                    'nama' => $item->pegawai->nama,
                ];
            });

        // Ambil jadwal dari Lokakarya (misalkan ini adalah tabel lain)
        $jadwalInternal = Internal::select('jenis','deskripsi','kegiatan as kegiatan', 'tgl_kegiatan', 'jam_mulai', 'jam_selesai', 'tgl_selesai_kegiatan', 'nama')
            ->get();

        // Gabungkan jadwal menggunakan collect() untuk mengonversi ke koleksi
        $combinedJadwal = collect($jadwalLokakarya)
            ->merge($jadwalPpnpn)
            ->merge($jadwalInternal);
        // dd($combinedJadwal);
        return response()->json([
            'jadwal' => $combinedJadwal
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function profile($id)
    {
        $data = Admin::find($id);
        return view('pages.admin.profile.index', ['menu' => 'profile', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function profile_update(Request $request)
    {
        $r = $request->all();

        $admin = Admin::find($r['id']);
        $user = User::find($r['id']);
        if ($r['password'] != null) {
            $r['password'] = bcrypt($r['password']);
            // dump('ubah password');
        } else {
            $r['password'] = $r['oldPassword'];
        }
        // dd(true);

        $admin->update($r);
        $user->update($r);

        return redirect()->route('dashboard')->with('message', 'update profile');

    }

    public function getJadwalByPegawai($nik)
    {
        // Ambil jadwal dari Internal hanya untuk pegawai dengan NIK tertentu
        $jadwalLokakarya = Internal::select('jenis','deskripsi','kegiatan', 'tgl_kegiatan', 'tgl_selesai_kegiatan', 'jam_mulai', 'jam_selesai', 'nama')
            ->where('jenis', 'Pendamping Lokakarya')
            ->where('nik', $nik)
            ->get();

        // Ambil jadwal dari InternalPpnpn dengan relasi ke PegawaiPpnpn hanya untuk pegawai dengan NIK tertentu
        $jadwalPpnpn = InternalPpnpn::with([
            'pegawai' => function ($query) use ($nik) {
                $query->where('nik', $nik);
            }
        ])
            ->select('deskripsi','kegiatan', 'tgl_kegiatan', 'tgl_selesai_kegiatan', 'jam_mulai', 'jam_selesai', 'id_pegawai')
            ->get()
            ->filter(function ($item) {
                return $item->pegawai !== null; // Pastikan pegawai terkait ada
            })
            ->map(function ($item) {
                return [
                    'kegiatan' => $item->kegiatan,
                    'tgl_kegiatan' => $item->tgl_kegiatan,
                    'tgl_selesai_kegiatan' => $item->tgl_selesai_kegiatan,
                    'jam_mulai' => $item->jam_mulai,
                    'jam_selesai' => $item->jam_selesai,
                    'nama' => $item->pegawai->nama,
                ];
            });

        // Ambil jadwal dari Lokakarya (misalkan ini adalah tabel lain) hanya untuk pegawai dengan NIK tertentu
        $jadwalInternal = Internal::select('jenis','deskripsi','kegiatan as kegiatan', 'tgl_kegiatan', 'jam_mulai', 'jam_selesai', 'tgl_selesai_kegiatan', 'nama')
            ->where('nik', $nik)
            ->get();

        // Gabungkan jadwal menggunakan collect() untuk mengonversi ke koleksi
        $combinedJadwal = collect($jadwalLokakarya)
            ->merge($jadwalPpnpn)
            ->merge($jadwalInternal);

        return response()->json([
            'jadwal' => $combinedJadwal
        ]);
    }


}
