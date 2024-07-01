<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jabatan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kepegawaian;
use App\Models\Pendidikan;
use App\Models\SatuanPendidikan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            's_sekolah' => Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(),

        );
        $data = Guru::orderBy('id','DESC')->get();
        // dd($data);
        return view('pages.admin.guru.index', ['menu' => 'guru', 'datas' => $data, 'status' => $datas]);
    }

    public function fetchSekolah()
    {
        $schools = Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(); // Optimalkan query jika perlu
        return response()->json($schools);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sekolahs = [];
        Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
        ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
            foreach ($sekolahChunk as $sekolah) {
                $sekolahs[] = $sekolah;
            }
        });
        // dd($sekolahs);
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            // 's_sekolah' => Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(),
            's_sekolah' => $sekolahs,

        );
        // dd($datas['s_kecamatan']);
        // dd($datas['s_sekolah'][0]);
        return view('pages.admin.guru.create', ['menu' => 'guru', 'status' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();
        // dd($r);
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

        Guru::create($r);

        return redirect()->route('guru.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function verifikasi(string $id)
    {

        $data = Guru::find($id);
        $data->is_verif = 'sudah';
        $data->save();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        $data = Guru::find($id);
        return view('pages.admin.guru.edit', ['menu' => 'guru', 'datas' => $data, 'status' => $datas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $r = $request->all();
        // dd($r['id']);
        $data = Guru::find($r['id']);
        // dd($data);
        $foto = $request->file('pas_foto');

        if ($request->hasFile('pas_foto')) {
            $ext = $foto->getClientOriginalExtension();
            $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
            $destinationPath = public_path('upload/guru');

            $foto->move($destinationPath, $nameFoto);

            $fileUrl = asset('upload/guru/' . $nameFoto);
            $r['pas_foto'] = $nameFoto;
        } else {
            $r['pas_foto'] = $request->pas_fotoLama;
        }
        $r['is_verif'] = 'belum';
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

    public function export()
    {
        // Mendapatkan data guru dari model Guru
        $datas = Guru::all();

        $pdf = PDF::loadView('pages.admin.guru.cetak', compact('datas'));

        // Set properties PDF
        // $pdf->setPaper('a4', 'landscape'); // Set kertas ke mode landscape
        $pdf->setPaper([0, 0, 1300, 800]); // Lebar 800px, Tinggi 1000px
        

        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_tenaga_pendidik.pdf');
    }



}
