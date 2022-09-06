<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DashboardMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Function ke Halaman Index (All Materials)
    public function index()
    {
        return view('dashboard.materials.index', [
            "title" => "Material List",
            // Cek jika admin yang login menggunakan fungsi guard()
            // Jika admin login tampilkan semua material menggunakan Materiall:all()
            // Jika bukan, tampilkan berdasarkan 'id' teacher yang sedang login, dan material dengan field 'teacher_id'
            "materials" => (Auth::guard('admin')->check()) ? Material::all() : Material::where('teacher_id', auth('teacher')->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Function ke Halaman Add Material
    public function create()
    {
        return view('dashboard.materials.create', [
            "title" => "Add Material",
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  Function menambahkan Material ke dalam DB
    public function store(Request $request)
    {
        // Menampung inputan user ke variabel $validatedData dengan fungsi validate()
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'filename' => 'required|file|max:5120|mimes:pdf',
            'description' => 'required'
        ]);

        // $validatedData['filename'] = $_FILES['filename']['name'];
        // $x = explode('.', $validatedData['filename']);
        // $extension = strtolower(end($x));
        // $generate = date("ymd_his_").rand(1111,9999);
        // $newFilename = $x[0] . "_" . $generate . "." . $extension;
        // $validatedData['filename'] = $newFilename;

        // Menyimpan PDF ke Storage di dalam folder 'material-pdf'
        $validatedData['filename'] = $request->file('filename')->store('material-pdf');

        // Jika admin yang melakukan CREATE maka set 'teacher_id' nilainya 1 (Admin)
        if(Auth::guard('admin')->check()){
            $validatedData['teacher_id'] = 1;
        // Jika tidak, set 'teacher_id' sesuai dengan 'id' teacher yang sedang CREATE (login)
        }else{
            $validatedData['teacher_id'] = auth('teacher')->user()->id;
        }

        // Buat 'short_title' dengan limit 200 huruf
        $validatedData['short_title'] = Str::limit(strip_tags($request['title']), 27);
        
        // Buat 'excerpt' dengan limit 200 huruf
        $validatedData['excerpt'] = Str::limit(strip_tags($request['description']), 75);

        // Tambahkan data Material ke DB dengan fungsi create()
        Material::create($validatedData);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/materials')->with('success', 'Berhasil menambahkan Material baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */

    //  Function ke Halaman Detail Material
    public function show(Material $material)
    {
        return view('dashboard.materials.show', [
            "title" => "Material Details",
            "material" => $material,
            // Mengambil Galleries 'url' berdasarkan 'material_id' yang sedang dipilih
            "images" => MaterialGallery::select('url')->where('material_id', '=', $material->id)->get(), 
            "i" => 1
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */

    //  Function ke Halaman Edit Material
    public function edit(Material $material)
    {
        return view('dashboard.materials.edit', [
            "title" => "Edit Material",
            "material" => $material,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */

    //  Function untuk EDIT data Material ke DB
    public function update(Request $request, Material $material)
    {
        // Menampung input user ke variabel $validatedData dengan fungsi validate()
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'filename' => 'required|file|max:5120|mimes:pdf',
            'description' => 'required'
        ]);

        // Jika ada file PDF yang lama
        if($request->file('filename')){
            // Hapus file PDF yang lama dari Storage
            Storage::delete($material->filename);

            // Upload Image baru, dan masukkan di folder material-images
            $validatedData['filename'] = $request->file('filename')->store('material-pdf');
        } 

        // Buat 'short_title' dengan limit 200 huruf
        $validatedData['short_title'] = Str::limit(strip_tags($request['title']), 27);

        // Buat 'excerpt' dengan limit 200 huruf yang diambil dari 'description'
        $validatedData['excerpt'] = Str::limit(strip_tags($request['description']), 75);

        // Update Material ke DB dengan fungsi update() berdasarkan kondisi where()
        Material::where('id', $material->id)->update($validatedData);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/materials')->with('success', 'Material berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */

    //  Function untuk menghapus data Material dari DB
    public function destroy(Material $material)
    {
        // Ambil semua Galleries dari Material berdasarkan 'material_id'
        $galleries = MaterialGallery::select('*')->where('material_id', '=', $material->id)->get();

        // Lakukan looping dengan foreach karena data berbentuk Array Assocative
        foreach($galleries as $gallery){
            // Hapus Gallery dari DB berdasarkan 'id'
            MaterialGallery::destroy($gallery->id);

            // Hapus file Gallery dari Storage berdasarkan 'url'
            Storage::delete($gallery->url);
        }

        // Hapus file PDF dari Storage berdasarkan 'filename'
        Storage::delete($material->filename);

        // Hapus Material dari DB berdasrkan 'id'
        Material::destroy($material->id);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/materials')->with('success', 'Berhasil menghapus Material');
    }
}
