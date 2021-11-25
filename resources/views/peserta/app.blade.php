@extends('peserta.master')
@section('title',"Apps")

@section('subTitle',"Apps")

@section('content')

<div class="row">
    <div class="col-lg-2">
        <a href="/peserta/app/acara">
            <div class="card">
                <div class="card-body text-center ai-icon  text-info">
                    <i class="fas fa-ticket-alt fa-7x"></i>
                    <h4 class="my-2">Daftar Acara</h4>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2">
        <a href="/peserta/app/acaradiikuti">
            <div class="card">
                <div class="card-body text-center ai-icon  text-info">
                    <i class="fas fa-calendar-check fa-7x"></i>
                    <h4 class="my-2">Acara Yang Diikuti </h4>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2">
        <a href="/peserta/app/presensi">
            <div class="card">
                <div class="card-body text-center ai-icon  text-info">
                    <i class="fas fa-pen-square fa-7x"></i>
                    <h4 class="my-2">Presensi</h4>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2">
        <a href="/peserta/app/kuesioner">
            <div class="card">
                <div class="card-body text-center ai-icon  text-info">
                    <i class="fas fa-tasks fa-7x"></i>
                    <h4 class="my-2">kuesioner</h4>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2">
        <a href="/peserta/app/file">
            <div class="card">
                <div class="card-body text-center ai-icon  text-info">
                    <i class="fas fa-folder fa-7x"></i>
                    <h4 class="my-2">Materi / Sertifikat</h4>
                </div>
            </div>
        </a>
    </div>


</div>
    
@endsection