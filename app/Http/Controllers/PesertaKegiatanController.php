<?php

namespace App\Http\Controllers;

use App\Models\GolonganP3k;
use App\Models\JabatanPenugasanGolongan;
use App\Models\Kabupaten;
use App\Models\Kegiatan;
use App\Models\PesertaKegiatan;
use Illuminate\Http\Request;

class PesertaKegiatanController extends Controller
{
    private $menu;
    public function __construct()
    {
        $this->menu = 'peserta';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = $this->menu;

        $datas = PesertaKegiatan::orderBy('id', 'DESC')->get();
        $kegiatan = Kegiatan::get();
        return view('pages.admin.peserta.index', compact('datas', 'menu', 'kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan = Kegiatan::get();
        $menu = $this->menu;
        $status = array(
            'kabupaten' => Kabupaten::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
            'golongan_p3k' => GolonganP3k::get(),
        );

        return view('pages.admin.peserta.create', compact('kegiatan', 'menu', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();

        // dd($r);
        $getNik = PesertaKegiatan::where('no_ktp', $r['no_ktp'])->first();
        // dd($getNik);
        if ($getNik == null) {

            // dd(false);

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
                    'kegiatanById' => Kegiatan::find($r['id_kegiatan']),
                    'kabupaten' => Kabupaten::all(),
                    'golongan' => JabatanPenugasanGolongan::all(),
                    'golongan_p3k' => GolonganP3k::get(),
                ];
                // dd($status['kegiatanById']->id);


                return redirect()->route('peserta.create', [
                    'kegiatan_id' => $status['kegiatanById']->id,
                ])->with([
                    'status' => $status,
                    'message' => 'error golongan',
                    'menu' => 'kegiatan',
                ]);
            }

            // dd($r);
            PesertaKegiatan::create($r);

            return redirect()->route('peserta.index')->with('message', 'store');
        } else {
            // dd(true);
            return redirect()->route('peserta.create')->with([
                'message' => 'error nik',
                'menu' => 'kegiatan',
            ]);
        }
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
        $datas = PesertaKegiatan::find($id);
        $kegiatan = Kegiatan::get();
        // dd($datas);
        $menu = $this->menu;
        $status = array(
            'kabupaten' => Kabupaten::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
            'golongan_p3k' => GolonganP3k::get(),
        );

        // dd($datas);
        return view('pages.admin.peserta.edit', compact('datas', 'menu', 'status', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $datas = PesertaKegiatan::find($r->id);

        // $getNik = PesertaKegiatan::where('no_ktp', $r['no_ktp'])->first();
        // if ($getNik != null) {
        //     return redirect()->route('peserta.create')->with([
        //         'message' => 'error nik',
        //         'menu' => 'kegiatan',
        //     ]);
        // }

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
                'kegiatanById' => Kegiatan::find($r['id_kegiatan']),
                'kabupaten' => Kabupaten::all(),
                'golongan' => JabatanPenugasanGolongan::all(),
                'golongan_p3k' => GolonganP3k::get(),
            ];

            return redirect()->route('peserta.create', [
                'kegiatan_id' => $status['kegiatanById']->id,
            ])->with([
                'status' => $status,
                'message' => 'error golongan',
                'menu' => 'kegiatan',
            ]);
        }
        // dd($r->all);
        $datas->update($r->all());
        return redirect()->route('peserta.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PesertaKegiatan::find($id);
        $data->delete();
        return response()->json($data);
    }
}
