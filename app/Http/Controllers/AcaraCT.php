<?php

namespace App\Http\Controllers;

use App\AcaraModel;
use App\Http\Requests\StoreAcaraRequest;
use App\Http\Requests\UpdateAcaraRequest;
use App\ViaAcaraModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AcaraCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(AcaraModel::orderBy('id_status','DESC'))
            ->addIndexColumn()
            ->addColumn('judul_acara',function($row){
                return '<span>'. $row->judul_acara .'</span>';
            })
            ->addColumn('tanggal',function($row){
                return '<span>'. $row->tanggal .'</span>';
            })
            ->addColumn('id_status', function($row){
                if($row->id_status == 1){
                    return '<span class="badge badge-success">Aktif</span>';
                }else if($row->id_status == 0){
                    return '<span class="badge badge-danger">Tidak Aktif</span>';
                }
            })
            ->addColumn('status_presensi', function($row){
                if($row->status_presensi == 1){
                    return '<span class="badge badge-success">Buka</span>';
                }else if($row->status_presensi == 0){
                    return '<span class="badge badge-danger">Tutup</span>';
                }
            })
            ->addColumn('action', function($row){
                if($row->id_status){
                    return '<div class="form-button-action">
                    <a href="'. url()->current().'/'.$row->id.'/edit"><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
                    <button type="button" data-toggle="tooltip" title="status" class="btn btn-link btn-danger" data-original-title="status" onclick="status('.$row->id.')"><i class="fa fa-eye"></i></button>
                    <a href="'. url()->current().'/narasumber'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="narasumber" class="btn btn-link btn-primary btn-lg" data-original-title="narasumber"><i class="fa fa-user"></i></button></a>
                    <a href="'. url()->current().'/pendaftar'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="pendaftar" class="btn btn-link btn-warning btn-lg" data-original-title="pendaftar"><i class="fa fa-money-bill"></i></button></a>
                    </div>';
                } else {
                    return '<div class="form-button-action">
                    <a href="'. url()->current().'/'.$row->id.'/edit"><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
                    <button type="button" data-toggle="tooltip" title="status" class="btn btn-link btn-success" data-original-title="status" onclick="status('.$row->id.')"><i class="fa fa-eye"></i></button>
                    <a href="'. url()->current().'/narasumber'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="narasumber" class="btn btn-link btn-primary" data-original-title="narasumber"><i class="fa fa-user"></i></button></a>
                    <a href="'. url()->current().'/pendaftar'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="pendaftar" class="btn btn-link btn-warning" data-original-title="pendaftar"><i class="fa fa-money-bill"></i></button></a>
                    </div>';
                }
            })
            ->addColumn('presensi', function($row){
                if($row->status_presensi == 1){
                    return '<button type="button" data-toggle="tooltip" title="presensi" class="btn btn-link btn-danger" data-original-title="presensi" onclick="presensi('.$row->id.')"><i class="fas fa-pen-square fa-1x"></i></button>
                    <a href="'. url()->current().'/sertifikat'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="sertifikat" class="btn btn-link btn-primary" data-original-title="sertifikat"><i class="fas fa-file-export"></i></button></a>
                    <a href="'. url()->current().'/kuesioner'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="kuesioner" class="btn btn-link btn-primary" data-original-title="kuesioner"><i class="fas fa-tasks"></i></button></a>
                    ';
                }else if($row->status_presensi == 0){
                    return '<button type="button" data-toggle="tooltip" title="presensi" class="btn btn-link btn-success" data-original-title="presensi" onclick="presensi('.$row->id.')"><i class="fas fa-pen-square fa-1x"></i></button>
                    <a href="'. url()->current().'/sertifikat'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="sertifikat" class="btn btn-link btn-primary" data-original-title="sertifikat"><i class="fas fa-file-export"></i></button></a>
                    <a href="'. url()->current().'/kuesioner'.'/'.$row->id.'/"><button type="button" data-toggle="tooltip" title="kuesioner" class="btn btn-link btn-primary" data-original-title="kuesioner"><i class="fas fa-tasks"></i></button></a>
                    ';
                }
            })
            ->filter(function ($instance) use ($request) {

                if ($request->get('id_status') != null) {
                    $instance->where('id_status', $request->get('id_status'));
                }

                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->orWhere('judul_acara', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['judul_acara','tanggal','id_status','status_presensi','presensi','action'])
            ->make(true);
        }

        $model['base_url'] = url()->current();
        return view("admin/master/acara/index",compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/master/acara/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcaraRequest $request)
    {
  

        $model = new AcaraModel;
        $model->judul_acara = $request->judul_acara;
        $model->tema = $request->tema;
        $model->tanggal = $request->tanggal;
        $model->jam = $request->jam;
        $model->jam_akhir = $request->jam_akhir;
        $model->kuota = $request->kuota;
        $model->link_zoom = $request->link_zoom;
        $model->link_youtube = $request->link_youtube;
        $model->harga_zoom_umum = $request->harga_zoom_umum;
        $model->harga_zoom_aptikom = $request->harga_zoom_aptikom;
        $model->harga_youtube_umum = $request->harga_youtube_umum;
        $model->harga_youtube_aptikom = $request->harga_youtube_aptikom;
        $model->id_status = $request->id_status;
        $model->link_materi = $request->link_materi;

        $file_foto = $request->img;
        $filename_foto = date("y-m-d")."_".$file_foto->getClientOriginalName();
        $request->img->move('assets/img/webinar/',$filename_foto);
        
        $model->img = $filename_foto;
        $model->save();
        
        $model2 = new ViaAcaraModel;
        $model2->id_acara = $model->id;
        $model2->via_zoom_sertifikat = (isset($request->via_zoom_sertifikat)) ? $request->via_zoom_sertifikat : NULL   ;
        $model2->via_youtube_sertifikat = ( isset($request->via_youtube_sertifikat) ) ? $request->via_youtube_sertifikat : NULL   ;
        $model2->via_zoom_gratis = (isset($request->via_zoom_gratis)) ? $request->via_zoom_gratis : NULL   ;
        $model2->via_youtube_gratis = (isset($request->via_youtube_gratis)) ? $request->via_youtube_gratis : NULL   ;
        $model2->save();

        Alert::success('Tambah data Berhasil', 'Tambah Data Acara Berhasil');
        return redirect("admin/master/acara");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model['data'] = AcaraModel::find($id);
        return view("admin/master/acara/edit",compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcaraRequest $request, $id)
    {
        // dd($request->all());

        $model = AcaraModel::find($id);
        $model->judul_acara = $request->judul_acara;
        $model->tema = $request->tema;
        $model->tanggal = $request->tanggal;
        $model->jam = $request->jam;
        $model->jam_akhir = $request->jam_akhir;
        $model->kuota = $request->kuota;
        $model->link_zoom = $request->link_zoom;
        $model->link_youtube = $request->link_youtube;
        $model->harga_zoom_umum = $request->harga_zoom_umum;
        $model->harga_zoom_aptikom = $request->harga_zoom_aptikom;
        $model->harga_youtube_umum = $request->harga_youtube_umum;
        $model->harga_youtube_aptikom = $request->harga_youtube_aptikom;
        $model->id_status = $request->id_status;
        $model->link_materi = $request->link_materi;

        if ($request->img) {
            $file_foto = $request->img;
            $filename_foto = date("y-m-d")."_".$file_foto->getClientOriginalName();
            $request->img->move('assets/img/webinar/',$filename_foto);
            $model->img = $filename_foto;
        }
        $model->save();
        
        $model2 =  ViaAcaraModel::where("id_acara",$id)->first() ;
        $model2->via_zoom_sertifikat = (isset($request->via_zoom_sertifikat)) ? $request->via_zoom_sertifikat : NULL   ;
        $model2->via_youtube_sertifikat = ( isset($request->via_youtube_sertifikat) ) ? $request->via_youtube_sertifikat : NULL   ;
        $model2->via_zoom_gratis = (isset($request->via_zoom_gratis)) ? $request->via_zoom_gratis : NULL   ;
        $model2->via_youtube_gratis = (isset($request->via_youtube_gratis)) ? $request->via_youtube_gratis : NULL   ;
        $model2->save();

        Alert::success('Edit Berhasil', 'Edit Acara Berhasil');
        return redirect("admin/master/acara");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function status($id){
        $model = AcaraModel::find($id);

        if ( $model->id_status == 1) {
            $model->id_status = 0;
            $model->save();
            return response()->json([
                'state' => true,
                'data' => null,
                'message' => 'Anda berhasil non aktifkan data!'
                ]
            );
        } else {
            $model->id_status = 1;
            $model->save();
            return response()->json([
                'state' => true,
                'data' => null,
                'message' => 'Anda berhasil mengaktifkan data!'
                ]
            );
        }
    }

    public function status_presensi($id){
        $model = AcaraModel::find($id);

        if ( $model->status_presensi == 1) {
            $model->status_presensi = 0;
            $model->save();
            return response()->json([
                'state' => true,
                'data' => null,
                'message' => 'Anda berhasil tutup prensensi!'
                ]
            );
        } else {
            $model->status_presensi = 1;
            $model->save();
            return response()->json([
                'state' => true,
                'data' => null,
                'message' => 'Anda berhasil buka prensensi!'
                ]
            );
        }
    }

}
