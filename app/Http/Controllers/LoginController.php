<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    // Membuat Constructor untuk menyimpan middleware
    public function __construct()
    {
        // Semua halaman yang ada di class ini bisa diakses jika statusnya adalah GUEST
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }

    // Function ke Halaman Login Teacher
    public function login_teacher(){
        return view('login.login_teacher', [
            "title" => "Teacher Login"
        ]);
    }

    // Function untuk melakukan Login Teacher
    public function authenticate(Request $request){

        // Menampung input user ke variabel $credentials dengan menggunakan fungsi validate()
        $credentials = $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        // Cek informasi yang ditampung $credentials
        if(Auth::guard('teacher')->attempt($credentials)){
            $request->session()->regenerate(); // Untuk menghindari 'session fixation'

            // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
            return redirect()->intended('/dashboard/materials');
        }

        // return @dd($credentials);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return back()->with('loginError', 'Login Gagal!');
    }

    // Function Logout Teacher
    public function logout(Request $request){
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/');
    }
}
