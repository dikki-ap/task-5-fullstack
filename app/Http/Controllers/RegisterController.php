<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Function ke Halaman Register Teacher
    public function register_teacher(){
        return view('register.register_teacher', [
            "title" => "Teacher Register"
        ]);
    }

    // Function menyimpan data Register ke DB
    public function store(Request $request){
        
        // Menampung input user ke $validatedData dengan fungsi validate()
        $validatedData = $request->validate([
            // Bisa juga menggunakan array
            "name" => "required|max:30", //  => ['required', 'max:30']
            "username" => "required|min:3|max:16|unique:teachers",
            "email" => "required|email:dns|unique:teachers",
            "password" => "required|min:3|max:16",
            "gender" => "required|min:4|max:6",
            "image" => 'image|file|max:2048|mimes:png,jpg,jpeg',

        ]);

        // Cara 1
        // $validatedData['password'] = bcrypt($validatedData['password']);

        // Hash Password
        // Cara 2
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Jika Imagenya ada di upload
        if($request->file('image')){
            // Upload Image, dan masukkan di folder teacher-profile-images
            $validatedData['image'] = $request->file('image')->store('teacher-profile-images');
        }

        // Jika yang diatas true, maka akan otomatis akan dijalankan yang bawah
        // Menyimpan data Teacher ke DB dengan fungsi create()
        Teacher::create($validatedData);

        // Flash Message (BISA DENGAN INI)
        // $request->session()->flash('success', 'Registration Successful');

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/login/teacher')->with('success', 'Registrasi Berhasil');
    }
}
