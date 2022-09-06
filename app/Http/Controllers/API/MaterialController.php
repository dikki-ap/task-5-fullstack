<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Material;

class MaterialController extends Controller
{
    public function all(Request $request){
        $id = $request->input('id');
        
        if($id){
            $Material = Material::with(['category', 'galleries'])->find($id);
            if(!is_null($Material)){
                return ResponseFormatter::success(
                    $Material,
                    'Data Material by ID berhasil diambil'
                );
            }else{
                return ResponseFormatter::error(
                    null,
                    'Data Material by ID tidak ada',
                    404
                );
            }
        }else{
            if(Material::count()){
                $Material = Material::with(['category', 'galleries'])->get();

                return ResponseFormatter::success(
                    $Material,
                    'Data Semua Material berhasil diambil'
                );
            }else{
                return ResponseFormatter::error(
                    null,
                    'Data Material tidak ada',
                    404
                );
            }
        }
    }
}
