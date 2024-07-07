<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\JabatanPenugasanGolongan;
use App\Models\Kabupaten;
use App\Models\PesertaKegiatan;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
	{
    	// mengambil data dari table pegawai
        $data = PesertaKegiatan::paginate(10);
		$p=1;
    	// mengirim data pegawai ke view index
		return view('pages.user.kegiatan.index',
		['menu' => 'kegiatan'],
		['data' => $data]);
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
            'menu' 	  => 'kegiatan',
            'message' => 'Silahkan registrasi'
        ]);
        }
	}

	public function regist()
	{
    	// mengambil data dari table pegawai
        $data = PesertaKegiatan::paginate(10);
		$datas = array(
            // 'id' 	=> Kabupaten::get(),
            'kabupaten'  => Kabupaten::get(),
			'golongan'  => JabatanPenugasanGolongan::get(),

        );
    	// mengirim data pegawai ke view index
		return view('pages.user.kegiatan.create',
		['menu' => 'kegiatan'],
		['status' => $datas],
		['data' => $data]);
	}

	public function store(Request $request)
{
    $data = new PesertaKegiatan;
    $data->no_ktp                              = $request->no_ktp;
    $data->status_keikutpesertaan              = $request->status_keikutpesertaan;
    $data->instansi                            = $request->instansi;
    $data->golongan                            = $request->golongan;
    $data->jkl                                 = $request->gender;
    $data->kelengkapan_peserta_transport       = $request->kelengkapan_transport;
    $data->kelengkapan_peserta_biodata         = $request->kelengkapan_biodata;
    $data->no_hp                               = $request->no_hp;
    $data->no_wa                               = $request->no_wa;
    $data->kabupaten                           = $request->kabupaten;

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

    $data->save();

    return redirect()->route('user.kegiatan');
}


	
}
