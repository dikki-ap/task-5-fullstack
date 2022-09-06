<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DashboardGalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Function ke Halaman Index Galleries (Menampilkan semua list Galleries)
    public function index()
    {
        return view('dashboard.galleries.index', [
            "title" => "Gallery List",
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

    // Function ke Halaman Delete Gallery
    public function create(MaterialGallery $materialGallery)
    {
        // Mengambil 'material_id' yang di klik user menggunakan $_GET
        $material_id = $_GET['material_id'];

        return view('dashboard.galleries.delete', [
            "title" => "Delete Gallery",
            "galleries" => $materialGallery,
            "material_id" => $material_id,
            "material_name" => Material::where('id', '=', $material_id)->pluck('title'), // Menampilkan nama material berdasarkan 'material_id' yang diambil
            "images" => $materialGallery::select('*')->where('material_id', '=', $material_id)->get() // Menampilkan semua galleries berdasarkan 'material_id' yang diambil
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  Function untuk menyimpan data gallery ke DB
    public function store(Request $request)
    {
        // Mengambil nama material menggunakan $_POST
        $material_name = $_POST["material_name"];

        // Menampung data yang diinput user ke variabel $validatedData dengan fungsi validate()
        $validatedData = $request->validate([
            "material_id" => 'required',
            "url" => 'image|file|max:2048|mimes:png,jpg,jpeg',
        ]);

        // Jika Imagenya ada di upload
        if($request->file('url')){
            // Upload Image, dan masukkan di folder material-images
            $validatedData['url'] = $request->file('url')->store('material-images');
        }else{
            // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
            return redirect('/dashboard/galleries')->with('failed', 'Wajib upload gambar!');
        }

        // Simpan data yang diinput ke dalam DB dengan fungsi create()
        MaterialGallery::create($validatedData);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/galleries')->with('success', 'Gambar baru berhasil ditambahkan ke '. $material_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialGallery  $materialGallery
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialGallery $materialGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialGallery  $materialGallery
     * @return \Illuminate\Http\Response
     */

    // Function ke Halaman Edit Gallery
    public function edit(MaterialGallery $materialGallery)
    {
        // Mengambil 'material_id' menggunakan $_GET
        $material_id = $_GET['material_id'];
        
        return view('dashboard.galleries.edit', [
            "title" => "Edit Gallery",
            "galleries" => $materialGallery,
            "material_id" => $material_id,
            "material_name" => Material::where('id', '=', $material_id)->pluck('title'), // Menampilkan nama material berdasarkan 'material_id' yang diambil
            "images" => $materialGallery::select('*')->where('material_id', '=', $material_id)->get() // Menampilkan semua galleries berdasarkan 'material_id' yang diambil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialGallery  $materialGallery
     * @return \Illuminate\Http\Response
     */

    // Function untuk Edit Gallery ke DB
    public function update(Request $request, MaterialGallery $materialGallery)
    {
        // Mengambil 'image_id' dengan $_POST
        $image_id = $_POST['image_id'];

        // Syarat Image yang dapat diupload
        $rules = [
            "url" => 'image|file|max:2048|mimes:png,jpg,jpeg',
        ];

        // Menampung inputan user ke variabel $validatedData dengan fungsi validate()
        $validatedData = $request->validate($rules);

        // Jika ada gambar baru yang diupload
        if($request->file('url')){
            // Hapus gambar lama yang ada di direktori
            Storage::delete($request->oldImage);
            // Upload Image baru, dan masukkan di folder material-images
            $validatedData['url'] = $request->file('url')->store('material-images');
        } // Jika tidak ada, biarkan gunakan image lama atau image yang telah disediakan "DEFAULT"

        // Update Gallery di DB dengan fungsi update() berdasarkan kondisi where()
        $materialGallery::where('id', $image_id)->update($validatedData);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/galleries')->with('success', 'Image berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialGallery  $materialGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MaterialGallery $materialGallery)
    {
        // Mengambil 'image_id' dengan $_POST
        $image_id = $_POST['image_id'];
        
        // Jika ada gambar yang lama
        if($request->image_url){
            // Hapus Gambar dari direktori
            Storage::delete($request->image_url);
        }

        // Hapus Gallery dari DB
        $materialGallery::destroy($image_id);

        // Redirect ke halaman yang ditentukan dan tampilkan pesan yang ditentukan
        return redirect('/dashboard/galleries')->with('success', 'Image berhasil dihapus');
    }
}
