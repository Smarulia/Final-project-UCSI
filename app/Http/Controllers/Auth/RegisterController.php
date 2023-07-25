<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class RegisterController extends Controller
{
    public function register_user(){

        return view('auth.register_user');
    }  
    
    function register_lucture() {
        return view('auth.register_culture');
    }

    function register_user_post(Request $request) {
        $request->validate([
            'name' => 'required',
            'id_student' => 'required|unique:users,id_student',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->role = 'student';
        $user->id_student = $request->id_student;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.login')->with('success', 'Register Success');
    }
    
    public function register_admin(){
        return view('auth.register_admin');
    }

    function register_admin_post(Request $request) {
        $request->validate([
            'name' => 'required',
            'id_number' => 'required|unique:admins,id_number',
            'password' => 'required|min:6',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->id_number = $request->id_number;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect()->route('admin.login')->with('success', 'Register Success');
    }

    function register_lucture_post(Request $request) {
        $request->validate([
            'name' => 'required',
            'id_student' => 'required|unique:users,id_student',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->id_student = $request->id_student;
        $user->role = 'culture';
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.login')->with('success', 'Register Success');
    }

}
