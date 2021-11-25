<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use App\JawabanModel;
use App\KuesionerModel;
use App\Ms_pekerjaan;
use App\PendaftaranModel;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PesertaCT extends Controller
{
    //

    public function dashboard(){
        $data['acara'] = AcaraModel::orderBy("id_status","DESC")->orderBy("tanggal","ASC")->get();
        return view("peserta/dashboard",compact('data'));
    }

    public function app(){
        return view("peserta/app");
    }

    public function acara(){
        $data = AcaraModel::orderBy('id_status',"DESC")->get();
        // $today = Carbon::now()->isoFormat('D MMMM Y');

        // dd($today);
        return view("peserta/acara/index",compact('data'));
    }

    public function daftarAcara($id){
        $data = AcaraModel::find($id);
        if (!$data) {
            return redirect()->back();
        }
        return view("peserta/acara/daftarAcara",compact("data"));
    }

    public function acaradiikuti(){
        $data = PendaftaranModel::where("id_user",auth()->user()->id)->get();
        return view("peserta/acaradiikuti/index",compact("data"));
    }

    public function presensi(){
        $data = PendaftaranModel::where("id_user",auth()->user()->id)->get();
        return view("peserta/presensi/index",compact("data"));
    }

    public function actionPresensi($id){
        $data = PendaftaranModel::find($id);

        if ($data->AcaraModel->status_presensi == 1) {
            PendaftaranModel::where("id",$id)->update([
                'status_presensi' => 1
            ]);
            
            Alert::success('Prensesi Berhasil', 'Terima kasih sudah presensi acara ini !');
        } else {
            Alert::error('Prensesi Gagal', 'Status Presensi Acara ini Non Aktif !');
        }
    
        return redirect()->back();
    }

    public function kuesioner(){
        $data = PendaftaranModel::where("id_user",auth()->user()->id)->get();
        return view("peserta/kuesioner/index",compact("data"));
    }

    public function kuesionerShow($id){
        $pendaftaran = PendaftaranModel::find($id);
        $data = KuesionerModel::where("id_acara",$pendaftaran->id_acara)->get();
        $acara = AcaraModel::find($pendaftaran->id_acara);

        if ($acara->status_kuesioner !== 1) {
            Alert::error('Pengisian Kuesioner Gagal', 'Status Kuesioner Acara ini Non Aktif !');
            return redirect()->back();
        } else {
            return view("peserta/kuesioner/show",compact("data","acara",'id'));
            # code...
        }
        

        // dd($data);
    }

    public function kuesionerAdd(Request $request,$id){

        // dd(PendaftaranModel::find($id));

        // dd(array_keys($request->all()['essai']));

        // dd($request->input());

        // $search_array = array($request->input());
        // if (array_key_exists('pg/jawaban_5', $search_array)) {
        //     echo "The 'first' element is in the array";
        // }
        // die;

        foreach ($request->only('essai') as $value) {
            $id3 = array_keys($value);
            $model = new JawabanModel;
            $model->id_user = auth()->user()->id;
            $model->id_soal = $id3[0];
            $model->jawaban = $value[$id3[0]];
            $model->save();
        }


        foreach ($request->only('pg') as $value) {

            foreach ($value as $item ) {
                $text = explode("-",$item);
                $model = new JawabanModel;
                $model->id_user = auth()->user()->id;
                $model->id_soal = $text[1];
                $model->jawaban = $text[0];
                $model->save();
            }
        }

        foreach ($request->only('cb') as $value) {

            foreach ($value as $item ) {
                $text = explode("-",$item);
                $id2 = $text[1];
                $jawaban[] = $text[0];
            }
            $model = new JawabanModel;
            $model->id_user = auth()->user()->id;
            $model->id_soal = $id2;
            $model->jawaban = json_encode($jawaban);
            $model->save();
        }

        $model = PendaftaranModel::find($id);
        $model->status_kuesioner = 1;
        $model->save();

        Alert::success('Pengisian Kuesioner Berhasil', 'Pengisian Kuesioner Berhasil!');
        return redirect('peserta/app/kuesioner');
    }


    public function file(){
        $data = PendaftaranModel::where("id_user",auth()->user()->id)->get();
        return view("peserta/file/index",compact('data'));
    }

    public function fileSertifikat($id){
        $data = PendaftaranModel::find($id);
        // dd($data);

        if ($data->id_user !== auth()->user()->id ) {
            Alert::error('Download Sertifikat Gagal', 'data Tidak Sesuai !');
            return redirect()->back();
        }
        if ($data->status !== "1") {
            Alert::error('Download Sertifikat Gagal', 'Pembayaran Belum Divalidasi !');
            return redirect()->back();
        }
        if ($data->AcaraModel->file_sertifikat == null) {
            Alert::error('Download Sertifikat Gagal', 'Sertifikat Belum Tersedia !');
            return redirect()->back();
        }
        if ($data->status_presensi !== 1) {
            Alert::error('Download Sertifikat Gagal', 'User Belum Presensi !');
            return redirect()->back();
        }

        if ($data->status_kuesioner !== 1) {
            Alert::error('Download Sertifikat Gagal', 'User Belum Mengisi Kuesioner !');
            return redirect()->back();
        }

        return view("peserta/file/showSertifikat",compact('data'));
    }

    public function generateSertifikat($id){
        $pendaftaran = PendaftaranModel::find($id);
        // dd($pendaftaran);

        if ($pendaftaran->id_user !== auth()->user()->id ) {
            return false;
        }
        if ($pendaftaran->status !== "1") {
            return false;
        }
        if ($pendaftaran->status_presensi !== 1) {
            return false;
        }
        if ($pendaftaran->status_kuesioner !== 1) {
            return false;
        }

        $data = AcaraModel::find($pendaftaran->id_acara);
        $gambar =  public_path()."/assets/img/sertifikat/".$data->file_sertifikat;
        $image = imagecreatefromjpeg($gambar);


        
        if ($data->warna_sertifikat == "putih") {
            $warna = imageColorAllocate($image, 255, 255, 255);
        }elseif($data->warna_sertifikat == "biru"){
            $warna = imageColorAllocate($image, 17, 80, 131);
        }else {
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


        if (strlen($pendaftaran->id) == 1) {
            $id = "00".$pendaftaran->id;
        }

        if (strlen($pendaftaran->id) == 2) {
            $id = "0".$pendaftaran->id;
        }

        if (strlen($pendaftaran->id) >= 3) {
            $id = $pendaftaran->id;
        }


        $number = $id.$data->format_nomer;
        
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

    public function profile(){
        $model['pekerjaan'] = Ms_pekerjaan::all();
        return view("peserta/profile",compact('model'));
    }
}
