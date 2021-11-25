<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use App\KuesionerModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class KuesionerCT extends Controller
{
    //

    public function index($id){
        $data = AcaraModel::find($id);
        return view('admin/master/kuesioner/index',compact('data'));
    }

    public function addPg(Request $request ,$id){
        
        foreach ($request->pilihan as $key ) {
            if (isset($key)) {
                $pilihan[] = $key;
            }
        }


        $model = new KuesionerModel;
        $model->id_acara = $id;
        $model->type = "pg";
        $model->soal = $request->soal;
        $model->pilihan = json_encode($pilihan);
        $model->save();

        Alert::success('Tambah Soal', 'Soal Berhasil Ditambahkan !');
        return redirect()->back();
    }

    public function addCb(Request $request,$id){
        foreach ($request->pilihan as $key ) {
            if (isset($key)) {
                $pilihan[] = $key;
            }
        }

        $model = new KuesionerModel;
        $model->id_acara = $id;
        $model->type = "cb";
        $model->soal = $request->soal;
        $model->pilihan = json_encode($pilihan);
        $model->save();

        Alert::success('Tambah Soal', 'Soal Berhasil Ditambahkan !');
        return redirect()->back();
    }

    public function addEssai(Request $request,$id){
        
        $model = new KuesionerModel;
        $model->id_acara = $id;
        $model->type = "essai";
        $model->soal = $request->soal;
        $model->save();

        Alert::success('Tambah Soal', 'Soal Berhasil Ditambahkan !');
        return redirect()->back();
    }
}
