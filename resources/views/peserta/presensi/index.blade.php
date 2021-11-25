@extends('peserta.master')
@section('title',"Acara Yang Diikuti")

@section('subTitle',"Acara Yang Diikuti")

@section('content')

<div class="tab-content project-list-group" id="myTabContent">	
    <div class="tab-pane fade active show" id="navpills-1">

        @foreach ($data as $item)
            <div class="card">
                <div class="project-info">
                    <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                        <p class="text-primary mb-1">#{{ $item->id }}</p>
                        <h5 class="title font-w600 mb-2"><a href="post-details.html" class="text-black">{{ $item->AcaraModel->judul_acara }}</a></h5>
                        <div class="text-dark"><i class="fa fa-calendar-o mr-3" aria-hidden="true"></i>Tanggal : {{ \Carbon\Carbon::parse($item->AcaraModel->tanggal)->format('d F Y')}}, {{ date("H:i",strtotime($item->AcaraModel->jam)) }} WIB - {{ date("H:i",strtotime($item->AcaraModel->jam_akhir)) }} WIB</div>
                    </div>
                    <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="ml-2">
                                <span>Status presensi Acara </span>
                                @if ($item->AcaraModel->status_presensi == 1)
                                    <h5 class="mb-0 pt-1 font-w50 text-info">AKTIF</h5>
                                @else
                                    <h5 class="mb-0 pt-1 font-w50 text-danger">TIDAK AKTIF</h5>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="ml-2">
                                <span>Status presensi Peserta </span>
                                @if ($item->status_presensi == 1)
                                    <h5 class="mb-0 pt-1 font-w50 text-info">Sudah Presensi</h5>
                                @else
                                    <h5 class="mb-0 pt-1 font-w50 text-danger">Belum Prensesi</h5>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="ml-2">
                                
                                @if ($item->status_presensi == 1)
                                  
                                @else
                                    <span class="mr-2" >Action </span>
                                    <a href="/peserta/app/presensi/{{ $item->id }}" class="btn btn-primary btn-sm" >Prensesi</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        @endforeach


    </div>

</div>
    
@endsection