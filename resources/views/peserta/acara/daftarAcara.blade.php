@extends('peserta.master')
@section('title',"Daftar Acara ".  $data->judul_acara)

@section('subTitle',"Daftar Acara ".  $data->judul_acara)

@section('css')
    <link href="{{ asset("assets/peserta") }}/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        #upload-error{
            color: red !important
        }
    </style>

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-intro-title">Daftar Acara</h4>
                <div class="alert alert-info solid alert-square "><strong>Biaya Acara Bisa Ditrasnfer ke :</strong> 111 555 2014 (BNI) A/N APTIKOM</div>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @php
                    $pendaftaran = auth()->user()->PendaftaranModel->where("id_acara",$data->id)->first(); 
                @endphp

                @if ($pendaftaran)
                
                    @switch($pendaftaran->via)
                        @case(1)
                                <div class="alert alert-success">
                                    Anda sudah daftar acara ini via Zoom (sertifikat)
                                </div>
                            @break
                        @case(2)
                                <div class="alert alert-success">
                                    Anda sudah daftar acara ini via Youtube (sertifikat)
                                </div>
                            @break
                        @case(3)
                                <div class="alert alert-success">
                                    Anda sudah daftar acara ini via Zoom
                                </div>
                            @break
                        @case(4)
                                <div class="alert alert-success">
                                    Anda sudah daftar acara ini via Youtube
                                </div>
                            @break
                        @default
                            
                    @endswitch
                @endif

                
                <div class="row mt-3 justify-content-md-center">

                    @if ($data->ViaAcaraModel->via_zoom_sertifikat == 1)
                    <div class="col-lg-2">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="profile-photo">
                                        <img src="{{ asset("assets/peserta") }}/images/profile/zoom.png" width="100" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <h3 class="mt-4 mb-1">Zoom </h3>
                                    <p class="text-muted">Rp.
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $data->harga_zoom_umum }}         
                                        @else
                                            {{ $data->harga_zoom_aptikom }} 
                                        @endif
                                        (Sertifikat)
                                    </p>
                                    @if ($pendaftaran)
                                        @if ($pendaftaran->via != 1)  
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 100% !important" data-target="#daftarZoom">Daftar</button>
                                        @endif
                                    @else
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 100% !important" data-target="#daftarZoom">Daftar</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- daftarZoom -->
                    <div class="modal fade" id="daftarZoom" tabindex="-1" aria-labelledby="daftarZoomLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="daftarZoomLabel">Daftar Acara {{ $data->judul_acara }} via Zoom Besertifikat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-info solid alert-square "><strong>Biaya Acara Bisa Ditrasnfer ke :</strong> 111 555 2014 (BNI) A/N APTIKOM</div>
                                <h6>Biaya Daftar : <b>Rp. 
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $data->harga_zoom_umum }}         
                                        @else
                                            {{ $data->harga_zoom_aptikom }} 
                                        @endif    
                                </b> </h6>
                                <hr>
                                <form id="zoomSertifikat" action="/peserta/app/daftar/zoom/sertifikat/{{ $data->id }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                <div class="form-group mt-4">
                                    <label for="upload">Upload Bukti Pembayaran <span class="text-danger" >*</span></label>
                                    <input type="file" id="upload" name="upload" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif



                    @if ($data->ViaAcaraModel->via_zoom_gratis == 1)
                    <div class="col-lg-2">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="profile-photo">
                                        <img src="{{ asset("assets/peserta") }}/images/profile/zoom.png" width="100" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <h3 class="mt-4 mb-1">Zoom </h3>
                                    <p class="text-muted">Gratis Tanpa Sertifikat</p>

                                    @if ($pendaftaran)
                                        @if ($pendaftaran->via != 1)  
                                            <button onclick="zoomDaftar({{ $data->id }})" class="btn btn-info btn-sm " style="width: 100% !important;" >Daftar</button>
                                        @endif
                                    @else
                                            <button onclick="zoomDaftar({{ $data->id }})" class="btn btn-info btn-sm " style="width: 100% !important;" >Daftar</button>
                                    @endif

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($data->ViaAcaraModel->via_youtube_sertifikat == 1)
                    <div class="col-lg-2">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="profile-photo">
                                        <img src="{{ asset("assets/peserta") }}/images/profile/youtube.png" width="100" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <h3 class="mt-4 mb-1">Youtube </h3>
                                    <p class="text-muted">Rp. 
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $data->harga_youtube_umum }}         
                                        @else
                                            {{ $data->harga_youtube_aptikom }} 
                                        @endif
                                    (Sertifikat)
                                    </p>

                                    @if ($pendaftaran)
                                        @if ($pendaftaran->via != 1 )  
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 100% !important" data-target="#daftarYoutube">Daftar</button>
                                        @endif
                                    @else
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 100% !important" data-target="#daftarYoutube">Daftar</button>
                                    @endif

                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- daftarYoutube -->
                    <div class="modal fade" id="daftarYoutube" tabindex="-1" aria-labelledby="daftarYoutubeLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="daftarYoutubeLabel">Daftar Acara {{ $data->judul_acara }} via Youtube Besertifikat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-info solid alert-square "><strong>Biaya Acara Bisa Ditrasnfer ke :</strong> 111 555 2014 (BNI) A/N APTIKOM</div>
                                <h6>Biaya Daftar : <b>Rp. 
                                        @if (auth()->user()->id_status_peserta == 1 || auth()->user()->id_status_peserta == 3)
                                            {{ $data->harga_youtube_umum }}         
                                        @else
                                            {{ $data->harga_youtube_aptikom }} 
                                        @endif    
                                </b> </h6>
                                <hr>
                                <form id="youtubeSertifikat" action="/peserta/app/daftar/youtube/sertifikat/{{ $data->id }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                <div class="form-group mt-4">
                                    <label for="upload">Upload Bukti Pembayaran <span class="text-danger" >*</span> </label>
                                    <input type="file" id="upload" name="upload" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            @if ($pendaftaran)
                                @if ($pendaftaran->via == 2)
                                    <button disabled class="btn btn-primary">Anda Sudah Daftar Acara Ini</button>
                                @else
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                @endif
                            @else
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                            @endif
                            
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif


                    @if ($data->ViaAcaraModel->via_youtube_gratis == 1)
                    <div class="col-lg-2">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="profile-photo">
                                        <img src="{{ asset("assets/peserta") }}/images/profile/youtube.png" width="100" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <h3 class="mt-4 mb-1">Youtube </h3>
                                    <p class="text-muted">Gratis Tanpa Sertifikat</p>
                                    
                                    @if ($pendaftaran)
                                        @if ($pendaftaran->via != 1)  
                                             <button onclick="youtubeDaftar({{ $data->id }})" class="btn btn-info btn-sm " style="width: 100% !important;" >Daftar</button>
                                        @endif
                                    @else
                                             <button onclick="youtubeDaftar({{ $data->id }})" class="btn btn-info btn-sm " style="width: 100% !important;" >Daftar</button>
                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- <div class="col-lg-2">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="profile-photo">
                                        <img src="{{ asset("assets/peserta") }}/images/profile/profile.png" width="100" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <h3 class="mt-4 mb-1">Offline </h3>
                                    <p class="text-muted">Rp. 50.000 (Sertifikat)</p>
                                    <a href="" class="btn btn-info btn-sm " style="width: 100% !important;" >Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}    
                </div>


            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">


        <div class="card">
            <div class="card-body">
                <h4 class="card-intro-title">Detail Acara</h4>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="bootstrap-carousel">
                            <div class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset("assets/img/webinar")."/".$data->img }}" alt="First slide">
                                    </div>
                                    <!-- <div class="carousel-item">
                                        <img class="d-block w-100" src="./images/big/img4.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="./images/big/img5.jpg" alt="Third slide">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="basic-list-group mt-3">
                            <ul class="list-group">
                                <li class="list-group-item">Status : 
                                    @if ($data->id_status  == 1) 
                                        <span class="text-primary" >Aktif</span>
                                    @else
                                        <span class="text-danger" >Tidak Aktif</span>
                                    @endif  
                                </li>
                                <li class="list-group-item">Nama Acara : <b>{{ $data->judul_acara }}</b></li>
                                <li class="list-group-item">Tema : <b>{{ $data->tema }}</b></li>
                                <li class="list-group-item">Tanggal : <b>{{ \Carbon\Carbon::parse($data->tanggal)->format('d F Y')}}</b> </li>
                                <li class="list-group-item">Jam : <b> {{ date("H:i",strtotime($data->jam)) }} WIB - {{ date("H:i",strtotime($data->jam_akhir)) }} WIB</b> </li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-intro-title mt-4">Narasumber</h4>
                <div class="row">

                    @if ($data->Ms_narasumber)

                        @foreach ($data->Ms_narasumber as $item)
                            <div class="col-md-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="text-center">

                                            <h4 class="mt-4 mb-1">{{ $item->nama }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        @endforeach
                    
                    @endif

                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('js')
<script src="{{ asset("assets/peserta") }}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="{{ asset("assets/peserta") }}/js/plugins-init/sweetalert.init.js"></script>
    <script>
         function zoomDaftar(item_id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan daftar acara ini via Zoom tanpa sertifikat",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!',
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    window.location.href = ("/peserta/app/daftar/zoom/gratis/"+item_id);
                }else{
                    console.log("asda")
                }
            });
        };

        function youtubeDaftar(item_id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan daftar acara ini via Youtube tanpa sertifikat",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!',
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    window.location.href = ("/peserta/app/daftar/youtube/gratis/"+item_id);
                }else{
                    console.log("asda")
                }
            });
        };

        
    </script>

    <script src="{{ asset("assets/peserta") }}/js/validation.js"></script>
    <script src="{{ asset("assets/peserta") }}/js/acara.js"></script>
@endsection