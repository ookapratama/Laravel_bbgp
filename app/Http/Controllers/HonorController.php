<?php

namespace App\Http\Controllers;

use App\Models\Honor;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
// use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
// use Dompdf\Options;
use Illuminate\Http\Request;

class HonorController extends Controller
{
    private $menu = 'honor';

    public function __construct()
    {
        $this->menu = 'honor';
    }

    public function detectGolongan($golongan)
    {
        // Pecah string dengan delimiter '/' untuk mendapatkan prefix
        $parts = explode('/', $golongan);

        // Kembalikan bagian sebelum '/' jika ada
        return $parts[0];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = $this->menu;
        $title = 'honor';
        $kegiatan = PesertaKegiatan::get();
        $honor = Honor::get();
        $datas = [];
        // $pot = 0;


        foreach ($honor as $i => $v) {
            // $jumlah_honor = $v->jumlah * $v->jp_realisasi;

            $mainGolongan = explode('/', $v->golongan)[0];

            // dd($mainGolongan);
            // Tentukan pot berdasarkan golongan utama
            // dump($mainGolongan);
            // dd($mainGolongan == 'IV');

            // if ($mainGolongan[$i] == 'IV') {
            //     $pot = $jumlah_honor * 0.15;
            // } else if ($mainGolongan[$i] == 'III') {
            //     $pot = $jumlah_honor * 0.5; // Atur sesuai kebutuhan
            // }
            // else {
            //     $pot = $jumlah_honor;
            // }

            $total = $v->jumlah_honor - $v->pot;

            // dd($v);
            // Tambahkan hasil perhitungan ke array $datas
            $datas[] = [
                'nama' => $v->peserta->nama ?? '',
                'jabatan' => $v->peserta->status_keikutpesertaan ?? '',
                'jp_realisasi' => $v->jp_realisasi,
                'jumlah' => $this->rupiahFormat($v->jumlah),
                'jumlah_honor' => $this->rupiahFormat($v->jumlah_honor),
                'pot' => $this->rupiahFormat($v->potongan),
                'total' => $this->rupiahFormat($total),
                'id' => $v->id, // Jika perlu tambahkan ID atau atribut lain yang relevan
                'golongan' => $v->golongan,
                'jenis_gol' => $v->peserta->jenis_gol ?? $v->jenis_gol,
                'instansi' => $v->peserta->instansi ?? $v->instansi, // Atau atribut lainnya yang ingin ditampilkan
            ];

            // dd($datas);
        }

        return view('pages.admin.honor.index', compact('menu', 'datas', 'title'));
    }

    public function rupiahFormat($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        $title = 'honor';
        $kegiatan = Kegiatan::orderBy('id', 'DESC')->get();
        // dd($kegiatan);


        $peserta = PesertaKegiatan::orderBy('id', 'DESC')->where('status_keikutpesertaan', 'narasumber')
            ->orWhere('status_keikutpesertaan', 'panitia')
            ->get();
        // dd($peserta);
        $status_gol = array(
            'partisipanPanitia' => PesertaKegiatan::with('kegiatan')->where('status_keikutpesertaan', 'panitia')->orderByDesc(
                'id'
            )->get(),
            'partisipanNarasumber' => PesertaKegiatan::with('kegiatan')->where('status_keikutpesertaan', 'narasumber')->orderByDesc('id')->get(),

        );
        // dd($status_gol);
        // foreach ($peserta as $key => $value) {
        //     dump($value->kegiatan);
        // }
        // dd(true);
        return view('pages.admin.honor.create', compact('menu', 'peserta', 'kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        // dd(true);
        $req = $r->all();
        $req['jp_realisasi'] = (int) str_replace(".", "", $r->jp_realisasi);
        $req['jumlah'] = (int) str_replace(".", "", $r->jumlah);
        $req['jumlah_honor'] = (int) str_replace(".", "", $r->jumlah_honor);
        $req['potongan'] = (int) str_replace(".", "", $r->potongan);
        $req['jumlah_diterima'] = (int) str_replace(".", "", $r->jumlah_diterima);
        // dd($r->jumlah);
        $req['golongan'] = explode('/', $req['golongan'])[0];

        // dd($req);


        Honor::create($req);

        return redirect()->route('honor.index')->with('message', 'store');
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
        $menu = $this->menu;
        $title = $menu;

        $datas = Honor::find($id);
        $peserta = PesertaKegiatan::where('status_keikutpesertaan', 'narasumber')
            ->orWhere('status_keikutpesertaan', 'panitia')
            ->get();

        return view('pages.admin.honor.edit', compact('menu', 'datas', 'peserta', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $req = $r->all();
        $datas = Honor::find($req['id']);

        $req['jp_realisasi'] = (int) str_replace(".", "", $r->jp_realisasi);
        $req['jumlah'] = (int) str_replace(".", "", $r->jumlah);
        $req['jumlah_honor'] = (int) str_replace(".", "", $r->jumlah_honor);
        $req['potongan'] = (int) str_replace(".", "", $r->potongan);
        $req['jumlah_diterima'] = (int) str_replace(".", "", $r->jumlah_diterima);
        // dd($r->jumlah);
        $req['golongan'] = explode('/', $req['golongan'])[0];

        $datas->update($req);

        return redirect()->route('honor.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Honor::find($id);
        $data->delete();
        return response()->json($data);
    }

    public function cetak($jenis)
    {
        // Ambil data honor berdasarkan jenis (panitia/narasumber)
        $honors = Honor::whereHas('peserta', function ($query) use ($jenis) {
            $query->where('status_keikutpesertaan', $jenis);
        })->with('peserta')->get();
        $honors = Honor::whereHas('peserta', function ($query) use ($jenis) {
            $query->where('status_keikutpesertaan', $jenis);
        })->with('peserta')->get();

        $datas = [];

        foreach ($honors as $i => $v) {
            // $jumlah_honor = $v->jumlah * $v->jp_realisasi;

            $mainGolongan = explode('/', $v->golongan)[0];


            $total = $v->jumlah_honor - $v->pot;

            // Tambahkan hasil perhitungan ke array $datas
            $datas[] = [
                'nama' => $v->peserta->nama,
                'jabatan' => $v->peserta->status_keikutpesertaan,
                'jp_realisasi' => $v->jp_realisasi,
                'jumlah' => $this->rupiahFormat($v->jumlah),
                'jumlah_honor' => $this->rupiahFormat($v->jumlah_honor),
                'pot' => $this->rupiahFormat($v->potongan),
                'total' => $this->rupiahFormat($total),
                'id' => $v->id, // Jika perlu tambahkan ID atau atribut lain yang relevan
                'golongan' => $v->golongan, // Atau atribut lainnya yang ingin ditampilkan
            ];
            // dump($datas);
        }
        // dd($honors);
        // Load view untuk PDF
        $pdf = PDF::loadView('pages.admin.honor.cetakHonor', compact('datas', 'jenis'));

        // Konfigurasi DomPDF
        // $pdf->set('isHtml5ParserEnabled', true);
        // $pdf->set('isRemoteEnabled', true);

        // Buat instance DomPDF
        $pdf->setPaper('A4', 'landscape');

        // Kirimkan PDF ke browser
        return $pdf->stream("daftar_honor_$jenis.pdf");
    }
}
