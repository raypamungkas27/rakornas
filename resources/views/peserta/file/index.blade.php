@extends('peserta.master')
@section('title',"File")

@section('subTitle',"File")

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
                                <span>Status Acara </span>
                                @if ($item->AcaraModel->id_status == 1)
                                    <h5 class="mb-0 pt-1 font-w50 text-info">AKTIF</h5>
                                @else
                                    <h5 class="mb-0 pt-1 font-w50 text-danger">TIDAK AKTIF</h5>
                                @endif
                            </div>
                        </div>
                    </div>
            

                    @if ($item->via == 1 ||$item->via == 2)
                        <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                            <div class="d-flex align-items-center">

                                <div class="ml-2">
                                    <span>Status Pembayaran</span>
                                    @if ($item->status == 0)
                                        <h5 class="mb-0 pt-1 font-w500 text-warning">Validasi</h5>
                                    @elseif($item->status == 1)
                                        <h5 class="mb-0 pt-1 font-w500 text-success">Berhasil</h5>
                                    @else
                                        <h5 class="mb-0 pt-1 font-w500 text-danger">Gagal</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($item->via == 1 ||$item->via == 2)
                    <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                        <div class="d-flex align-items-center">

                            <div class="ml-2">
                                <span>Link Sertifikat</span>
                                @if ($item->status == 0)
                                    <h5 class="mb-0 pt-1 font-w500 text-warning">Pembayaran Masih Validasi</h5>
                                @elseif($item->status == 1)
                                    <h5 class="mb-0 pt-1 font-w500 text-primary"> <a href="/peserta/app/file/sertifikat/{{ $item->id }}" target="_blank" >Klik Disini</a></h5>
                                @else
                                    <h5 class="mb-0 pt-1 font-w500 text-danger">Pembayaran Gagal</h5>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endif
                    <div class="ml-2">
                        <span>Link Materi</span>
                        <h5 class="mb-0 pt-1 font-w500 text-primary"> <a href="{{ $item->AcaraModel->link_materi }}" target="_blank" >Klik Disini</a></h5>
                    </div>

                </div>
            </div>
            
        @endforeach


    </div>

</div>
    
@endsection