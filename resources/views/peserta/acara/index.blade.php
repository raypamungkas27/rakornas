@extends('peserta.master')
@section('title',"Acara")

@section('subTitle',"Acara")

@section('content')

<div class="row">
    @foreach ($data as $item)


        <div class="col-lg-3">
            <div class="card mb-3">
                <img class="card-img-top img-fluid" src="{{ asset("assets/img/webinar")."/".$item->img }}">
                <div class="card-header">
                    <h5 class="card-title">{{ $item->judul_acara }}</h5>

                    <small>
                        Status : 
                            @if ($item->id_status  == 1) 
                                <span class="text-primary" >Aktif</span>
                            @else
                                <span class="text-danger" >Tidak Aktif</span>
                            @endif                       
                    </small>
                    
                </div>
                
                <div class="card-body">

                    <ul>
                        <li class="mb-2">
                            Tema : <strong>{{ $item->tema }}</strong>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-calendar mr-1" ></i>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y')}}
                        </li>
                        <li>
                            <i class="flaticon-381-clock"></i> {{ date("H:i",strtotime($item->jam)) }} WIB - {{ date("H:i",strtotime($item->jam_akhir)) }} WIB
                        </li>
                    </ul>

                    <a style="width: 100% !important;" class="btn btn-info mt-4"  href="/peserta/app/acara/daftar/{{ $item->id }}">Daftar</a>
                </div>
            </div>
        </div>


    @endforeach
</div>

    
@endsection