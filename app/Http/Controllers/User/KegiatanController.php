<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\JabatanPenugasanGolongan;
use App\Models\Kabupaten;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\PesertaKegiatan;

// use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;

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

        return view('pages.user.kegiatan.index', [
            'menu' => 'kegiatan',
            'data' => $data,
            'kegiatan' => $dataKegiatan,
            'pegawai' => $dataPegawai,
        ]);
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

        $peserta = PesertaKegiatan::where('id_kegiatan', $kegiatanId)
            ->where('no_ktp', $nik)
            ->get();

        return response()->json(['data' => $peserta]);
    }


    public function regist(Request $r)
    {
        $menu = 'kegiatan';
        $kegiatanId = $r->input('kegiatan_id');
        $pegawai = Pegawai::orderBy('id', 'ASC')->get();
        $guru = Guru::orderBy('id', 'ASC')->get();

        $merge = $pegawai->merge($guru);
        // Get data for the view, e.g., list of kabupaten, golongan, etc.
        $status = [
            'kegiatanById' => Kegiatan::find($kegiatanId),
            'kabupaten' => Kabupaten::all(),
            'golongan' => JabatanPenugasanGolongan::all()
        ];
        // dd($status);

        return view('pages.user.kegiatan.create', compact('kegiatanId', 'status', 'menu', 'pegawai', 'merge'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = new PesertaKegiatan;
        $data->id_kegiatan = $request->kegiatan_id;
        $data->id_pegawai = $request->id_pegawai;
        $data->no_surat_tugas = $request->no_surat_tugas;
        $data->tgl_surat_tugas = $request->tgl_surat_tugas;
        $data->nama = $request->nama;
        $data->no_ktp = $request->no_ktp;
        $data->status_keikutpesertaan = $request->status_keikutpesertaan;
        $data->instansi = $request->instansi;
        $data->golongan = $request->golongan;
        $data->jkl = $request->gender;
        $data->kelengkapan_peserta_transport = $request->kelengkapan_transport;
        $data->kelengkapan_peserta_biodata = $request->kelengkapan_biodata;
        $data->no_hp = $request->no_hp;
        $data->no_wa = $request->no_wa;
        $data->kabupaten = $request->kabupaten;
        $data->jam_mengajar = $request->jam_mengajar;
        $data->jam_selesai = $request->jam_selesai;

        // Handle the signature
        if ($request->has('signature')) {
            $signatureData = $request->input('signature');
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureImage = base64_decode($signatureData);
            $signaturePath = 'signatures/' . uniqid() . '.png';
            file_put_contents(public_path($signaturePath), $signatureImage);
            $data->signature = $signaturePath;
        }

        // dd($data);
        // dd($request->all());
        $data->save();

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


        $pdf = PDF::loadView('pages.user.kegiatan.cetak.absenNarasumber', compact('data', 'kegiatan' ));

        // Set properties PDF
        $pdf->setPaper('a4', 'potrait'); // Set kertas ke mode landscape
        // $pdf->setPaper([0, 0, 1600, 800]); // Lebar 800px, Tinggi 1000px


        // Download PDF dengan nama file 'data_guru.pdf'
        return $pdf->stream('data_absensi_narasumber_kegiatan.pdf');
    }


}
