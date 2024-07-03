<?php

namespace App\Http\Controllers;

use App\Models\Internal;
use App\Models\JabatanPenugasanGolongan;
use App\Models\JabatanPenugasanPegawai;
use App\Models\JabatanPenugasanPpnpn;
use App\Models\Kabupaten;
use App\Models\Pegawai;
use App\Models\Pendamping;
use Illuminate\Http\Request;

class InternalController extends Controller
{
    public $title = '';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kota = Kabupaten::get();
        $data = array(

            'dataPenugasanPegawai' => Internal::where('jenis', 'Penugasan Pegawai')->get(),
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'dataPegawai' => Pegawai::get(),
        );
        $dataPendamping = Pendamping::get();
        // $merge = $data->merge($dataPendamping);
        // dd($merge);

        return view('pages.admin.internal.index', ['menu' => 'internal', 'datas' => $data, 'kota' => $kota, 'dataPendamping' => $dataPendamping]);

    }

    public function verifikasi(string $id)
    {
        // dd($id);
        $data = '';
        $data = Internal::find($id);
        if ($data == null) {
            $data = Pendamping::find($id);
        }
        $data->is_verif = 'sudah';
        $data->save();
        return response()->json($data);
    }

    public function get_tabel($jenis)
    {
        $datas = '';
        if ($jenis == 'ppnpn') {
            $title = 'Penugasan PPNPN';
            $datas = Internal::where('jenis', 'ppnpn')->get();
        } else if ($jenis == 'penugasan') {
            $title = 'Penugasan Pegawai';
            $datas = Internal::where('jenis', 'penugasan')->get();
        } else {
            $title = 'Pendamping Lokakarya';
            $datas = Internal::where('jenis', 'lokakarya')->get();
        }
        dd($jenis);

        $view = view('pages.admin.internal.tabel.' . $jenis . '', compact('datas', 'title'))->render();
        // dd($view);

        return response()->json([
            "html" => $view,
        ]);
    }


    public function create($jenis)
    {
        // dd($jenis);

        $datas = array(
            'golongan' => JabatanPenugasanGolongan::get(),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'jabatanPpnpn' => JabatanPenugasanPpnpn::get(),
            'kota' => Kabupaten::get()
        );

        if ($jenis == 'pendamping') {
            $title = 'Pendamping Lokakarya';
            return view('pages.admin.internal.createPendamping', ['menu' => 'internal', 'title' => $title, 'datas' => $datas]);
        }
        if ($jenis == 'penugasan ppnpn') {
            $title = 'Penugasan PPNPN';
        } else {
            $title = 'Penugasan Pegawai';
        }
        return view('pages.admin.internal.createPenugasan', ['menu' => 'internal', 'title' => $title, 'datas' => $datas]);

    }

    public function createUsername($fullName)
    {
        // Convert the full name to lowercase
        $lowercaseName = strtolower($fullName);

        // Remove any leading or trailing spaces
        $trimmedName = trim($lowercaseName);

        // Replace multiple spaces with a single space
        $singleSpacedName = preg_replace('/\s+/', ' ', $trimmedName);

        // Split the name into parts
        $nameParts = explode(' ', $singleSpacedName);

        // Concatenate the parts into a username
        $username = implode('', $nameParts);

        return $username;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();
        // if ($r['jenis'] == 'Penugasan PPNPN') {
        //     $r['kegiatan'] = '-';
        //     $r['golongan'] = '-';
        //     $r['tempat'] = '-';
        //     $r['tgl_kegiatan'] = '2024-07-02';
        // }
        // dump($r['golongan']);
        if ($r['jenis'] == 'Pendamping Lokakarya') {
            $r['is_verif'] = 'belum';
            Pendamping::create($r);

            return redirect()->route('internal.index')->with('message', 'store');
        }

        // $lowercaseName = strtolower($r['nama']);

        // // Remove any leading or trailing spaces
        // $trimmedName = trim($lowercaseName);

        // // Replace multiple spaces with a single space
        // $singleSpacedName = preg_replace('/\s+/', ' ', $trimmedName);

        // // Split the name into parts
        // $nameParts = explode(' ', $singleSpacedName);

        // // Concatenate the parts into a username
        // $username = implode('', $nameParts);

        // dd($r);
        $r['is_verif'] = 'belum';
        $r['jabatan'] = $r['jabatan'] ?? '';

        Internal::create($r);

        return redirect()->route('internal.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $datas = array(
            'golongan' => JabatanPenugasanGolongan::get(),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'jabatanPpnpn' => JabatanPenugasanPpnpn::get(),
            'kota' => Kabupaten::get(),
            'penugasan' => Internal::find($id),
            'pendamping' => Pendamping::find($id),
        );



        // dd($datas['penugasan']->jenis);

        if ($datas['penugasan']->jenis == 'Pendamping Lokakarya') {
            $title = 'Pendamping Lokakarya';
            return view('pages.admin.internal.editPendamping', ['menu' => 'internal', 'title' => $title, 'datas' => $datas]);
        }

        if ($datas['penugasan']->jenis == 'Penugasan PPNPN') {
            $title = 'Penugasan PPNPN';
        } else {
            $title = 'Penugasan Pegawai';
        }

        return view('pages.admin.internal.editPenugasan', ['menu' => 'internal', 'title' => $title, 'datas' => $datas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $r = $request->all();

        if ($r['jenis'] == 'Pendamping Lokakarya') {
            // dd(true);
            $r['is_verif'] = 'belum';

            Pendamping::update($r);

            return redirect()->route('internal.index')->with('message', 'store');
        }

        // dd($r);
        $data = Internal::find($r['id']);
        $r['is_verif'] = 'belum';
        $r['jabatan'] = $r['jabatan'] ?? '';


        $data->update($r);
        return redirect()->route('internal.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = Internal::find($id);
        $data->delete();
        return response()->json($data);
    }

    public function updatePegawai(Request $request)
    {
        $r = $request->all();
        // dd($r);
        $data = Internal::find($r['id']);

        if ($r['jenis'] == 'Pendamping Lokakarya') {
            // dd(true);
            $r['is_verif'] = 'sudah';

            Pendamping::update($r);

            return redirect()->route('pegawai.show', $r['id_pegawai'])->with('message', 'store');
        }

        // dd($r);
        $r['is_verif'] = 'sudah';
        $r['jabatan'] = $r['jabatan'] ?? '';


        $data->update($r);
        return redirect()->route('pegawai.show', $r['id_pegawai'])->with('message', 'update');
    }
}