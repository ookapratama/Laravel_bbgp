<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    private $menu = 'berita';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Berita::get();
        $menu = $this->menu;
        return view('pages.admin.berita.index', compact('menu', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        return view('pages.admin.berita.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();

        $file = $request->file('thumbnail');

        // dd($file->getSize() / 1024 );
        if ($file->getSize() / 1024 >= 512) {
            return redirect()->route('berita.create')->with('message', 'size gambar');
        }

        $foto = $request->file('thumbnail');
        $ext = $foto->getClientOriginalExtension();
        // $r['pas_foto'] = $request->file('pas_foto');

        $nameFoto = date('Y-m-d_H-i-s_') . str_replace(' ', '-', $r['judul'])  . "." . $ext;
        $destinationPath = public_path('upload/berita');

        $foto->move($destinationPath, $nameFoto);

        $fileUrl = asset('upload/berita/' . $nameFoto);

        $r['thumbnail'] = $nameFoto;

        Berita::create($r);


        // dd(true);
        return redirect()->route('berita.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Berita::find($id);
        $data->delete();
        return response()->json($data);
    }
}
