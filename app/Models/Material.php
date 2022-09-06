<?php

namespace App\Models;

use App\Models\Teacher;
use App\Models\Category;
use App\Models\MaterialGallery;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;
    // use Sluggable;

    /* 
    Menggunakakan protected $guarded, agar dapat melakukan Mass Assignment kecuali field 'id'

    Bisa juga menggunakan protected $fillable = ['field_1','field_2','field_n']
    untuk menentukan field mana saja yang bisa diisi melalui Mass Assigment
    */
    protected $guarded = ['id'];

    
    protected $with = ['category', 'teacher'];

    // Fitur Query Scope
    // Nama Function WAJIB ada huruf scope: scopeNamanya() >> contoh scopeFilter
    public function scopeFilter($query, array $filters){
        // Versi ISSET
        // if(isset($filters['search']) ? $filters['search'] : false){
        //     return $query->where('title', 'like', '%'. $filters['search'] .'%')
        //           ->orWhere('body', 'like', '%'. $filters['search'] .'%');
        // }

        /* VERSI when() dan Null Coalescing Operator
        Menggunakan Null Coalescing Operator dan Method when()
        - Menggantikan Ternary Operator dan Isset
        (condition ?? falseValue, trueValue)
        ($filters['search'] ?? false, function($query, $search))

        Cek Kondisi, apakah $filters['search'] diinput user?
        Jika ada, masukkan ke dalam $serch parameter di Callback
        Jika tidak ada, masukkan false ke dalam $search parameter di Callback
        Untuk $query, akan masuk ke dalam parameter $query di Callback
        */
        // Filter untuk Title or Body (Versi Callback Function)
        $query->when($filters['keyword'] ?? false, function ($query, $keyword){
            return $query->where('short_title', 'like', '%'. $keyword .'%')
                  ->orWhere('excerpt', 'like', '%'. $keyword .'%');
        });

        // Filter untuk Category (Versi Callback Function)
        // $query->when($filters['category'] ?? false, function($query, $category){
        //     return $query->whereHas('category', function($query) use ($category){ // use ($category) untuk mendefinisikan whereHas('category') sama dengan $category parameter yang di atas, dan sama dengan yang di bawah juga
        //         $query->where('slug', $category);
        //     });
        // });

        // Filter untuk teacher (Versi Arrow Function)
        // $query->when($filters['teacher'] ?? false, fn($query, $teacher) =>
        //     $query->whereHas('teacher', fn($query) => // Tanpa harus menggunakan use ($teacher), karena Arrow Function Scope Parameternya Global
        //         $query->where('username', $teacher)
        //     )
        // );
    }

    // Function Relasi (Inverse) dari tabel Material ke tabel Category (1 To 1)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Function Relasi (Inverse) dari tabel Material ke tabel Teacher (1 To 1)
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    // Function Relasi dari tabel Material ke tabel Material_Galleries (1 to Many)
    public function galleries(){
        return $this->hasMany(MaterialGallery::class, 'material_id', 'id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }
}
