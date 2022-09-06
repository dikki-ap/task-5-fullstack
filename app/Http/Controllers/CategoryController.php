<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // All Categories
    // Function ke Halaman Semua Category (All Categories)
    public function index(){
        return view('categories', [
            "title" => "Category List",
            "categories" => Category::all(),
            "count" => Category::count()
        ]);
    }

    // Menggunakan Route Model Binding
    // Function ke Halaman Category by Id
    public function show(Category $category){
        return view('category', [
            "title" => $category->name,
            // load() untuk menggunakan Lazy Eager Load untuk mengatasi N+1 Problem
            "materials" => $category->materials->load(['category', 'teacher']),
            "count" => $category->materials->load(['category', 'teacher'])->count(),
            "category" => $category->name
        ]);
    }
}
