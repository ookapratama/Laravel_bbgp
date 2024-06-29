<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.dashboard.index', ['menu' => 'dashboard']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile($id)
    {
        $data = Admin::find($id);
        return view('pages.admin.profile.index', ['menu' => 'profile', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function profile_update(Request $request)
    {
        $r = $request->all();
        
        $admin = Admin::find($r['id']);
        $user = User::find($r['id']);
        if($r['password'] != null) {
            $r['password'] = bcrypt($r['password']); 
            // dump('ubah password');
        }
        else {
            $r['password'] = $r['oldPassword'];
        }
        // dd(true);
        
        $admin->update($r);
        $user->update($r);
        
        return redirect()->route('dashboard')->with('message', 'update profile');
        
    }

}
