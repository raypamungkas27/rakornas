<?php

namespace App\Http\Controllers;

use App\Ms_institusi;
use App\Ms_wilayah;
use Illuminate\Http\Request;

class Select2CT extends Controller
{
    //

    public function daftarProvinsi(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Ms_wilayah::whereRaw("(nama_provinsi LIKE '%".$request->get('q')."%')")
            ->limit(30)
            ->get();
            return response()->json($data);
        }
    }

    public function daftarInstitusi(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Ms_institusi::whereRaw("(nama_pt LIKE '%".$request->get('q')."%')")
            ->limit(30)
            ->get();
            return response()->json($data);
        }
    }
}
