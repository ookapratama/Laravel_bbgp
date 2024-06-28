<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Guru::get();
        return view('pages.admin.guru.index', ['menu' => 'guru', 'datas' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.guru.create', ['menu' => 'guru']);
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
        $foto->storeAs('public/upload/guru', $nameFoto);

        $r['pas_foto'] = $nameFoto;
        // dd($r);
        Guru::create($r);

        return redirect()->route('guru.index')->with('message', 'store');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Guru::find($id);
        return view('pages.admin.guru.edit', ['menu' => 'guru', 'datas' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $r = $request->all();
        $data = Guru::find($r['id'])->first();
        $foto = $request->file('pas_foto');
        
        if ($request->hasFile('pas_foto')) {
            $ext = $foto->getClientOriginalExtension();
            $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
            $foto->storeAs('public/upload/guru', $nameFoto);
            $r['pas_foto'] = $nameFoto;
        } else {
            $r['pas_foto'] = $request->pas_fotoLama;
        }
        $data->update($r);
        return redirect()->route('guru.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = Guru::find($id);
        $data->delete();
        return response()->json($data);
    }
}
