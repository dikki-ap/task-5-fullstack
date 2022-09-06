<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // Membuat constructor untuk menyimpan middleware
    public function __construct()
    {
        // Semua halaman yang ada di class ini bisa diakses jika statusnya adalah GUEST
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }
    
    // Function ke Halaman Login Admin
    public function login(){
        return view('login.login_admin', [
            "title" => "Admin Login"
        ]);
    }

    // Function untuk melakukan pengecekan Login Admin
    public function authenticate(Request $request){
        // Menampung data yang diinput user ke dalam variabel $credentials dengan fungsi validate()
        $credentials = $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        // Cek informasi yang ditampung $credentials dan melakukan login dengan fungsi attempt()
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate(); // Untuk menghindari 'session fixation'

            // Redirect ke halaman yang telah ditentukan jika berhasil
            return redirect()->intended('/dashboard/materials');
        }

        return back()->with('loginError', 'Login Gagal!'); // Redirect ke halaman yang sama dan tampilkan pesan Error
    }

    // Function untuk melakukan Logout Admin
    public function logout(Request $request){
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
