<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialGallery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Function Relasi (Inverse) dari tabel Material ke tabel Material_Galleries (1 To 1)
    public function material(){
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    // Mengakses RouteKeyName untuk ModelBinding menggunakan field 'material_id'
    public function getRouteKeyName()
    {
        return 'material_id';
    }
}
