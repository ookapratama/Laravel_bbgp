<?php

namespace App\Http\Controllers;

use App\Models\Internal;
use App\Models\InternalPpnpn;
use App\Models\JabatanPenugasanGolongan;
use App\Models\JabatanPenugasanPegawai;
use App\Models\JabatanPenugasanPpnpn;
use App\Models\Kabupaten;
use App\Models\Pegawai;
use App\Models\PegawaiPpnpn;
use App\Models\Pendamping;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

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

            'dataPenugasanPegawai' => Pegawai::orderByDesc('id')->where('jenis_pegawai', 'BBGP')->where('is_verif', 'sudah')->get(),
            'dataPenugasanPpnpn' => Pegawai::orderByDesc('id')->where('jenis_pegawai', 'PPNPN')->where('is_verif', 'sudah')->get(),
            'dataPegawai' => Pegawai::get(),
        );
        $dataPendamping = Pendamping::get();
        $dataPpnpn = PegawaiPpnpn::get();
        // $merge = $data->merge($dataPendamping);
        // dd($merge);

        return view('pages.admin.internal.index', ['menu' => 'internal', 'datas' => $data, 'kota' => $kota, 'dataPendamping' => $dataPendamping, 'dataPpnpn' => $dataPpnpn]);
    }

    public function verifikasi(string $id)
    {
        // dd($id);
        $data = '';
        $getData = '';
        $data = Internal::find($id);
        $getData = Internal::find($id);
        if ($data == null) {
            $data = Pendamping::find($id);
            $getData = Pendamping::find($id);
        }
        $data->is_verif = 'sudah';
        $data->save();
        return response()->json([
            'status' => $data,
            'data' => $getData,
        ]);
    }


    // Lokakarya
    public function indexLokakarya($nik)
    {
        // dump($nik);
        $pegawai = Pegawai::where('no_ktp', $nik)->first();
        // dump($pegawai->no_ktp);
        $datas = array(
            'penugasanLokakarya' => Internal::where('jenis', 'Pendamping Lokakarya')->where('nik', $pegawai->no_ktp)->get(),
            'penugasanPpnpn' => Internal::where('nik', $nik)->get(),
            'getJenisLokakarya' => Internal::where('jenis', 'Pendamping Lokakarya')->where('nik', $nik)->first(),
            'getNama' => Internal::where('nik', $pegawai->no_ktp)->first(),

            // 'penugasanLokakaryaPpnpn' => Internal::where('jenis', 'Pendamping Lokakarya')->where('nik', $pegawai->no_ktp)->get() ,
            // 'penugasanPpnpn' => Internal::where('nik', $pegawai->no_ktp)->get(),
            'getJenisLokakaryaPpnpn' => Internal::where('jenis', 'Pendamping Lokakarya')->where('nik', $pegawai->no_ktp)->first(),
            'getNamaPpnpn' => Pegawai::where('no_ktp', $pegawai->no_ktp)->first(),

            // 'penugasanLokakaryaPpnpn' => InternalPpnpn::where('id', $pegawai->id)->get() ,
            // // 'penugasanPpnpn' => InternalPpnpn::where('id', $pegawai->id)->get(),
            // 'getJenisLokakaryaPpnpn' => InternalPpnpn::where('id', $pegawai->id)->first(),
            // 'getNamaPpnpn' => InternalPpnpn::where('id', $pegawai->id)->first(),
            // 'getJenisPpnpn' => InternalPpnpn::where('jenis', 'Pendamping PPNPN')->where('nik', $nik)->first(),

        );
        // dd($datas);
        if (session('role') == 'pegawai') {
            // return view('pages.admin.pegawai.show', ['menu' => ''], compact('datas'));            
            return redirect()->route('pegawai.show', ['id' => session('no_ktp')])->with('message', 'update');
        }

        return view('pages.admin.internal.indexLokakarya', ['menu' => 'internal'], compact('datas'));
    }

    public function createLokakarya($id)
    {
        // $pegawai = Pegawai::find($id);
        // if ($pegawai == null) {
        //     $pegawai = PegawaiPpnpn::find($id);
        // }
        // $datas = array(
        //     'golongan' => JabatanPenugasanGolongan::get(),
        //     'jabatanPegawai' => JabatanPenugasanPegawai::get(),
        //     'jabatanPpnpn' => JabatanPenugasanPpnpn::get(),
        //     'dataPegawai' => Pegawai::get(),
        // );

        $datas = array(
            'dataPenugasanLokakarya' => Internal::where('jenis', 'Pendamping Lokakarya')->get(),
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'dataPegawai' => Pegawai::get(),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
            'kota' => Kabupaten::get()
        );

        $pegawai = Pegawai::find($id) ?? PegawaiPpnpn::find($id);

        // dd($pegawai);
        // dd($id);
        return view('pages.admin.penugasan.lokakarya', ['menu' => ''], compact('pegawai', 'datas'));
    }

    // Khusus Pegawai yg login
    public function storeLokakaryaPegawai(Request $r)
    {
        // dd($r->all());
        $r = $r->all();
        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];
        Internal::create($r);


        return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'store');
    }

    // Khusus Admin dan jajarannya
    public function storeLokakarya(Request $r)
    {
        // dd($r->all());
        $r = $r->all();
        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];
        // dd($r);
        Internal::create($r);

        if (session('role') == 'pegawai') {
            return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'store');

        }

        return redirect()->route('internal.index')->with('message', 'store');
    }

    public function editLokakarya($id)
    {
        // $loka = Internal::find($id);
        // // dd($loka);
        // $pegawai = Pegawai::find($id);
        // if ($pegawai == null) {
        //     $pegawai = PegawaiPpnpn::find($id);
        // }
        // $datas = array(
        //     'golongan' => JabatanPenugasanGolongan::get(),
        //     'jabatanPegawai' => JabatanPenugasanPegawai::get(),
        //     'jabatanPpnpn' => JabatanPenugasanPpnpn::get(),
        //     'kota' => Kabupaten::get(),
        //     'lokakarya' => $loka,
        // );
        $penugasan = Internal::find($id);
        // dd($penugasan);
        $datas = array(
            'dataPenugasanLokakarya' => Internal::where('jenis', 'Pendamping Lokakarya')->get(),
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'dataPegawai' => Pegawai::get(),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
            'kota' => Kabupaten::get(),
            'mulai_kegiatan' => $penugasan->tgl_kegiatan . ' ' . $penugasan->jam_mulai,
            'selesai_kegiatan' => $penugasan->tgl_selesai_kegiatan . ' ' . $penugasan->jam_selesai,
        );
        // dd($datas);

        $pendamping = Internal::find($id);

        // dd($pendamping);
        return view('pages.admin.penugasan.Editlokakarya', ['menu' => ''], compact('pendamping', 'datas'));
    }

    public function updateLokakarya(Request $r)
    {
        // dd($r->all());
        $loka = Internal::find($r->id);
        // dd($loka);

        $r = $r->all();
        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];
        // dd($loka);

        $loka->update($r);
        // dd( route('pegawai.session('no_ktp')));
        if (session('role') == 'pegawai') {
            return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'update');

        }

        return redirect()->route('internal.index.lokakarya', $loka->nik)->with('message', 'update');
    }

    // penugasan pegawan BBGP
    public function indexPegawai($nik)
    {
        // dd($nik);
        $pegawai = Pegawai::where('no_ktp', $nik)->first() ?? Pegawai::find($nik);
        // dd($pegawai);

        $datas = array(
            'penugasanPegawai' => Internal::where('jenis', 'Penugasan Pegawai')->where('nik', $pegawai->no_ktp)->get(),
            'penugasanPpnpn' => Internal::where('nik', $pegawai->no_ktp)->get(),
            'getJenisPegawai' => Internal::where('jenis', 'Penugasan Pegawai')->where('nik', $pegawai->no_ktp)->first(),
            // 'getJenisPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->where('nik', $nik)->first(),

        );
        // dd($datas);

        return view('pages.admin.internal.indexPenugasan', ['menu' => ''], compact('datas'));
    }

    public function createPegawai($id)
    {
        $datas = array(
            'dataPenugasanPegawai' => Internal::where('jenis', 'Penugasan Pegawai')->get(),
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'dataPegawai' => Pegawai::get(),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
        );

        $pegawai = Pegawai::find($id);
        return view('pages.admin.penugasan.pegawai', ['menu' => ''], compact('pegawai', 'datas'));
    }


    public function storePegawai(Request $r)
    {
        // dd($r->mulai_kegiatan);
        // dd($r->all());
        // $r = $r->all();

        // dd($r['mulai_kegiatan']);
        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];

        // dd($r->all());

        Internal::create($r->all());


        return redirect()->route('internal.index')->with('message', 'store');
    }

    public function editPegawai($id)
    {
        $penugasan = Internal::find($id);

        $datas = array(
            'dataPenugasanPegawai' => Internal::where('jenis', 'Penugasan Pegawai')->get(),
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'dataPegawai' => Pegawai::find($id),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
            'mulai_kegiatan' => $penugasan->tgl_kegiatan . ' ' . $penugasan->jam_mulai,
            'selesai_kegiatan' => $penugasan->tgl_selesai_kegiatan . ' ' . $penugasan->jam_selesai,
        );



        // dd($penugasan);
        return view('pages.admin.internal.editPenugasan', ['menu' => ''], compact('penugasan', 'datas'));
    }


    public function updatePegawai(Request $r)
    {
        // dd($r->mulai_kegiatan);
        // dd($r->all());
        // $r = $r->all();
        // dd($r['mulai_kegiatan']);
        $find = Internal::find($r->id);
        $r = $r->all();
        // dd($r);
        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];

        // dd($r->all());
        // dump($find);
        // dd($pegawai);
        $pegawai = Pegawai::where('no_ktp', $find->nik)->first();

        $find->update($r);
        // Internal::udpate($r->all());
        if (session('role') == 'pegawai') {
            return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'update');

        }
        return redirect()->route('internal.index.pegawai', $find->nik)->with('message', 'update');
    }


    //  PEgawai PPNPN
    public function indexPpnpn($nik)
    {
        // dd($nik);
        $datas = array(
            'pegawaiPpnpn' => Pegawai::where('id', $nik)->first(),
            'penugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'getNama' => PegawaiPpnpn::where('nik', $nik)->first(),
            // 'getJenisPpnpn' => InternalPpnpn::where('jenis', 'Penugasan PPNPN')->first(),
            // 'getJenisPpnpn' => InternalPpnpn::where('jenis', 'Penugasan PPNPN')->where('nik', $nik)->first(),

        );
        // dd($datas);

        return view('pages.admin.internal.indexPpnpn', ['menu' => ''], compact('datas'));
    }

    public function createPpnpn($id)
    {
        $pegawai = Pegawai::find($id);
        $datas = array(
            'dataPenugasanPpnpn' => Internal::where('jenis', 'Penugasan PPNPN')->get(),
            'dataPegawai' => Pegawai::get(),
            'jabatanPegawai' => JabatanPenugasanPegawai::get(),
            'golongan' => JabatanPenugasanGolongan::get(),
            'kota' => Kabupaten::get(),
        );
        // dd($pegawai);
        return view('pages.admin.penugasan.ppnpn', ['menu' => ''], compact('pegawai', 'datas'));
    }


    public function storePpnpn(Request $r)
    {

        // dd($r->mulai_kegiatan);
        // dd($r->all());
        $r = $r->all();

        // dd($r['mulai_kegiatan']);
        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];

        // dd($r);

        Internal::create($r);
        // InternalPpnpn::create($r);
        return redirect()->route('internal.index')->with('message', 'store');
    }

    public function editPpnpn($id)
    {
        // $pegawai = PegawaiPpnpn::find($id);
        $penugasan = Internal::where('id', $id)->first();
        $datas = array(
            'dataPegawai' => Pegawai::all(),
            'jabatanPegawai' => JabatanPenugasanPegawai::all(),
            'golongan' => JabatanPenugasanGolongan::all(),
            'kota' => Kabupaten::all(),
            'mulai_kegiatan' => $penugasan->tgl_kegiatan . ' ' . $penugasan->jam_mulai,
            'selesai_kegiatan' => $penugasan->tgl_selesai_kegiatan . ' ' . $penugasan->jam_selesai,
        );

        // dd($datas);

        // if (!$pegawai) {
        //     return redirect()->route('internal.index')->with('error', 'Pegawai tidak ditemukan.');
        // }

        return view('pages.admin.internal.editPpnpn', ['menu' => ''], compact('datas', 'penugasan'));
    }

    public function updatePpnpn(Request $r)
    {
        $pegawai = Internal::find($r->id);

        // if (!$pegawai) {
        //     return redirect()->route('internal.index')->with('error', 'Pegawai tidak ditemukan.');
        // }
        // dd($pegawai);
        $r = $r->all();

        $mulai_kegiatan = explode(" ", $r["mulai_kegiatan"]);
        $r['tgl_kegiatan'] = $mulai_kegiatan[0];
        $r['jam_mulai'] = $mulai_kegiatan[1];

        $selesai_kegiatan = explode(" ", $r["selesai_kegiatan"]);
        $r['tgl_selesai_kegiatan'] = $selesai_kegiatan[0];
        $r['jam_selesai'] = $selesai_kegiatan[1];

        // dd($r);
        // Update data
        $pegawai->update($r);

        if (session('role') == 'pegawai') {
            return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'update');

        }

        return redirect()->route('internal.index')->with('message', 'update');
    }



    public function hapusLoka($id)
    {
        // dd($id);
        $data = Internal::find($id);
        $data->delete();
        return response()->json($data);
    }

    public function hapusPpnpn($id)
    {
        $data = Internal::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
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
            $r['is_verif'] = 'sudah';
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
        $r['is_verif'] = 'sudah';
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
            $r['is_verif'] = 'sudah';

            Pendamping::update($r);

            return redirect()->route('internal.index')->with('message', 'store');
        }

        // dd($r);
        $data = Internal::find($r['id']);
        $r['is_verif'] = 'sudah';
        $r['jabatan'] = $r['jabatan'] ?? '';


        $data->update($r);
        return redirect()->route('internal.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $data = Internal::find($id);
        $data->delete();
        return response()->json($data);
    }

    public function hapusPenugasan($id)
    {
        // dd($id);
        $data = Internal::find($id);
        $data->delete();
        return response()->json($data);
    }

    // public function updatePegawai(Request $request)
    // {
    //     $r = $request->all();
    //     // dd($r);
    //     $data = Internal::find($r['id']);

    //     if ($r['jenis'] == 'Pendamping Lokakarya') {
    //         // dd(true);
    //         $r['is_verif'] = 'sudah';

    //         Pendamping::update($r);

    //         return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'store');
    //     }

    //     // dd($r);
    //     $r['is_verif'] = 'sudah';
    //     $r['jabatan'] = $r['jabatan'] ?? '';


    //     $data->update($r);
    //     return redirect()->route('pegawai.show', session('no_ktp'))->with('message', 'update');
    // }

    public function cariLokakarya(Request $r)
    {
        // dd($r->all());

        $input = $r->all();

        // Mencari data berdasarkan input yang diterima
        $data = Internal::where(function ($query) use ($input) {
            $query->where('nip', $input['nip']);
            if (!empty($input['nama'])) {
                $query->where('nama', 'like', '%' . $input['nama'] . '%');
            }
            if (!empty($input['kegiatan'])) {
                $query->orWhere('kegiatan', 'like', '%' . $input['kegiatan'] . '%');
            }
            if (!empty($input['kota'])) {
                $query->orWhere('kota', 'like', '%' . $input['kota'] . '%');
            }
            if (!empty($input['hotel'])) {
                $query->orWhere('hotel', 'like', '%' . $input['hotel'] . '%');
            }
        })->get();
        // dd($data);
        // Mengembalikan hasil pencarian
        return $data;
    }
}
