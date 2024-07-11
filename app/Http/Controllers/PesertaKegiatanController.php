<?php

namespace App\Http\Controllers;

use App\Models\JabatanPenugasanGolongan;
use App\Models\Kabupaten;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Http\Request;

class PesertaKegiatanController extends Controller
{
    private $menu;
    public function __construct() {
        $this->menu = 'peserta';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = $this->menu;

        $datas = PesertaKegiatan::orderBy('id', 'DESC')->get();
        $kegiatan = Kegiatan::get();
        return view('pages.admin.peserta.index', compact('datas', 'menu', 'kegiatan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan = Kegiatan::get();
        $menu = $this->menu;
        $status = array (
            'kabupaten' => Kabupaten::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
        );

        return view('pages.admin.peserta.create', compact('kegiatan', 'menu', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();
        // dd($r);
        PesertaKegiatan::create($r);

        return redirect()->route('peserta.index')->with('message', 'store');
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
        $datas = PesertaKegiatan::find($id);
        $kegiatan = Kegiatan::get();

        $menu = $this->menu;
        $status = array (
            'kabupaten' => Kabupaten::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
        );

        return view('pages.admin.peserta.edit', compact('datas', 'menu', 'status', 'kegiatan'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $datas = PesertaKegiatan::find($r->id);
        // dd($r->all());
        $datas->update($r->all());
        return redirect()->route('peserta.index')->with('message', 'update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PesertaKegiatan::find($id);
        $data->delete();
        return response()->json($data);
    }
}
