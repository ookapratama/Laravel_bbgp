<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jabatan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kepegawaian;
use App\Models\Pegawai;
use App\Models\Pendidikan;
use App\Models\SatuanPendidikan;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.user.index', ['menu' => 'profil']);
    }

    public function kontak()
    {
        return view('pages.user.kontak', ['menu' => 'kontak']);
    }


    public function guru()
    {
        $data = Guru::where('is_verif', 'sudah')->orderBy('id', 'DESC')->get();
        return view('pages.user.guru', ['menu' => 'guru', 'datas' => $data]);
    }

    public function pegawai()
    {
        $data = Pegawai::where('is_verif', 'sudah')->orderBy('id', 'DESC')->get();
        return view('pages.user.pegawai', ['menu' => 'pegawai', 'datas' => $data]);
    }
    public function form_pegawai()
    {
        $data = Pegawai::get();
        return view('pages.user.formPegawai', ['menu' => 'pegawai']);
    }
    public function daftar_pegawai(Request $request)
    {
        $r = $request->all();
        $foto = $request->file('pas_foto');
        $ext = $foto->getClientOriginalExtension();
        // $r['pas_foto'] = $request->file('pas_foto');

        $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        $destinationPath = public_path('upload/pegawai');

        $foto->move($destinationPath, $nameFoto);

        $fileUrl = asset('upload/pegawai/' . $nameFoto);

        $r['pas_foto'] = $nameFoto;
        // dd($r);
        $r['is_verif'] = 'belum';

        Pegawai::create($r);

        return redirect()->route('user.pegawai')->with('message', 'user daftar');
    }
    public function form_guru()
    {
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            's_sekolah' => Sekolah::get(),

        );
        $data = Guru::get();
        return view('pages.user.formGuru', ['menu' => 'guru', 'status' => $datas]);
    }
    public function daftar_guru(Request $request)
    {
        $r = $request->all();
        $foto = $request->file('pas_foto');
        $ext = $foto->getClientOriginalExtension();
        // $r['pas_foto'] = $request->file('pas_foto');

        $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        $destinationPath = public_path('upload/guru');

        $foto->move($destinationPath, $nameFoto);

        $fileUrl = asset('upload/guru/' . $nameFoto);

        $r['pas_foto'] = $nameFoto;
        // dd($r);
        $r['is_verif'] = 'belum';

        Pegawai::create($r);

        return redirect()->route('user.pegawai')->with('message', 'user daftar');
    }
}
