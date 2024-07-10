<?php

namespace App\Http\Controllers\JabatanPegawaiBBGP;

use App\Http\Controllers\Controller;
use App\Models\JabatanPenugasanPegawai;
use App\Models\JabatanPenugasanPpnpn;
use Illuminate\Http\Request;

class JabatanPenugasanPPNPNController extends Controller
{
    private $menu;
    public function __construct() {
        $this->menu = 'jabatan_pegawai_BBGP';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = JabatanPenugasanPpnpn::get();
        $menu = $this->menu;
        $title = 'jabatan_penugasan_PPNPN';

        return view('pages.admin.JabatanPegawaiBBGP.jabatan_penugasan_PPNPN.index', compact('menu', 'datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        return view('pages.admin.JabatanPegawaiBBGP.jabatan_penugasan_PPNPN.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JabatanPenugasanPegawai::create($request->all());

        return redirect()->route('jabatan_penugasan_PPNPN.index')->with('message', 'store');
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
        $datas = JabatanPenugasanPegawai::find($id);
        $menu = $this->menu;

        return view('pages.admin.JabatanPegawaiBBGP.jabatan_penugasan_PPNPN.edit', compact('datas','menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $datas = JabatanPenugasanPegawai::find($request->id);
        // dd($r->all());
        $datas->update($request->all());
        $menu = $this->menu;

        return redirect()->route('jabatan_penugasan_PPNPN.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JabatanPenugasanPegawai::find($id);
        $data->delete();
        return response()->json($data);
    }
}