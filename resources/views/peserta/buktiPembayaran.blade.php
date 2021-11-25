@extends('peserta.master')
@section('title',"Bukti Pembayaran")

@section('subTitle',"Bukti Pembayaran")

@section('content')
    <div class="card">
        <div class="card-header">
            Bukti Pembayaran Acara {{ $model['data']->AcaraModel->judul_acara }} <button onclick="print()" class="btn btn-primary btn-sm "> <i class="fa fa-print mr-1" ></i>Print </button>
        </div>
        <div class="card-body invoice" id="invoice">
            <center>
                 <h4>
                    Bukti Pembayaran     
                </h4> 
            </center>
            <div class="row mb-5">
                <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <h6>Dari:</h6>
                    <div> <strong>APTIKOM PUSAT</strong> </div>
                    <div>Jakarta Selatan, Jl. TB Simatupang Kav. 38</div>
                    <div>Email: aptikompusat@yahoo.co.id</div>
                    <div>kontak: +62 821-1847-6100</div>
                </div>
                <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <h6>Untuk:</h6>
                    <div> <strong>{{ Auth()->User()->name }}</strong> </div>
                    <div>Status : 
                            @switch(auth()->user()->id_status_peserta)
                            @case(0)
                                Admin
                                @break
                            @case(1)
                                Umum
                                @break
                            @case(2)
                                Anggota Aktif
                                @break
                            @case(3)
                                Anggota Tidak Aktif
                                @break
                            @case(4)
                                pengurus
                                @break
                            @default
                            @endswitch
                            

                    </div>
                    <div>Institusi :{{ auth()->user()->Ms_institusi->nama_pt }} </div>
                    <div>Email: {{ auth()->user()->email }}</div>
                    <div>Phone: {{ auth()->user()->no_telp }}</div>
                </div>
                <div class=" col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                    <div class="row align-items-center">
                        <div class="col-sm-9 text-center"> 
                            <div class="brand-logo mb-3">
                                <img class="logo-abbr mr-2" width="110" src="{{ asset("assets/peserta/images") }}/logoAptikom.png" alt="">
                               
                            </div>
                            <span><strong>APTIKOM PUSAT</strong></span>
                            <br>
                            <small class="text-center">Gedung Graha Simatupang Menara I A
                                 Lantai 5 Kampus Universitas Gunadarma <br> Jl. TB Simatupang Kav. 38, Jakarta Selatan</small>
                        </div>
                        <div class="col-sm-3 mt-3"> <img src="images/qr.png" alt="" class="img-fluid width110"> </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Acara</th>
                            <th>Waktu</th>
                            <th>Deskripsi</th>
                            <th class="right">harga</th>
                            <th class="center">Jumlah</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="left strong">{{ $model['data']->AcaraModel->judul_acara }}</td>
                            <td class="left strong">
                                {{ \Carbon\Carbon::parse($model['data']->AcaraModel->tanggal)->format('d F Y')}},  {{ date("H:i",strtotime($model['data']->AcaraModel->jam)) }} WIB
                            </td>
                            <td class="left">
                                
                                Mengikuti Acara Dengan Via
                                @switch($model['data']->via)
                                        @case(1)
                                            Zoom
                                            @break
                                        @case(2)
                                            youtube
                                            @break
                                        @case(3)
                                            Zoom
                                            @break
                                        @case(4)
                                            youtube
                                            @break
                                        @default
                                            
                                    @endswitch

                            </td>
                            <td class="right">
                                Rp.
                                @if ($model['data']->via == 1)
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $model['data']->AcaraModel->harga_zoom_umum }}         
                                        @else

                                            {{ $model['data']->AcaraModel->harga_zoom_aptikom }} 
                                        @endif 
                                    @else                                    
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $model['data']->AcaraModel->harga_youtube_umum }}
       
                                        @else
                                            {{ $model['data']->AcaraModel->harga_youtube_aptikom }} 
                                        @endif    
                                    @endif
                            </td>
                            <td class="center">1</td>
                            <td class="right">Rp.
                                @if ($model['data']->via == 1)
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $model['data']->AcaraModel->harga_zoom_umum }}         
                                        @else

                                            {{ $model['data']->AcaraModel->harga_zoom_aptikom }} 
                                        @endif 
                                    @else                                    
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $model['data']->AcaraModel->harga_youtube_umum }}
       
                                        @else
                                            {{ $model['data']->AcaraModel->harga_youtube_aptikom }} 
                                        @endif    
                                    @endif
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                           
                            <tr>
                                <td class="left"><strong>Total</strong></td>
                                <td class="right"><strong>Rp.
                                    @if ($model['data']->via == 1)
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $model['data']->AcaraModel->harga_zoom_umum }}         
                                        @else

                                            {{ $model['data']->AcaraModel->harga_zoom_aptikom }} 
                                        @endif 
                                    @else                                    
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $model['data']->AcaraModel->harga_youtube_umum }}
       
                                        @else
                                            {{ $model['data']->AcaraModel->harga_youtube_aptikom }} 
                                        @endif    
                                    @endif    
                                </strong><br>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img style="width:300px !important" src="{{ asset("assets/img/TTD.png") }}" alt="">
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>

<script>
    //  window.onload = function() { 
    //     const element = document.getElementById("invoice");
    //     // Choose the element and save the PDF for our user.
    //     html2pdf()
    //         .set({ html2canvas: { width: 1160,height: 630 },jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }})
    //         .from(element)
    //         .save();
    // }

    function print() {
        const element = document.getElementById("invoice");
        // Choose the element and save the PDF for our user.
        html2pdf()
            .set({ html2canvas: { width: 1160,height: 630 },jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }})
            .from(element)
            .save();
        };

</script>

@endsection