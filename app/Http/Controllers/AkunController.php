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
        $r = $request->all();
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
}
