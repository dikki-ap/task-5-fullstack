<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // All Teachers
    // Function ke Halaman All Teachers
    public function index(){
        return view('teachers', [
            "title" => "Teacher List",
            // Menampilkan Teacher dengan id di atas 1
            "teachers" => Teacher::where('id', '>', 1)->get()
        ]);
    }

    // Teacher by Username
    // Function ke Halaman Teacher by Username
    public function show(Teacher $teacher){
        return view('teacher', [
            "title" => $teacher->name,
            // load() untuk menggunakan Lazy Eager Load untuk mengatasi N+1 Problem
            "materials" => $teacher->materials->load(['category', 'teacher']),
            "count" => $teacher->materials->load(['category', 'teacher'])->count(),
            "teacher" => $teacher
        ]);
    }
}
