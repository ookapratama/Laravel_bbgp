<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kuitansi;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class KuitansiController extends Controller
{
    private $menu;
    public function __construct() {
        $this->menu = 'kuitansi';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kuitansi::get();
        $menu = $this->menu;
        return view('pages.admin.kuitansi.index', compact('menu', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        return view('pages.admin.kuitansi.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat objek Kuitansi baru
        $data = new Kuitansi;

        // Mengisi properti Kuitansi dengan data dari request
        $data->no_bukti = $request->no_bukti;
        $data->no_MAK = $request->no_MAK;
        $data->biaya_penginapan = $request->biaya_penginapan;
        $data->biaya_uang_harian = $request->biaya_uang_harian;
        $data->durasi_penginapan = $request->durasi_penginapan;
        $data->durasi_uang_harian = $request->durasi_uang_harian;
        $data->kategori = $request->kategori;
        $data->tahun_anggaran = $request->tahun_anggaran;

        // Menghitung total biaya penginapan dan total biaya uang harian
        $data->total_biaya_penginapan = $data->biaya_penginapan * $data->durasi_penginapan;
        $data->total_biaya_harian = $data->biaya_uang_harian * $data->durasi_uang_harian;
        
        // Menyimpan data kuitansi
        $data->save();
        
        // Simpan transportasi terkait
        if ($request->has('transportasis')) {
            foreach ($request->transportasis as $transportasiData) {
                $transportasi = new Transportasi([
                    'asal_transport' => $transportasiData['asal_transport'],
                    'tujuan_transport' => $transportasiData['tujuan_transport'],
                    'transportasi' => $transportasiData['transportasi'],
                    'keterangan' => $transportasiData['keterangan'],
                    'biaya_transport' => $transportasiData['biaya_transport'],
                ]);
                $data->transportasis()->save($transportasi);
                // dd($transportasi);
            }
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kuitansi.index')->with('message', 'Data kuitansi berhasil disimpan.');    
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
        // Temukan data kuitansi berdasarkan id
    $kuitansi = Kuitansi::findOrFail($id);
    $menu = $this->menu;
    // Memuat data terkait seperti transportasi
    $transportasis = $kuitansi->transportasis;

    // Mengembalikan view dengan data kuitansi dan transportasi
    return view('pages.admin.kuitansi.edit', compact('menu','kuitansi', 'transportasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    // Validasi inputan
    $validatedData = $request->validate([
        'no_bukti' => 'required|string',
        'tahun_anggaran' => 'required|date',
        'no_MAK' => 'required|string',
        'biaya_penginapan' => 'required|numeric',
        'biaya_uang_harian' => 'required|numeric',
        'durasi_penginapan' => 'required|string',
        'durasi_uang_harian' => 'required|string',
        'kategori' => 'required|string',
        'transportasis.*.asal_transport' => 'required|string',
        'transportasis.*.tujuan_transport' => 'required|string',
        'transportasis.*.jenis_transportasi' => 'required|string',
        'transportasis.*.keterangan' => 'nullable|string',
        'transportasis.*.biaya_transport' => 'required|numeric',
    ]);

    // Cari data Kuitansi berdasarkan ID yang diterima dari request
    $kuitansi = Kuitansi::findOrFail($request->id);

    // Update data Kuitansi
    $kuitansi->update([
        'no_bukti' => $validatedData['no_bukti'],
        'tahun_anggaran' => $validatedData['tahun_anggaran'],
        'no_MAK' => $validatedData['no_MAK'],
        'biaya_penginapan' => $validatedData['biaya_penginapan'],
        'biaya_uang_harian' => $validatedData['biaya_uang_harian'],
        'durasi_penginapan' => $validatedData['durasi_penginapan'],
        'durasi_uang_harian' => $validatedData['durasi_uang_harian'],
        'kategori' => $validatedData['kategori'],
    ]);

    // Update atau hapus data transportasi
    foreach ($validatedData['transportasis'] as $index => $transportasiData) {
        if (isset($kuitansi->transportasis[$index])) {
            $kuitansi->transportasis[$index]->update($transportasiData);
        } else {
            $kuitansi->transportasis()->create($transportasiData);
        }
    }
    // $menu = $this->menu;

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('kuitansi.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kuitansi::find($id);
        $data->delete();
        return response()->json($data);
    }
}
