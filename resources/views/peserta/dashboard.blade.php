@extends('peserta.master')
@section('title',"Dashboard")

@section('subTitle',"Dashboard")

@section('content')
{{--     
<div class="row">

    <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-success">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-news"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Jumlah Acara</p>
                        <h3 class="text-white">$56K</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-primary">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-notepad"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Acara yang diikuti</p>
                        <h3 class="text-white">783K</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-info">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-success-2"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Pembayaran Berhasil</p>
                        <h3 class="text-white">$76</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-4">
        <div class="widget-stat card bg-danger">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-warning-1"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">Pembayaran Gagal</p>
                        <h3 class="text-white">76</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div> --}}

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($data['acara'] as $key => $value)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ ($key == 0) ? "active" : "" }}">
                        </li>
                        
                        @endforeach
                       
                    </ol>
                    <div class="carousel-inner">

                        @foreach ($data['acara'] as $key => $value)
                        <div class="carousel-item {{($key == 0) ? "active" : ""   }}">
                            <img class="d-block w-100" src="{{ asset("assets/img/webinar")."/".$value->img }}" alt="First slide">
                        </div>
                            
                        @endforeach

                    </div><a class="carousel-control-prev" href="#carouselExampleIndicators" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span
                            class="sr-only">Previous</span> </a><a class="carousel-control-next" href="#carouselExampleIndicators" data-slide="next"><span
                            class="carousel-control-next-icon"></span>
                        <span class="sr-only">Next</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Timeline Rakornas Aptikom 2021</h4>
            </div>
            <div class="card-body">
                <div id="DZ_W_TimeLine" class="widget-timeline dz-scroll height370">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge primary"></div>
                            <a class="timeline-panel text-muted" href="#">
                                <span>01 November 2021</span>
                                <h6 class="mb-0">Opening Rakornas</h6>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
