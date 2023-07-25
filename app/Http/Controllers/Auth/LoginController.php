<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginAdmin()
    {
        return view('auth.login_admin');
    }

    public function postLoginAdmin(Request $request)
    {
        $credentials = $request->only('id_number', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
        return redirect()->route('admin.ruangan');
        } else {
            return redirect()->back()->with('error', 'Email atau Password salah');
        }
    }
    public function loginUser()
    {
        return view('auth.login_user');
    }

    public function postLoginUser(Request $request)
    {
        $user = $request->only('id_student', 'password');
        if (auth()->attempt($user)) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back()->with('error', 'Email atau Password salah');
        }
    }

    function logout()
    {
        // logout
        Auth::logout();
        return redirect()->route('home');
        
    }
}
