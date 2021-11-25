<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use App\PendaftaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminCT extends Controller
{
    //

    public function dashboard(){
        return view("admin/dashboard");
    }

    public function pendaftar(Request $request,$id){

        // dd(PendaftaranModel::join("users","pendaftaran.id_user","=","users.id")->where("id_acara",$id));

        if ($request->ajax()) {
            return DataTables::of(PendaftaranModel::join("users","pendaftaran.id_user","=","users.id")->where("id_acara",$id))
            ->addIndexColumn()
            ->addColumn('email',function($row){
                return '<span>'. $row->User->email .'</span>';
            })
            ->addColumn('nama',function($row){
                return '<span>'. $row->User->name .'</span>';
            })
            ->addColumn('no_telp',function($row){
                return '<span>'. $row->User->no_telp .'</span>';
            })
            
            ->addColumn('status', function($row){

                if ($row->via == 3 || $row->via == 4) {
                    return '<span class="badge badge-warning">Tidak Pesan Sertifikat</span>';
                } else {
                    if($row->status == 1){
                        return '<span class="badge badge-success">success</span>';
                    }else if($row->status == 0){
                        return '<span class="badge badge-danger">Sedang validasi</span>';
                    }else{
                        return '<span class="badge badge-danger">Gagal</span>';
                    }

                }
                

            })
            ->addColumn('via', function($row){
                if($row->via == 1){
                    return '<span class="badge badge-success">Zoom Sertifikat</span>';
                }else if($row->via == 2){
                    return '<span class="badge badge-warning">Youtube Sertifikat</span>';
                }else if($row->via == 3){
                    return '<span class="badge badge-info">Zoom Gratis</span>';
                }else{
                    return '<span class="badge badge-info">Youtube Gratis</span>';
                }
            })
            ->filter(function ($instance) use ($request) {

                if ($request->get('status') != null) {
                    $instance->where('status', $request->get('status'));
                }

                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('name', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['email','nama','status','via','no_telp'])
            ->make(true);
        }

    $model['base_url'] = url()->current();
    $model['acara'] = AcaraModel::find($id);
    return view("admin/master/acara/pendaftar",compact('model'));
    }


    public function validasi(Request $request){
        // dd(PendaftaranModel::join("users","pendaftaran.id_user","=","users.id")->join("ms_acara","pendaftaran.id_acara","=","ms_acara.id")->where("via","!=","3")->where("via","!=","4")->get());
        $query = PendaftaranModel::select('pendaftaran.id as id','id_status_peserta',"file",'harga_zoom_umum','harga_zoom_aptikom','harga_youtube_umum','harga_youtube_aptikom','name','status','via','email','no_telp','judul_acara')->join("users","pendaftaran.id_user","=","users.id")->join("ms_acara","pendaftaran.id_acara","=","ms_acara.id")->where("via","!=","3")->where("via","!=","4")->orderBy("pendaftaran.status","asc");
        if ($request->ajax()) {
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('email',function($row){
                return '<span>'. $row->email .'</span>';
            })
            ->addColumn('no_telp',function($row){
                return '<span>'. $row->no_telp .'</span>';
            })
            ->addColumn('nama',function($row){
                return '<span>'. $row->name .'</span>';
            })
            ->addColumn('acara',function($row){
                return '<span>'. $row->judul_acara .'</span>';
            })
            ->addColumn('file',function($row){
                if ($row->Ms_backup_pendaftaran) {
                    return '<small class="badge bage-primary mb-2 mt-2"><a target="_blank"  href="'.asset("assets/img/bukti_pembayaran/")."/".$row->Ms_backup_pendaftaran->file .'">File 1</a></small>
                            <small class="badge bage-primary"><a target="_blank"  href="'.asset("assets/img/bukti_pembayaran/")."/".$row->file .'">File 2</a></small>';
                } else {
                    return '<small class="badge bage-primary mb-2 mt-2" ><a target="_blank"  href="'.asset("assets/img/bukti_pembayaran/")."/".$row->file .'">File 1</a></small>';
                }
                
            })
            ->addColumn('harga',function($row){
                if ($row->via == 1) {
                    if ($row->id_status_peserta == 1 || $row->id_status_peserta == 3) {
                        return '<span>'. $row->harga_zoom_umum .'</span>';
                    }
                    else{
                        return '<span>'. $row->harga_zoom_aptikom .'</span>';
                    }
                }else{
                    if ($row->id_status_peserta == 1 || $row->id_status_peserta == 3) {
                        return '<span>'. $row->harga_youtube_umum .'</span>';
                    }
                    else{
                        return '<span>'. $row->harga_youtube_aptikom .'</span>';
                    }
                }
            })
            ->addColumn('id_status', function($row){
                if($row->id_status_peserta == 0){
                    return '<span class="badge badge-primary">Admin</span>';
                }else if($row->id_status_peserta == 1){
                    return '<span class="badge badge-success">Umum</span>';
                }else if($row->id_status_peserta == 2){
                    return '<span class="badge badge-info">Anggota Aktif</span>';
                }else if($row->id_status_peserta == 3){
                    return '<span class="badge badge-warning">Anggota Tidak Aktif</span>';
                }else{
                    return '<span class="badge badge-info">Pengurus</span>';
                }
            })
            ->addColumn('status', function($row){
                if($row->status == 1){
                    return '<span class="badge badge-success">success</span>';
                }else if($row->status == 0){
                    return '<span class="badge badge-danger">Sedang validasi</span>';
                }else{
                    return '<span class="badge badge-danger">Gagal</span>';
                }
            })
            ->addColumn('via', function($row){
                if($row->via == 1){
                    return '<span class="badge badge-success">Zoom Sertifikat</span>';
                }else if($row->via == 2){
                    return '<span class="badge badge-warning">Youtube Sertifikat</span>';
                }else if($row->via == 3){
                    return '<span class="badge badge-info">Zoom Gratis</span>';
                }else{
                    return '<span class="badge badge-info">Youtube Gratis</span>';
                }
            })
            ->addColumn('action', function($row){
                if($row->status == 1){
                    return '<div class="form-button-action">
                    <button type="button" data-toggle="tooltip" title="gagal" class="btn btn-danger btn-sm" data-original-title="gagal" onclick="gagal('.(string)$row->id.')">Gagal</button>
                    </div>';
                }else if($row->status == 0){
                    return '<div class="form-button-action">
                    <button type="button" data-toggle="tooltip" title="sukses" class="btn btn-info btn-sm mr-3" data-original-title="sukses" onclick="sukses('."$row->id".')">Sukses</button>
                    <button type="button" data-toggle="tooltip" title="gagal" class="btn btn-danger btn-sm" data-original-title="gagal" onclick="gagal('."$row->id".')">Gagal</button>
                    </div>';
                }
            })
            ->filter(function ($instance) use ($request) {

                if ($request->get('status') != null) {
                    $instance->where('status', $request->get('status'));
                }

                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('name', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['email','id_status','harga','no_telp','acara','nama','status','via','file','action'])
            ->make(true);
        }


    $model['base_url'] = url()->current();
    return view("admin/master/validasi/index",compact('model'));
    }


    public function dataGagal(Request $request){
        $query = PendaftaranModel::select('pendaftaran.id as id','id_status_peserta',"file",'harga_zoom_umum','harga_zoom_aptikom','harga_youtube_umum','harga_youtube_aptikom','name','status','via','email','no_telp','judul_acara')->join("users","pendaftaran.id_user","=","users.id")->join("ms_acara","pendaftaran.id_acara","=","ms_acara.id")->where("via","!=","3")->where("via","!=","4")->where("status","2")->orderBy("pendaftaran.status","asc")->onlyTrashed();

        if ($request->ajax()) {
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('email',function($row){
                return '<span>'. $row->email .'</span>';
            })
            ->addColumn('no_telp',function($row){
                return '<span>'. $row->no_telp .'</span>';
            })
            ->addColumn('nama',function($row){
                return '<span>'. $row->name .'</span>';
            })
            ->addColumn('acara',function($row){
                return '<span>'. $row->judul_acara .'</span>';
            })
            ->addColumn('file',function($row){
                if ($row->Ms_backup_pendaftaran) {
                    return '<small class="badge bage-primary mb-2 mt-2"><a target="_blank"  href="'.asset("assets/img/bukti_pembayaran/")."/".$row->Ms_backup_pendaftaran->file .'">File 1</a></small>
                            <small class="badge bage-primary"><a target="_blank"  href="'.asset("assets/img/bukti_pembayaran/")."/".$row->file .'">File 2</a></small>';
                } else {
                    return '<small class="badge bage-primary mb-2 mt-2" ><a target="_blank"  href="'.asset("assets/img/bukti_pembayaran/")."/".$row->file .'">File 1</a></small>';
                }
                
            })
            ->addColumn('harga',function($row){
                if ($row->via == 1) {
                    if ($row->id_status_peserta == 1 || $row->id_status_peserta == 3) {
                        return '<span>'. $row->harga_zoom_umum .'</span>';
                    }
                    else{
                        return '<span>'. $row->harga_zoom_aptikom .'</span>';
                    }
                }else{
                    if ($row->id_status_peserta == 1 || $row->id_status_peserta == 3) {
                        return '<span>'. $row->harga_youtube_umum .'</span>';
                    }
                    else{
                        return '<span>'. $row->harga_youtube_aptikom .'</span>';
                    }
                }
            })
            ->addColumn('id_status', function($row){
                if($row->id_status_peserta == 0){
                    return '<span class="badge badge-primary">Admin</span>';
                }else if($row->id_status_peserta == 1){
                    return '<span class="badge badge-success">Umum</span>';
                }else if($row->id_status_peserta == 2){
                    return '<span class="badge badge-info">Anggota Aktif</span>';
                }else if($row->id_status_peserta == 3){
                    return '<span class="badge badge-warning">Anggota Tidak Aktif</span>';
                }else{
                    return '<span class="badge badge-info">Pengurus</span>';
                }
            })
            ->addColumn('status', function($row){
                if($row->status == 1){
                    return '<span class="badge badge-success">success</span>';
                }else if($row->status == 0){
                    return '<span class="badge badge-danger">Sedang validasi</span>';
                }else{
                    return '<span class="badge badge-danger">Gagal</span>';
                }
            })
            ->addColumn('via', function($row){
                if($row->via == 1){
                    return '<span class="badge badge-success">Zoom Sertifikat</span>';
                }else if($row->via == 2){
                    return '<span class="badge badge-warning">Youtube Sertifikat</span>';
                }else if($row->via == 3){
                    return '<span class="badge badge-info">Zoom Gratis</span>';
                }else{
                    return '<span class="badge badge-info">Youtube Gratis</span>';
                }
            })
            ->filter(function ($instance) use ($request) {

                if ($request->get('status') != null) {
                    $instance->where('status', $request->get('status'));
                }

                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('name', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['email','id_status','harga','no_telp','acara','nama','status','via','file'])
            ->make(true);
        }


    $model['base_url'] = url()->current();
    return view("admin/master/validasi/dataGagal",compact('model'));
    }
    
}
