<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kegiatan;
use App\Models\Kuitansi;
use App\Models\PesertaKegiatan;
use App\Models\Transportasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KuitansiController extends Controller
{
    private $menu;
    public function __construct()
    {
        $this->menu = 'honor';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kuitansi::orderBy('id', 'DESC')->get();
        $menu = $this->menu;
        $title = 'kuitansi';
        $kegiatan = Kegiatan::orderByDesc('id')->get();
        // dd($datas);
        return view('pages.admin.kuitansi.index', compact('menu', 'datas', 'title', 'kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        $kegiatan = Kegiatan::orderBy('id', 'DESC')->get();

        $datas = array(
            'peserta' => PesertaKegiatan::orderByDesc('id')->get(),
            'kabupaten' => Kabupaten::get(),
        );
        // foreach ($datas['peserta'] as $i => $v) {
        //     dd($v->pegawai->nip);
        // }
        // dd($datas['peserta'][0]->pegawai->nip);


        return view('pages.admin.kuitansi.create', compact('menu', 'datas', 'kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {

        // Membuat objek Kuitansi baru
        // $data = new Kuitansi;

        // // Mengisi properti Kuitansi dengan data dari request
        // $data->no_bukti = $request->no_bukti;
        // $data->no_MAK = $request->no_MAK;
        // $data->biaya_penginapan = $request->biaya_penginapan;
        // $data->biaya_uang_harian = $request->biaya_uang_harian;
        // $data->durasi_penginapan = $request->durasi_penginapan;
        // $data->durasi_uang_harian = $request->durasi_uang_harian;
        // $data->kategori = $request->kategori ?? '';
        // $data->tahun_anggaran = $request->tahun_anggaran;

        // // Menghitung total biaya penginapan dan total biaya uang harian
        // $data->total_biaya_penginapan = $data->biaya_penginapan * $data->durasi_penginapan;
        // $data->total_biaya_harian = $data->biaya_uang_harian * $data->durasi_uang_harian;

        // // Menyimpan data kuitansi
        // $data->save();

        // // Simpan transportasi terkait
        // if ($request->has('transportasis')) {
        //     foreach ($request->transportasis as $transportasiData) {
        //         $transportasi = new Transportasi([
        //             'asal_transport' => $transportasiData['asal_transport'],
        //             'tujuan_transport' => $transportasiData['tujuan_transport'],
        //             'transportasi' => $transportasiData['transportasi'],
        //             'keterangan' => $transportasiData['keterangan'],
        //             'biaya_transport' => $transportasiData['biaya_transport'],
        //         ]);
        //         $data->transportasis()->save($transportasi);
        //         // dd($transportasi);
        //     }
        // }

        $r['pegawai_id'] = $r['id_pegawai'];
        $r['uang_penginapan'] = $r['jumlah_biaya'];
        $r['total_pp'] = $r['jumlah_biaya'];
        $r['total_pp'] = $r['jumlah_biaya'];
        $r['biaya_tujuan'] = $r['tujuan'];
        $r['total_harian'] = $r['biaya_harian'];
        $r['total_terima'] = $r['jumlah_biaya_diterima'];
        // dd($r->all());

        Kuitansi::create($r->all());


        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kuitansi.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kuitansi = Kuitansi::findOrFail($id);
        return view('pages.admin.kuitansi.detail', compact('kuitansi'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan data kuitansi berdasarkan id
        $kuitansi = Kuitansi::findOrFail($id);
        $menu = $this->menu;
        $title = 'kuitansi';
        $datas = array(
            'peserta' => PesertaKegiatan::orderByDesc('id')->get(),
            'kabupaten' => Kabupaten::get(),
        );

        // Memuat data terkait seperti transportasi
        $transportasis = $kuitansi->transportasis;

        // Mengembalikan view dengan data kuitansi dan transportasi
        return view('pages.admin.kuitansi.edit', compact('menu', 'kuitansi', 'transportasis', 'title', 'datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {

        // // Validasi inputan
        // $validatedData = $request->validate([
        //     'no_bukti' => 'required|string',
        //     'tahun_anggaran' => 'required|date',
        //     'no_MAK' => 'required|string',
        //     'biaya_penginapan' => 'required|numeric',
        //     'biaya_uang_harian' => 'required|numeric',
        //     'durasi_penginapan' => 'required|string',
        //     'durasi_uang_harian' => 'required|string',
        //     'kategori' => 'required|string',
        //     'transportasis.*.asal_transport' => 'required|string',
        //     'transportasis.*.tujuan_transport' => 'required|string',
        //     'transportasis.*.jenis_transportasi' => 'required|string',
        //     'transportasis.*.keterangan' => 'nullable|string',
        //     'transportasis.*.biaya_transport' => 'required|numeric',
        // ]);

        // // Cari data Kuitansi berdasarkan ID yang diterima dari request
        // $kuitansi = Kuitansi::findOrFail($request->id);

        // // Update data Kuitansi
        // $kuitansi->update([
        //     'no_bukti' => $validatedData['no_bukti'],
        //     'tahun_anggaran' => $validatedData['tahun_anggaran'],
        //     'no_MAK' => $validatedData['no_MAK'],
        //     'biaya_penginapan' => $validatedData['biaya_penginapan'],
        //     'biaya_uang_harian' => $validatedData['biaya_uang_harian'],
        //     'durasi_penginapan' => $validatedData['durasi_penginapan'],
        //     'durasi_uang_harian' => $validatedData['durasi_uang_harian'],
        //     'kategori' => $validatedData['kategori'],
        // ]);

        // // Update atau hapus data transportasi
        // foreach ($validatedData['transportasis'] as $index => $transportasiData) {
        //     if (isset($kuitansi->transportasis[$index])) {
        //         $kuitansi->transportasis[$index]->update($transportasiData);
        //     } else {
        //         $kuitansi->transportasis()->create($transportasiData);
        //     }
        // }
        $r = $r->all();
        $datas = Kuitansi::find($r['id']);

        $r['pegawai_id'] = $r['id_pegawai'];
        $r['uang_penginapan'] = $r['jumlah_biaya'];
        $r['total_pp'] = $r['jumlah_biaya'];
        $r['total_pp'] = $r['jumlah_biaya'];
        $r['biaya_tujuan'] = $r['tujuan'];
        $r['total_harian'] = $r['biaya_harian'];
        $r['total_terima'] = $r['jumlah_biaya_diterima'];

        // dd($datas);
        $datas->update($r);

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

    public function cetak(string $id)
    {

        $data = Kuitansi::find($id);

        // dd($data);


        $pdf = Pdf::loadView('pages.admin.kuitansi.cetak', compact('data'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape


        return $pdf->stream('data_kuitansi.pdf');
    }

    public function cetakRill(string $id)
    {

        $data = Kuitansi::find($id);

        // dd($data);


        $pdf = Pdf::loadView('pages.admin.kuitansi.cetakRill', compact('data'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape


        return $pdf->stream('data_pengeluaran_rill.pdf');
    }

    public function cetakPJmutlak(string $id)
    {

        $data = Kuitansi::find($id);

        // dd($data);


        $pdf = Pdf::loadView('pages.admin.kuitansi.cetakPjMutlak', compact('data'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape


        return $pdf->stream('data_PJ_mutlak.pdf');
    }

    public function cetakAmplop(string $id)
    {

        $data = Kuitansi::find($id);

        $pdf = Pdf::loadView('pages.admin.kuitansi.cetakAmplop', compact('data'));

        // Set properties PDF
        $pdf->setPaper(array(0, 0, 825, 465)); // Set kertas ke mode landscape


        return $pdf->stream('data_amplop.pdf');
    }

    public function cetakPermintaan()
    {

        $data = Kuitansi::get();

        $pdf = Pdf::loadView('pages.admin.kuitansi.cetakPermintaan', compact('data'));

        // Set properties PDF
        $pdf->setPaper('a4', 'landscape'); // Set kertas ke mode landscape

        return $pdf->stream('data_Permintaan.pdf');
    }

    public function cetakLampiran()
    {

        $data = Kuitansi::get();

        $pdf = Pdf::loadView('pages.admin.kuitansi.cetakLampiran', compact('data'));

        // Set properties PDF
        // $pdf->setPaper('a4', 'landscape'); // Set kertas ke mode landscape
        $pdf->setPaper(array(0, 0, 2025, 865)); // Set kertas ke mode landscape


        return $pdf->stream('data_Lampiran.pdf');
    }

    
    public function getPeserta(Request $r) {
        // dd($r->all());
        $kegiatan = $r->input('kegiatan');
        $peserta = PesertaKegiatan::orderBy('id', 'DESC')
        ->where('id_kegiatan', $kegiatan)
        ->where(function($query) {
            $query->where('status_keikutpesertaan', 'panitia')
                  ->orWhere('status_keikutpesertaan', 'narasumber');
        })
        ->get();
        // dd($peserta);
        return response()->json($peserta);
    }
}
