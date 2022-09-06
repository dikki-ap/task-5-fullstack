<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use App\Models\Teacher;
use App\Models\MaterialGallery;

class MaterialController extends Controller
{
    // All Materials
    // Function ke Halaman All Materials
    public function index(){
        return view('materials', [
            "title" => "All Materials",
            // with() digunakan untuk Eager Load untuk mengatasi N+1 Problem
            // Panggil Query scope dengan nama lanjutannya, scopeFilter() menjadi ->filter()
            // ->withQueryString() merupakan pasangan paginate() untuk membuat URL GET yang digunakan yang lainnya seperti by Category atau by teacher juga bisa berfungsi
            // /posts?category=programming&page=2
            "materials" => Material::latest()->filter(request(['keyword', 'category', 'teacher']))->paginate(7)->withQueryString()
        ]);
    }

    // Materials by ID
    // Menggunakan Route Model Binding
    public function show(Material $material){
        return view('material', [
            "title" => "Details",
            "material" => $material,
            "images" => MaterialGallery::select('url')->where('material_id', '=', $material->id)->get(),
            "i" => 1
        ]);
    }
}
