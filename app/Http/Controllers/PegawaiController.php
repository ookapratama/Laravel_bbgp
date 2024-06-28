<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pegawai::get();
        return view('pages.admin.pegawai.index', ['menu' => 'pegawai', 'datas' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.pegawai.create', ['menu' => 'pegawai']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();
        $foto = $request->file('pas_foto');
        $ext = $foto->getClientOriginalExtension();
        // $r['pas_foto'] = $request->file('pas_foto');

        $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        $foto->storeAs('public/upload/pegawai', $nameFoto);

        $r['pas_foto'] = $nameFoto;
        // dd($r);
        $r['is_verif'] = true;

        Pegawai::create($r);

        return redirect()->route('pegawai.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function verifikasi(string $id)
    {
        $data = Pegawai::find($id);
        $data->is_verif = 'sudah';
        $data->save();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pegawai::find($id);
        return view('pages.admin.pegawai.edit', ['menu' => 'pegawai', 'datas' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $r = $request->all();
        $data = Pegawai::find($r['id'])->first();
        $foto = $request->file('pas_foto');
        
        if ($request->hasFile('pas_foto')) {
            $ext = $foto->getClientOriginalExtension();
            $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
            $foto->storeAs('public/upload/pegawai', $nameFoto);
            $r['pas_foto'] = $nameFoto;
        } else {
            $r['pas_foto'] = $request->pas_fotoLama;
        }
        $r['is_verif'] = true;
        $data->update($r);
        return redirect()->route('pegawai.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pegawai::find($id);
        $data->delete();
        return response()->json($data);
    }
}
