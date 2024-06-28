<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Pegawai;
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
        $data = Guru::where('is_verif', true)->get();
        return view('pages.user.guru', ['menu' => 'guru', 'datas' => $data]);
    }

    public function pegawai()
    {
        $data = Pegawai::where('is_verif', true)->get();
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
        $foto->storeAs('public/upload/pegawai', $nameFoto);

        $r['pas_foto'] = $nameFoto;
        // dd($r);
        $r['is_verif'] = false;

        Pegawai::create($r);

        return redirect()->route('user.pegawai')->with('message', 'store');
    }
}
