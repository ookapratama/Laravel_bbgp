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
        $cek = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        $user = Admin::where('username', $request->username)->first();
        //Laravel automatically Hash check password for logins if you use the Auth::attempt(), and make sure your password column in your db is named password else this will not work
        if ($cek) {
            Session::put('user_id', $user->id);
            Session::put('name', $user->name);
            Session::put('username', $user->username);
            // Session::put('role', $user->role);
            Session::put('cek', true);
            return redirect()->route('dashboard')->with('message', 'sukses login');
        } else {
            return redirect()->back()->with('message', 'gagal login');
        }
    }

   
}
