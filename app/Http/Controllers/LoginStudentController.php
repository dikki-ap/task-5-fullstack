<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginStudentController extends Controller
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

    // Function ke Halaman Login Student
    public function login_student(){
        return view('login.login_student', [
            "title" => "Student Login"
        ]);
    }

    // Function untuk Login Student
    public function authenticate(Request $request){

        // Menampung input user ke $credentials dengan fungsi validate()
        $credentials = $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        // Cek informasi yang ditampung $credentials
        if(Auth::guard('student')->attempt($credentials)){
            $request->session()->regenerate(); // Untuk menghindari 'session fixation'

            // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
            return redirect()->intended('/materials');
        }

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return back()->with('loginError', 'Login Gagal!');
    }

    // Function Logout Student
    public function logout(Request $request){
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/');
    }
}
