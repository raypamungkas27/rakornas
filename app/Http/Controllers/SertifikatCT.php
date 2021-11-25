<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SertifikatCT extends Controller
{
    public function index($id){
        $data = AcaraModel::find($id);
        return view('admin/master/sertifikat/index',compact('data'));
    }

    public function add(Request $request,$id){

        $file_foto = $request->file_sertifikat;
        $filename_foto = date("y-m-d")."_".$file_foto->getClientOriginalName();
        $request->file_sertifikat->move('assets/img/sertifikat/',$filename_foto);

        AcaraModel::where("id",$id)->update([
            'file_sertifikat' => $filename_foto,
            'warna_sertifikat' => $request->warna_sertifikat,
            'format_nomer' => $request->format_nomer,
            'x_nomer' => $request->x_nomer,
            'y_nomer' => $request->y_nomer,
            'size_font_nomer' => $request->size_font_nomer,
            'y_nama' => $request->y_nama,
            'size_font_nama' => $request->size_font_nama,
        ]);

        Alert::success('Upload Berhasil', 'Upload Sertifikat Berhasil !');
        return redirect()->back();
    }

    public function edit(Request $request,$id){
        $model = AcaraModel::find($id);
        $model->warna_sertifikat = $request->warna_sertifikat;
        $model->format_nomer = $request->format_nomer;
        $model->x_nomer = $request->x_nomer;
        $model->y_nomer = $request->y_nomer;
        $model->size_font_nomer = $request->size_font_nomer;
        $model->y_nama = $request->y_nama;
        $model->size_font_nama = $request->size_font_nama;

        if ($request->file_sertifikat) {
            $file_foto = $request->file_sertifikat;
            $filename_foto = date("y-m-d")."_".$file_foto->getClientOriginalName();
            $request->file_sertifikat->move('assets/img/sertifikat/',$filename_foto);
            $model->file_sertifikat = $filename_foto;
        }
        $model->save();

        Alert::success('edit Berhasil', 'edit Sertifikat Berhasil !');
        return redirect()->back();
    }

    public function show($id){
        return view('admin/master/sertifikat/show',compact('id'));
    }

    public function generate($id){
        $data = AcaraModel::find($id);
        $gambar =  public_path()."/assets/img/sertifikat/".$data->file_sertifikat;
        $image = imagecreatefromjpeg($gambar);


        
        if ($data->warna_sertifikat == "putih") {
            $warna = imageColorAllocate($image, 255, 255, 255);
        } else {
            $warna = imageColorAllocate($image, 0, 0, 0);
        }

        $font = public_path()."/assets/img/sertifikat/arial-black.ttf";
      
        
        //definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
        $image_width = imagesx($image);
        
        //membuat textbox agar text centered
        $text_box = imagettfbbox($data->size_font_nama, 0, $font, auth()->user()->name);
        $text_width = $text_box[2] - $text_box[0]; // lower right corner - lower left corner
        $text_height = $text_box[3] - $text_box[1];
        $x = ($image_width / 2) - ($text_width / 2);

        $number = "123".$data->format_nomer;
        
        //generate sertifikat beserta namanya
        imagettftext($image, $data->size_font_nomer, 0,$data->x_nomer, $data->y_nomer, $warna, $font, $number);
        imagettftext($image, $data->size_font_nama, 0, $x, $data->y_nama, $warna, $font, auth()->user()->name);
        
        // if ($idWeb == '2') {
        // 	imagettftext($image, 46, 0, 1149, 758, $white, $font, $no);
        // 	imagettftext($image, $size, 0, $x, 1130, $white, $font, $nama);
        // } else {
        // 	imagettftext($image, 46, 0, 1115, 745, $white, $font, $no);
        // 	imagettftext($image, $size, 0, $x, 1080, $white, $font, $nama);
        // }
        //tampilkan di browser
        header("Content-type:  image/jpeg");
        imagejpeg($image);
        imagedestroy($image);

    }
}
