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
                                <span>Status Acara </span>
                                @if ($item->AcaraModel->id_status == 1)
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
                                <span>Harga</span>
                                <h5 class="mb-0 pt-1 font-w500 text-black">
                                @if ($item->via == 1 ||$item->via == 2)
                                    @if ($item->via == 1)
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $item->AcaraModel->harga_zoom_umum }}         
                                        @else

                                            {{ $item->AcaraModel->harga_zoom_aptikom }} 
                                        @endif 
                                    @else                                    
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $item->AcaraModel->harga_youtube_umum }}
       
                                        @else
                                            {{ $item->AcaraModel->harga_youtube_aptikom }} 
                                        @endif    
                                    @endif

                                    @if ($item->status == 1)
                                        <a href="/peserta/app/buktiPembayaran/{{ $item->id }}">Bukti Pembayaran</a></h5>
                                    @endif
                                @else
                                    Gratis
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

                    

                    <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                        <div class="d-flex align-items-center">

                            <div class="ml-2">
                                <span>Link Acara</span>
                                <h5 class="mb-0 pt-1 font-w500 text-info">

                                    @switch($item->via)
                                        @case(1)
                                            <a target="_blank"  href="{{ $item->AcaraModel->link_zoom }}">Klik Disini (Zoom)</a></h5>
                                            @break
                                        @case(2)
                                            <a target="_blank"  href="{{ $item->AcaraModel->link_youtube }}">Klik Disini (Youtube)</a></h5>
                                            @break
                                        @case(3)
                                        <a target="_blank"  href="{{ $item->AcaraModel->link_zoom }}">Klik Disini (Zoom)</a></h5>
                                            @break
                                        @case(4)
                                        <a target="_blank"  href="{{ $item->AcaraModel->link_youtube }}">Klik Disini (Youtube)</a></h5>
                                            @break
                                        @default
                                            
                                    @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach


    </div>

</div>
    
@endsection