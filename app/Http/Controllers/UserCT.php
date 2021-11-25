<?php

namespace App\Http\Controllers;

use App\Ms_institusi;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class UserCT extends Controller
{

    public function index(Request $request){
        
        if ($request->ajax()) {
            return DataTables::of(User::query())
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
            ->addColumn('no_aptikom',function($row){
                return '<span>'. $row->no_aptikom .'</span>';
            })
            ->addColumn('action', function($row){

                    return '<div class="form-button-action">
                    <button type="button" data-toggle="tooltip" title="" class="btn btn-success btn-sm" data-original-title="Hapus" onclick="reset('.$row->id.')">Reset Password</button>
                    </div>';
                
            })->filter(function ($instance) use ($request) {

                if ($request->get('id_status') != null) {
                    $instance->where('id_status', $request->get('id_status'));
                }

                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->orWhere('no_aptikom', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['email','no_telp','nama','id_status','no_aptikom', 'action'])
            ->make(true);
        }

        $model['base_url'] = url()->current();
        return view("admin/master/user/index",compact('model'));
    }

    public function edit(Request $request){
        $model = User::find(auth()->user()->id);
        $model->email = $request->email;
        $model->no_telp = $request->no_telp;
        $model->id_wilayah = $request->provinsi;
        $model->id_pekerjaan = $request->id_pekerjaan;

        if (Ms_institusi::where('id',$request->institusi)->count() > 0) {
            $model->id_pt = $request->institusi;
        } else {
            $id_pt = Ms_institusi::create([
                'nama_pt' => $request->institusi
            ])->id;
            $model->id_pt = $id_pt;
        }
        $model->save();

        Alert::success('Edit data Berhasil', 'Edit Data Profile Berhasil');
        return redirect()->back();
    }

    public function reset($id){
        try {
            $model = User::find($id);
            $model->password = bcrypt("123123123");
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
}
