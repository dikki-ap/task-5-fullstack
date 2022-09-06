<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

// Menggunakan RESOURCE CONTROLLER
// Cek Route List dengan 'php artisan route:list'

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Function ke Halaman Index Category (menampilkan semua category)
    public function index()
    {
        return view('dashboard.categories.index', [
            "title" => "Category List",
            "categories" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Function ke Halaman Add Category
    public function create()
    {
        return view('dashboard.categories.create', [
            "title" => "Add New Category",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Function untuk CREATE (menyimpan) data Category baru ke DB
    public function store(Request $request)
    {
        // Menampung data yang diinput user ke variabel $validateData dengan fungsi validate()
        $validatedData = $request->validate([
            'name' => 'required|max:30|unique:categories',
        ]);

        // Menyimpan data yang diinput ke dalam DB dengan fungsi create()
        Category::create($validatedData);

        // Redirect ke halaman yang ditentukan dengan menampilkan pesan yang ditentukan
        return redirect('/dashboard/categories')->with('success', 'Kategori baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    // Function ke Halaman Edit Category
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            "title" => "Edit Category",
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    // Function untuk melakukan Edit data Category ke DB
    public function update(Request $request, Category $category)
    {
        // Menampung data yang diinput oleh user ke variabel $validatedData dengan fungsi validate()
        $validatedData = $request->validate([
            'name' => 'required|max:30|unique:categories',
        ]);

        // Mengubah data yang ada di DB dengan fungsi update() dengan kondisi where()
        Category::where('id', $category->id)->update($validatedData);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/categories')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    // Function untuk menghapus data Category dari DB
    public function destroy(Category $category)
    {
        // Menghapus data Category dari DB dengan fungsi destroy() berdasarkan field 'id'
        Category::destroy($category->id);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/categories')->with('success', 'Kategori berhasil dihapus');
    }
}
