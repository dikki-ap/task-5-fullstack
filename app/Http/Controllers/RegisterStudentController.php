<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterStudentController extends Controller
{
    // Membuat Constructor untuk menyimpan middleware
    public function __construct()
    {
        // Semua halaman yang ada di class ini bisa diakses jika statusnya adalah GUEST
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:student')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
    }
    
    // Function ke Halaman Register Student
    public function register_student(){
        return view('register.register_student', [
            "title" => "Student Register"
        ]);
    }

    // Function menyimpan data Student ke DB
    public function store(Request $request){

        // Menampung input user ke $validatedData dengan fungsi validate()
        $validatedData = $request->validate([
            // Bisa juga menggunakan array
            "name" => "required|max:30", //  => ['required', 'max:30']
            "username" => "required|min:3|max:16|unique:students",
            "email" => "required|email:dns|unique:students",
            "password" => "required|min:3|max:16",
            "gender" => "required|min:4|max:6",

        ]);

        // Cara 1
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // Hash Password
        // Cara 2
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Jika yang diatas true, maka akan otomatis akan dijalankan yang bawah
        // Simpan data Student ke DB dengan fungsi create()
        Student::create($validatedData);

        // Flash Message (BISA DENGAN INI)
        // $request->session()->flash('success', 'Registration Successful');

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/login/student')->with('success', 'Registrasi Berhasil');
    }
}
