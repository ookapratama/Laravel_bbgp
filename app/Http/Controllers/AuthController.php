<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('pages.auth.login', ['menu' => 'login']);
    }

    public function login_action(Request $request)
    {
        if ($request->role == null && $request->username == 'admin') {
            $request->role = 'admin';
        }
        
        if ($request->role == null) {
            return redirect()->back()->with('message', 'gagal login');
        }

        $cek = Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role' => $request->role]);
        $user = Admin::where('username', $request->username)->where('role', $request->role)->first();

        if ($cek) {
            Session::put('user_id', $user->id);
            Session::put('name', $user->name);
            Session::put('username', $user->username);
            Session::put('role', $user->role);
            // Session::put('role', $user->role);
            Session::put('cek', true);
            return redirect()->route('dashboard')->with('message', 'sukses login');
        } else {
            return redirect()->back()->with('message', 'gagal login');
        }
    }

   
}
