<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jabatan;
use App\Models\JabatanKependidikan;
use App\Models\JabatanPendidik;
use App\Models\JabatanStakeHolder;
use App\Models\JenisJabatan;
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
        $sekolahs = [];
        Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
            ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
                foreach ($sekolahChunk as $sekolah) {
                    $sekolahs[] = $sekolah;
                }
            });
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            // 's_sekolah' => Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(),
            's_sekolah' => $sekolahs,
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

        );
        $data = Guru::orderBy('id', 'DESC')->get();
        // dd($data);
        return view('pages.admin.guru.index', ['menu' => 'guru', 'datas' => $data, 'status' => $datas]);
    }

    // public function fetchSekolah()
    // {
    //     $schools = Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(); // Optimalkan query jika perlu
    //     return response()->json($schools);
    // }


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
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

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
        // $foto = $request->file('pas_foto');
        // $ext = $foto->getClientOriginalExtension();
        // // $r['pas_foto'] = $request->file('pas_foto');

        // $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        // $destinationPath = public_path('upload/guru');

        // $foto->move($destinationPath, $nameFoto);

        // $fileUrl = asset('upload/guru/' . $nameFoto);

        $r['pas_foto'] = '';
        $r['status'] = 'Belum Kawin';
        $r['alamat_satuan'] = '';
        $r['eksternal_jabatan'] = $r['jenisJabatan'];
        $r['jenis_jabatan'] = $r['jabJenis'];
        $r['kategori_jabatan'] = $r['jabKategori'] ?? '';
        $r['tugas_jabatan'] = $r['jabTugas'] ?? '';
        // $r['is_verif'] = 'belum';
        // dd($r);

        Guru::create($r);

        return redirect()->route('guru.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function verifikasi(string $id)
    {

        $data = Guru::find($id);
        $getData = Guru::find($id);
        $data->is_verif = 'sudah';
        $data->save();
        return response()->json([
            'status' => $data,
            'data' => $getData,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sekolahs = [];
        Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
            ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
                foreach ($sekolahChunk as $sekolah) {
                    $sekolahs[] = $sekolah;
                }
            });
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            // 's_sekolah' => Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(),
            's_sekolah' => $sekolahs,
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabKategoriPengawas' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cawas', 'Lainnya'],
            's_jabKategoriKepsek' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cakep', 'Lainnya'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

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
        // dd($r);
        $data = Guru::find($r['id']);
        // dd($data);
        // $foto = $request->file('pas_foto');

        // if ($request->hasFile('pas_foto')) {
        //     $ext = $foto->getClientOriginalExtension();
        //     $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        //     $destinationPath = public_path('upload/guru');

        //     $foto->move($destinationPath, $nameFoto);

        //     $fileUrl = asset('upload/guru/' . $nameFoto);
        //     $r['pas_foto'] = $nameFoto;
        // } else {
        //     $r['pas_foto'] = $request->pas_fotoLama;
        // }
        $r['pas_foto'] = '';
        $r['status'] = 'Belum Kawin';
        $r['alamat_satuan'] = '';
        $r['eksternal_jabatan'] = $r['jenisJabatan'];
        $r['jenis_jabatan'] = $r['jabJenis'];
        $r['kategori_jabatan'] = $r['jabKategori'] ?? '';
        $r['tugas_jabatan'] = $r['jabTugas'] ?? '';
        // $r['is_verif'] = 'belum';
        // $r['is_verif'] = 'belum';
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
        $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_eksternal_BBGP.pdf');
    }

    public function exportByUser($id)
    {
        // Mendapatkan data guru dari model Guru
        $data = Guru::find($id);

        $pdf = PDF::loadView('pages.admin.guru.cetakByUser', compact('data'));

        // Set properties PDF
        // $pdf->setPaper('a4', 'landscape'); // Set kertas ke mode landscape
        $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_eksternal_BBGP.pdf');
    }

    public function show(string $id)
    {
        // dd($id);

        $sekolahs = [];
        Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
            ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
                foreach ($sekolahChunk as $sekolah) {
                    $sekolahs[] = $sekolah;
                }
            });
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            // 's_sekolah' => Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(),
            's_sekolah' => $sekolahs,
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

        );
        // $data = Guru::orderBy('id','DESC')->get();
        $data = Guru::where('no_ktp' , session('no_ktp'))->first();
        // $data = Guru::find($id);
        // dd($data);
        return view('pages.admin.guru.indexByUser', ['menu' => 'guru', 'datas' => $data, 'status' => $datas]);
    }

    

    public function editByUser(string $id)
    {
        $sekolahs = [];
        Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')
            ->chunk(500, function ($sekolahChunk) use (&$sekolahs) {
                foreach ($sekolahChunk as $sekolah) {
                    $sekolahs[] = $sekolah;
                }
            });
        $datas = array(
            's_kepegawaian' => Kepegawaian::get(),
            's_kependidikan' => SatuanPendidikan::get(),
            's_gelar' => Pendidikan::get(),
            's_jabatan' => Jabatan::get(),
            's_kabupaten' => Kabupaten::get(),
            's_kecamatan' => Kecamatan::get(),
            // 's_sekolah' => Sekolah::select('npsn_sekolah', 'nama_sekolah', 'kecamatan', 'kabupaten')->get(),
            's_sekolah' => $sekolahs,
            's_jabPendidik' => JabatanPendidik::get(),
            's_jabKependidikan' => JabatanKependidikan::get(),
            's_jabStakeholder' => JabatanStakeHolder::get(),
            's_jabKategori' => ['GP (Guru Penggerak)', 'NoN GP (Guru Penggerak)'],
            's_jabKategoriPengawas' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cawas', 'Lainnya'],
            's_jabKategoriKepsek' => ['Sertifikat GP (Guru Penggerak)', 'Diklat Cakep', 'Lainnya'],
            's_jabTugas' => ['GP (Guru Penggerak)', 'PP (Pengajar Praktik)', 'Fasil (Fasilitator)', 'Instruktur'],

        );


        $data = Guru::find($id);
        return view('pages.admin.guru.editByUser', ['menu' => 'guru', 'datas' => $data, 'status' => $datas]);
    }

    public function updateByUser(Request $request)
    {
        //
        $r = $request->all();
        // dd($r);
        $data = Guru::find($r['id']);
        // dd($data);
        // $foto = $request->file('pas_foto');

        // if ($request->hasFile('pas_foto')) {
        //     $ext = $foto->getClientOriginalExtension();
        //     $nameFoto = date('Y-m-d_H-i-s_') . $r['no_ktp'] . "." . $ext;
        //     $destinationPath = public_path('upload/guru');

        //     $foto->move($destinationPath, $nameFoto);

        //     $fileUrl = asset('upload/guru/' . $nameFoto);
        //     $r['pas_foto'] = $nameFoto;
        // } else {
        //     $r['pas_foto'] = $request->pas_fotoLama;
        // }
        $r['pas_foto'] = '';
        $r['status'] = 'Belum Kawin';
        $r['alamat_satuan'] = '';
        $r['eksternal_jabatan'] = $r['jenisJabatan'];
        $r['jenis_jabatan'] = $r['jabJenis'];
        $r['kategori_jabatan'] = $r['jabKategori'] ?? '';
        $r['tugas_jabatan'] = $r['jabTugas'] ?? '';
        $r['is_verif'] = 'sudah';
        // $r['is_verif'] = 'belum';
        // dd($r['jenis_bank']);

        $data->update($r);
        return redirect()->route('guru.show', $r['id'])->with('message', 'update');
    }


}
