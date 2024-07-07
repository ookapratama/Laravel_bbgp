<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::get();
        return view('pages.admin.akun.index', ['menu' => 'akun', 'datas' => $data]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            
        // dd($r);

        $r['password'] = bcrypt($r['password']);
        Admin::create($r);
        User::create($r);

        return redirect()->route('akun.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Admin::find($id);

        return view('pages.admin.akun.edit', ['menu' => 'akun', 'datas' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $r = $request->all();
        $data = Admin::find($r['id'])->first();
        $dataUser = User::find($r['id'])->first();

        $r['password'] = bcrypt($r['password']);

        $data->update($r);
        $dataUser->update($r);
        return redirect()->route('akun.index')->with('message', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = Admin::find($id);
        $data->delete();
        return response()->json($data);
    }



    public function regis(Request $r)
    {
        // $r = $request->all();
        // dd($r);
        $reg = [];
        $role = strtolower($r->role);
        $user = strtolower(str_replace(' ', '', $r->username));
        // dd($role);
        $reg['name'] = $r->name;
        $reg['username'] = $user;
        $reg['no_ktp'] = (string) $r->no_ktp;
        $reg['role'] = $role;
        $reg['password'] = bcrypt($r['password']);
        Admin::create($reg);
        User::create($reg);

        return response()->json([
            'status' => true,
            'data' => $reg
        ]);
        // return redirect()->route('akun.index')->with('message', 'store');
    }

}
