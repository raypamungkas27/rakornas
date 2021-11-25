<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use App\Http\Requests\ZoomSertifikatRequest;
use App\Ms_backup_pendaftaran;
use App\PendaftaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PendaftaranCT extends Controller
{
    //

    public function zoomSertifikat(ZoomSertifikatRequest $request,$id){
        $data['acara'] = AcaraModel::find($id);
        $data['pendaftaran'] = PendaftaranModel::where("id_user",auth()->user()->id)->where("id_acara",$id);
       

        if ($data['acara']->kuota <= $data['acara']->PendaftaranModel->where("status","!=","2")->count() ) {
            Alert::error('Daftar Gagal', 'Kuota Sudah Penuh');
            return redirect()->back();
        }
        
        if ($data['pendaftaran']->where("via","1")->first()) {
            Alert::error('Daftar Gagal', 'Anda sudah daftar acara ini');
            return redirect()->back();
        }


        if (!$data['acara']) {
            Alert::error('Daftar Gagal', 'Data Acara Tidak Ditemukan');
            return redirect()->back();
        }

        if ($data['acara']->id_status == 0) {
            Alert::error('Daftar Gagal', 'Data Acara Berstatus Tidak Aktif');
            return redirect()->back();
        }

        
        $data['pendaftaran'] = PendaftaranModel::where("id_user",auth()->user()->id)->where("id_acara",$id)->first();
        
        $file_foto = $request->upload;
        $filename_foto =auth()->user()->id."_".date("y-m-d")."_".$file_foto->getClientOriginalName();
        $request->upload->move('assets/img/bukti_pembayaran/',$filename_foto);
        
        $model = new PendaftaranModel;
        $model->id_user = auth()->user()->id;
        $model->id_acara = $id;
        $model->via = "1";
        $model->status = "0";
        $model->file = $filename_foto;
        $model->save();

        $id2 = $model->id;

        
        if ($data['pendaftaran']) {
            if ( $data['pendaftaran']->via != "1" ) {

                $data['backup'] = PendaftaranModel::find($data['pendaftaran']->id);
                $backup = new Ms_backup_pendaftaran;
                $backup->id_pendaftaran = $id2;
                $backup->file = $data['backup']->file;
                $backup->save();

                PendaftaranModel::find($data['pendaftaran']->id)->delete();
            }
        }
        

        Alert::success('Daftar Berhasil', 'Terima kasih sudah mendaftar acara ini !');
        return redirect()->back();

    }

    public function zoomGratis($id){
        $data['acara'] = AcaraModel::find($id);
        $data['pendaftaran'] = PendaftaranModel::where("id_user",auth()->user()->id)->where("id_acara",$id);

        if ($data['pendaftaran']->first()) {
            Alert::error('Daftar Gagal', 'Anda sudah daftar acara ini');
            return redirect()->back();
        }

        if (!$data['acara']) {
            Alert::error('Daftar Gagal', 'Data Acara Tidak Ditemukan');
            return redirect()->back();
        }

        if ($data['acara']->id_status == 0) {
            Alert::error('Daftar Gagal', 'Data Acara Berstatus Tidak Aktif');
            return redirect()->back();
        }

        $model = new PendaftaranModel;
        $model->id_user = auth()->user()->id;
        $model->id_acara = $id;
        $model->via = "3";
        $model->status = "0";
        $model->save();

        Alert::success('Daftar Berhasil', 'Terima kasih sudah mendaftar acara ini !');
        return redirect()->back();

    }

    public function youtubeSertifikat(ZoomSertifikatRequest $request,$id){
        $data['acara'] = AcaraModel::find($id);
        $data['pendaftaran'] = PendaftaranModel::where("id_user",auth()->user()->id)->where("id_acara",$id)->first();

        if ($data['pendaftaran']) {
            if ($data['pendaftaran']->via == "2" || $data['pendaftaran']->via == "1") {
                Alert::error('Daftar Gagal', 'Anda sudah daftar acara ini');
                return redirect()->back();
            }

        }


        if (!$data['acara']) {
            Alert::error('Daftar Gagal', 'Data Acara Tidak Ditemukan');
            return redirect()->back();
        }

        if ($data['acara']->id_status == 0) {
            Alert::error('Daftar Gagal', 'Data Acara Berstatus Tidak Aktif');
            return redirect()->back();
        }

        $data['pendaftaran'] = PendaftaranModel::where("id_user",auth()->user()->id)->where("id_acara",$id);
        if ($hapus = $data['pendaftaran']->where("via","4")->first()) {
            PendaftaranModel::find($hapus->id)->delete();
        }
        
        $file_foto = $request->upload;
        $filename_foto =auth()->user()->id."_".date("y-m-d")."_".$file_foto->getClientOriginalName();
        $request->upload->move('assets/img/bukti_pembayaran/',$filename_foto);

        $model = new PendaftaranModel;
        $model->id_user = auth()->user()->id;
        $model->id_acara = $id;
        $model->via = "2";
        $model->status = "0";
        $model->file = $filename_foto;
        $model->save();
        Alert::success('Daftar Berhasil', 'Terima kasih sudah mendaftar acara ini !');
        return redirect()->back();

    }

    public function youtubeGratis($id){
        $data['acara'] = AcaraModel::find($id);
        $data['pendaftaran'] = PendaftaranModel::where("id_user",auth()->user()->id)->where("id_acara",$id);

        if ($data['pendaftaran']->first()) {
            Alert::error('Daftar Gagal', 'Anda sudah daftar acara ini');
            return redirect()->back();
        }

        if (!$data['acara']) {
            Alert::error('Daftar Gagal', 'Data Acara Tidak Ditemukan');
            return redirect()->back();
        }

        if ($data['acara']->id_status == 0) {
            Alert::error('Daftar Gagal', 'Data Acara Berstatus Tidak Aktif');
            return redirect()->back();
        }

        $model = new PendaftaranModel;
        $model->id_user = auth()->user()->id;
        $model->id_acara = $id;
        $model->via = "4";
        $model->status = "0";
        $model->save();

        Alert::success('Daftar Berhasil', 'Terima kasih sudah mendaftar acara ini !');
        return redirect()->back();

    }


    public function buktiPembayaran($id){
        $model['data'] = PendaftaranModel::where('id',$id)->where("id_user",Auth()->User()->id)->first();
       

        if ($model['data']) {
            return view("peserta/buktiPembayaran",compact('model'));
        } else {
            Alert::error('Proses Gagal', 'Data Tidak Ditemukan !');
            return redirect()->back();
        }
        
    }

    function generateID() {
        $user = PendaftaranModel::whereDate('created_at', DB::raw('DATE(NOW())'))->orderBy('id', 'desc', )->count();
        if ($user != null) {
            $user = str_pad($user+1, 5, '0', STR_PAD_LEFT);
        } else {
            $user = "00001";
        }

        $uniqid = 'PE-'.Str::upper(Carbon::now('Asia/Jakarta')->format('ymd').str_pad($user, 5, '0', STR_PAD_LEFT));
        if ($this->barcodeNumberExists($uniqid)) {
            return $this->generateID();
        }
        return $uniqid;
    }
    function barcodeNumberExists($code) {
        return PendaftaranModel::where('id', $code)->exists();
    }


    public function sukses($id){

        try {
            $model = PendaftaranModel::find($id);
            $model->status = "1";
            $model->save();
            return response()->json([
                'state' => true,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'state' => false,
            ], 500);
        }
    }

    public function gagal($id){
        try {
            $model = PendaftaranModel::find($id);
            $model->status = "2";
            $model->save();
            $model->delete();
            return response()->json([
                'state' => true,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'state' => false,
            ], 500);
        }
    }
}
