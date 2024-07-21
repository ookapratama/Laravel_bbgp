<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Guru;
use App\Models\Internal;
use App\Models\Jabatan;
use App\Models\JabatanKependidikan;
use App\Models\JabatanPendidik;
use App\Models\JabatanStakeHolder;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kepegawaian;
use App\Models\Pegawai;
use App\Models\Pendamping;
use App\Models\Pendidikan;
use App\Models\SatuanPendidikan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = array(
            'berita' => Berita::orderByDesc('id')->skip(0)->take(10)->get(),
            'agenda' => Agenda::orderByDesc('id')->skip(0)->take(10)->get(),
        );

        // dd($datas);
        // return view('pages.user.index', ['menu' => 'profil']);
        return view('pages.landing.index', ['menu' => 'profil'], compact('datas'));
    }

    public function kontak()
    {
        return view('pages.landing.kontak', ['menu' => 'kontak']);
        // return view('pages.user.kontak', ['menu' => 'kontak']);
    }


    public function guru()
    {
        $datas = Guru::where('is_verif', 'sudah')->orderBy('id', 'DESC')->get();
        // $sekolahs = [];
        // Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
        // ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
        //     foreach ($sekolahChunk as $sekolah) {
        //         $sekolahs[] = $sekolah;
        //     }
        // });
        // $datas = array(
        //     's_kepegawaian' => Kepegawaian::get(),
        //     's_kependidikan' => SatuanPendidikan::get(),
        //     's_gelar' => Pendidikan::get(),
        //     's_jabatan' => Jabatan::get(),
        //     's_kabupaten' => Kabupaten::get(),
        //     's_kecamatan' => Kecamatan::get(),
        //     's_sekolah' => Sekolah::get(),

        //     // 's_sekolah' => $sekolahs,
        //     // 's_jabPendidik' => JabatanPendidik::get(),
        //     // 's_jabKependidikan' => JabatanKependidikan::get(),
        //     // 's_jabStakeholder' => JabatanStakeHolder::get(),
        //     // 's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
        //     // 's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

        // );

        $status = array(
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabKategoriPengawas' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cawas', 'Lainnya'],
            's_jabKategoriKepsek' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cakep', 'Lainnya'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],
        );
        return view('pages.landing.eksternal.index', ['menu' => 'data', 'datas' => $datas, 'status' => $status]);
        // return view('pages.user.guru', ['menu' => 'guru', 'datas' => $datas, 'status' => $status]);
    }

    public function pegawai()
    {
        // $data = Pegawai::where('is_verif', 'sudah')->orderBy('id', 'DESC')->get();
        $kota = Kabupaten::get();
        // $data = Internal::get();
        $data = array(

            'dataPenugasanPegawai' => Internal::where('jenis', 'Penugasan Pegawai')->get(),
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
        );
        $dataPendamping = Pendamping::get();
        // $merge = $data->merge($dataPendamping);
        return view('pages.landing.internal.index', ['menu' => 'data', 'datas' => $data, 'dataPendamping' => $dataPendamping]);
        // return view('pages.user.pegawai', ['menu' => 'pegawai', 'datas' => $data, 'dataPendamping' => $dataPendamping]);
    }
    public function form_pegawai()
    {
        $data = Pegawai::get();
        return view('pages.landing.eksternal.form', ['menu' => 'data']);
        // return view('pages.user.formPegawai', ['menu' => 'pegawai']);
    }
    public function daftar_pegawai(Request $request)
    {
        $r = $request->all();
        // $foto = $request->file('pas_foto');
        // $ext = $foto->getClientOriginalExtension();
        // // $r['pas_foto'] = $request->file('pas_foto');

        // $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        // $destinationPath = public_path('upload/pegawai');

        // $foto->move($destinationPath, $nameFoto);

        // $fileUrl = asset('upload/pegawai/' . $nameFoto);

        // $r['pas_foto'] = $nameFoto;
        // dd($r);
        $r['pas_foto'] = '';
        $r['status'] = 'Belum Kawin';
        $r['alamat_satuan'] = '';
        $r['eksternal_jabatan'] = $r['jenisJabatan'];
        $r['jenis_jabatan'] = $r['jabJenis'];
        $r['kategori_jabatan'] = $r['jabKategori'];
        $r['tugas_jabatan'] = $r['jabTugas'];
        $r['is_verif'] = 'belum';

        Pegawai::create($r);

        return redirect()->route('user.pegawai')->with('message', 'user daftar');
    }
    public function form_guru($jenis)
    {

        $sekolahs = [];
        Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
            ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
                foreach ($sekolahChunk as $sekolah) {
                    $sekolahs[] = $sekolah;
                }
            });

        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            // 's_sekolah' => Sekolah::get(),

            's_sekolah' => $sekolahs,
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabKategoriPengawas' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cawas', 'Lainnya'],
            's_jabKategoriKepsek' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cakep', 'Lainnya'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

        );
        $data = Guru::get();
        return view('pages.landing.eksternal.form', ['menu' => 'guru', 'status' => $datas, 'jenis' => $jenis]);
        // return view('pages.user.formGuru', ['menu' => 'guru', 'status' => $datas, 'jenis' => $jenis]);
    }
    public function daftar_guru(Request $request)
    {
        $r = $request->all();
        // $foto = $request->file('pas_foto');
        // $ext = $foto->getClientOriginalExtension();
        // // $r['pas_foto'] = $request->file('pas_foto');

        // $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        // $destinationPath = public_path('upload/guru');

        // $foto->move($destinationPath, $nameFoto);

        // $fileUrl = asset('upload/guru/' . $nameFoto);

        // $r['pas_foto'] = $nameFoto;
        // dd($r);
        $r['jabatan'] = '';
        $r['pas_foto'] = '';
        $r['status'] = 'Belum Kawin';
        $r['alamat_satuan'] = '';
        $r['eksternal_jabatan'] = $r['jenisJabatan'] ?? '';
        $r['jenis_jabatan'] = $r['jabJenis'] ?? '';
        $r['kategori_jabatan'] = $r['jabKategori'] ?? '';
        $r['tugas_jabatan'] = $r['jabTugas'] ?? '';
        $r['is_verif'] = 'belum';



        Guru::create($r);

        // akun login



        return redirect()->route('user.guru')->with('message', 'user daftar');
    }
}
