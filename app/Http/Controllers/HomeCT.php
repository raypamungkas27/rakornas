<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use Illuminate\Http\Request;

class HomeCT extends Controller
{
    //

    public function index(){
        $data = AcaraModel::orderBy("id_status","DESC")->orderBy("tanggal","ASC")->get();

        return view("index",compact('data'));
    }
}
