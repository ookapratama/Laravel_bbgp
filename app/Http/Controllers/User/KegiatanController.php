<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\GolonganP3k;
use App\Models\Guru;
use App\Models\JabatanPenugasanGolongan;
use App\Models\Kabupaten;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\PesertaKegiatan;

// use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KegiatanController extends Controller
{
    public function index()
    {
        // Ambil kegiatan yang statusnya aktif (status = 1)
        $dataKegiatan = Kegiatan::where('status', 'true')->get();
        $dataPegawai = Pegawai::get();
        $data = [];

        // Ambil data peserta jika ada kegiatan aktif
        if ($dataKegiatan->isNotEmpty()) {
            $data = PesertaKegiatan::get();
        }

        return view('pages.landing.kegiatan.kegiatan', [
            'menu' => 'kegiatan',
            'data' => $data,
            'kegiatan' => $dataKegiatan,
            'pegawai' => $dataPegawai,
        ]);
        // return view('pages.user.kegiatan.index', [
        //     'menu' => 'kegiatan',
        //     'data' => $data,
        //     'kegiatan' => $dataKegiatan,
        //     'pegawai' => $dataPegawai,
        // ]);
    }

    public function cari(Request $request)
    {
        // Capture the search query
        $cari = $request->cari;

        // Retrieve data from the PesertaKegiatan table based on the search query
        $data = PesertaKegiatan::where('no_ktp', 'like', "%" . $cari . "%")->paginate(10);

        // Check if any data is found
        if ($data->isNotEmpty()) {
            // Data found, send data to the view
            return view('pages.user.kegiatan.index', [
                'menu' => 'kegiatan',
                'data' => $data
            ]);
        } else {
            // No data found, send a message to the view
            return view('pages.user.kegiatan.index', [
                'menu' => 'kegiatan',
                'message' => 'Silahkan registrasi untuk mengikuti kegiatan ini.'
            ]);
        }
    }

    public function cariPeserta(Request $request)
    {
        $kegiatanId = $request->input('kegiatan_id');
        $nik = $request->input('nik');

        $title = 'Peserta';
        $status = true;
        $peserta = PesertaKegiatan::where('id_kegiatan', $kegiatanId)
            ->where('no_ktp', $nik)
            ->get();

        if ($peserta->isEmpty()) {
            $title = 'Pegawai';
            $peserta = Pegawai::where('no_ktp', $nik)->get();

            if ($peserta->isEmpty()) {
                $title = 'Eksternal';
                $peserta = Guru::where('no_ktp', $nik)->get();
            }
            $status = false;
        }

        // dd($peserta);

        return response()->json(['data' => $peserta, 'tipe' => $title, 'success' => $status]);
    }


    public function regist(Request $r)
    {
        $menu = 'kegiatan';
        $kegiatanId = $r->input('kegiatan_id');
        $pegawai = Pegawai::orderBy('id', 'ASC')->get();
        $guru = Guru::orderBy('id', 'ASC')->get();
        $kabupaten = Kabupaten::orderBy('id', 'ASC')->get();
        $kabupaten = Kabupaten::orderBy('id', 'ASC')->get();

        // dd($r->all());

        $peserta = PesertaKegiatan::where('id_kegiatan', $kegiatanId)
            ->where('no_ktp', $r->nik)
            ->get();

        if ($peserta->isEmpty()) {
            $title = 'Pegawai';
            $peserta = Pegawai::where('no_ktp', $r->nik)->get();

            if ($peserta->isEmpty()) {
                $title = 'Eksternal';
                $peserta = Guru::where('no_ktp', $r->nik)->get();
            }
            $status = false;
        }


                // Get data for the view, e.g., list of kabupaten, golongan, etc.
        $status = [
            'kegiatanById' => Kegiatan::find($kegiatanId),
            'kabupaten' => Kabupaten::all(),
            'golongan' => JabatanPenugasanGolongan::all(),
            // 'kabupaten' => $kabupaten,
            'golongan_p3k' => GolonganP3k::get(),
        ];
        // dd($status);

        return view('pages.landing.kegiatan.daftar', compact('kegiatanId', 'status', 'menu', 'peserta'));
        // return view('pages.user.kegiatan.create', compact('kegiatanId', 'status', 'menu', 'pegawai', 'merge'));
    }

    public function store(Request $request)
    {
        $r = $request->all();
        // dd($r['golongan_pns'] == null && $r['diluar_gol'] == null);
        $menu = 'kegiatan';

        if ($r['jenis_gol'] == 'PNS' && $r['golongan_pns'] != null) {
            $r['golongan'] = $r['golongan_pns'];
            $r['diluar_gol'] = null;
            $r['golongan_p3k'] = null;
        } else if ($r['jenis_gol'] == 'P3K' && $r['golongan_p3k'] != null) {
            $r['golongan'] = $r['golongan_p3k'];
            $r['diluar_gol'] = null;
            $r['golongan_pns'] = null;
        } else if ($r['jenis_gol'] == 'Tidak ada golongan' && $r['diluar_gol'] != null) {
            $r['golongan'] = $r['diluar_gol'];
            $r['golongan_p3k'] = null;
            $r['golongan_pns'] = null;
        } else {
            // Handle case where none of the golongan values are set
            $status = [
                'kegiatanById' => Kegiatan::find($r['kegiatan_id']),
                'kabupaten' => Kabupaten::all(),
                'golongan' => JabatanPenugasanGolongan::all(),
                'golongan_p3k' => GolonganP3k::get(),
            ];
            // dd($status['kegiatanById']->id);


            return redirect()->route('user.kegiatan_regist', [
                'kegiatan_id' => $status['kegiatanById']->id,
            ])->with([
                'status' => $status,
                'message' => 'error golongan',
                'menu' => 'kegiatan',
            ]);
        }

        $r['id_kegiatan'] = $r['kegiatan_id'];
        // dd($r);

        PesertaKegiatan::create($r);

        Session::flush();

        return redirect()->route('user.kegiatan')->with('message', 'sukses daftar');
    }


    public function getStatus(Request $request)
    {
        $kegiatanId = $request->query('kegiatan_id');

        // Misalkan Anda memiliki model Kegiatan dan ingin mengambil status keikutsertaan dari database
        $kegiatan = Kegiatan::find($kegiatanId);

        if (!$kegiatan) {
            return response()->json([
                'success' => false,
                'message' => 'Kegiatan not found',
            ], 404);
        }

        // Misalnya Anda memiliki atribut 'status_keikutpesertaan' di model Kegiatan
        $status = $kegiatan->status_keikutpesertaan;

        return response()->json([
            'success' => true,
            'status_keikutpesertaan' => $status,
        ]);
    }

    public function cekDataPeserta(Request $request)
    {
        $nik = $request->input('nik');
        // dd($nik);
        $title = 'Peserta';
        $peserta  = PesertaKegiatan::where('no_ktp', $nik)->first();
        // dd($peserta == null);
        if ($peserta == null) {
            $peserta = Pegawai::where('no_ktp', $nik)->first();
            $title = 'Pegawai';
            $instansi = 'Kantor BBGP SulSel';
            
            if( $peserta == null) {
                
                $title = 'Eksternal';
                $peserta = Guru::where('no_ktp', $nik)->first();
                $instansi = $peserta->sekolah->nama_sekolah ?? '';
            }    
            
            $status = false;
        } else {

            $status = true;
        }


        Session::put('nik', $nik);
        Session::put('dataAda', $status);


        // dd($peserta->nama);
        return response()->json([
            'success' => $status,
            'data' => $peserta,
            'instansi' => $instansi
        ]);
    }

    public function getPesertaByKegiatan(Request $request)
    {
        $kegiatanId = $request->input('kegiatan_id');
        $data = PesertaKegiatan::where('id_kegiatan', $kegiatanId)->get();
        return response()->json(['data' => $data]);
    }

    public function getPesertaDetail(Request $request)
    {
        $pesertaId = $request->input('id');
        $peserta = PesertaKegiatan::find($pesertaId);

        return response()->json($peserta);
    }


    public function printAbsensiPeserta(Request $request)
    {
        $kegiatanId = $request->query('kegiatan_id');
        $kegiatan = Kegiatan::find($kegiatanId);
        // dd($kegiatanId);

        // Mendapatkan data guru dari model Guru
        $data = PesertaKegiatan::where('status_keikutpesertaan', 'peserta')->where('id_kegiatan', $kegiatanId)->get();
        // $title = "DAFTAR HADIR PESERTA KOORDINASI  TEKNIS PROGRAM GERAK PENGGERAK";


        $pdf = PDF::loadView('pages.user.kegiatan.cetak.absenPeserta', compact('data', 'kegiatan'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape
        // $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_absensi_peserta_kegiatan.pdf');
        // Logic to generate PDF for Absensi Peserta
        // Return response with PDF
    }

    public function printRegistrasiPeserta(Request $request)
    {
        $kegiatanId = $request->query('kegiatan_id');
        $kegiatan = Kegiatan::find($kegiatanId);
        // Logic to generate PDF for Registrasi Peserta
        // Return response with PDF
        $data = PesertaKegiatan::where('status_keikutpesertaan', 'peserta')->where('id_kegiatan', $kegiatanId)->get();
        // $title = "DAFTAR HADIR PESERTA KOORDINASI  TEKNIS PROGRAM GERAK PENGGERAK";


        $pdf = PDF::loadView('pages.user.kegiatan.cetak.absenRegisterPeserta', compact('data', 'kegiatan'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape
        // $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_absensi_peserta_kegiatan.pdf');
    }

    public function printAbsensiPanitia(Request $request)
    {
        $kegiatanId = $request->query('kegiatan_id');
        $kegiatan = Kegiatan::find($kegiatanId);
        // Logic to generate PDF for Absensi Panitia
        // Return response with PDF

        $data = PesertaKegiatan::where('status_keikutpesertaan', 'panitia')->where('id_kegiatan', $kegiatanId)->where('id_kegiatan', $kegiatanId)->get();
        // $title = "DAFTAR HADIR PESERTA KOORDINASI  TEKNIS PROGRAM GERAK PENGGERAK";


        $pdf = PDF::loadView('pages.user.kegiatan.cetak.absenPanitia', compact('data', 'kegiatan'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape
        // $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_absensi_panitia_kegiatan.pdf');
    }


    public function printAbsensiNarasumber(Request $request)
    {
        $kegiatanId = $request->query('kegiatan_id');
        $kegiatan = Kegiatan::find($kegiatanId);
        // Logic to generate PDF for Absensi Narasumber
        // Return response with PDF

        $data = PesertaKegiatan::where('status_keikutpesertaan', 'narasumber')->where('id_kegiatan', $kegiatanId)->get();
        // $title = "DAFTAR HADIR PESERTA KOORDINASI  TEKNIS PROGRAM GERAK PENGGERAK";


        $pdf = PDF::loadView('pages.user.kegiatan.cetak.absenNarasumber', compact('data', 'kegiatan'));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape
        // $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_absensi_narasumber_kegiatan.pdf');
    }
}
