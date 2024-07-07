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
        $data->no_ktp          			= $request->no_ktp;
        $data->status_keikutpesertaan 	= $request->status_keikutpesertaan;
        $data->instansi        			= $request->instansi;
        $data->golongan     			= $request->golongan;
        $data->jkl        				= $request->gender;
        $data->kelengkapan_peserta      = $request->kelengkapan_peserta;
        $data->no_hp     				= $request->no_hp;
        $data->no_wa    				= $request->no_wa;
		$data->kabupaten   				= $request->kabupaten;
		// dd($data);
        $data->save();
        return redirect()->route('user.kegiatan');
    }

	
}
