@extends('peserta.master')
@section('title',"Profile")

@section('subTitle',"Profile")

@section('css')
<link rel="stylesheet" href="{{ asset("assets/peserta") }}/vendor/select2/css/select2.min.css">
<link href="{{ asset("assets/peserta") }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="/peserta/profile/edit" id="profile" method="POST" >
            @csrf
            <div class="form-group">
                <label  class="mb-1"><strong>Status :</strong>
                    @switch(auth()->user()->id_status_peserta)
                    @case(0)
                        <span class="text-info" >Admin</span>  
                        @break
                    @case(1)
                        <span class="text-info" >Umum</span> 
                        @break
                    @case(2)
                        <span class="text-info" >Anggota Aktif</span> 
                        @break
                    @case(3)
                        <span class="text-info" >Anggota Tidak Aktif</span> 
                        @break
                    @case(4)
                        <span class="text-info" >pengurus</span> 
                        @break
                    @default
                        
                @endswitch
                </label>

            </div>
            <div class="form-group">
                <label for="email" class="mb-1"><strong>Email</strong></label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" name="email" id="email" required placeholder="Masukan Email Anda">
            </div>
            <div class="form-group">
                <label for="name" class="mb-1"><strong>Nama Lengkap (Gelar) </strong></label>
                <input type="text" class="form-control" readonly disabled value="{{ auth()->user()->name }}" name="name" id="name" required placeholder="Masukan Nama Lengkap Dengan Gelar Anda">
            </div>

            @if ( auth()->user()->id_status_peserta != "1")
            <div class="form-group">
                <label for="name" class="mb-1"><strong>Nomer Aptikom</strong></label>
                <input type="text" class="form-control" readonly disabled value="{{ auth()->user()->no_aptikom }}" name="name" id="name" required placeholder="Masukan Nomer Aptikom">
            </div>
            @endif


            <div class="form-group">
                <label for="id_pekerjaan" class="placeholder"><b>Pekerjaan</b></label>
                <select name="id_pekerjaan" style="width: 100%" required class="form-control">
                <option value="">Pilih Pekerjaan</option>
                @foreach ($model['pekerjaan'] as $item)
                    <option {{ (auth()->user()->Ms_pekerjaan->id ==  $item->id)? "selected" : "" }}   value="{{ $item->id }}">{{ $item->nama_pekerjaan }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="no_telp" class="mb-1"><strong>Nomer Handphone (WA)</strong></label>
                <input type="text" class="form-control" name="no_telp" value="{{ auth()->user()->no_telp }}" id="no_telp" required placeholder="Masukan Nomer Handphone Anda">
            </div>
            <div class="form-group">
                <label for="provinsi" class="mb-1"><strong>provinsi</strong></label>
                <select class="provinsi" required  name="provinsi" id="provinsi" style="width: 100%" class="form-control">
                    <option selected value="{{ auth()->user()->Ms_wilayah->id }}">{{ auth()->user()->Ms_wilayah->nama_provinsi }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="institusi" class="mb-1"><strong>Institusi / Perguruan Tinggi</strong></label>
                <select class="institusi" required  name="institusi" id="institusi" style="width: 100%" class="form-control">
                    <option selected value="{{ auth()->user()->Ms_institusi->id }}">{{ auth()->user()->Ms_institusi->nama_pt }}</option>
                </select>
            </div>
            
        
            <div class="text-center">
                <button type="submit" class="btn btn-info btn-block">Simpan</button>
            </div>
        </form>

    </div>
</div>

@endsection

@section('js')
<script src="{{ asset("assets/peserta") }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset("assets/peserta") }}/vendor/select2/js/select2.full.min.js"></script>
<script src="{{ asset("assets/peserta") }}/js/plugins-init/select2-init.js"></script>

<script src="{{ asset("assets/peserta") }}/js/validation.js"></script>
<script src="{{ asset("assets/peserta") }}/js/profile.js"></script>

@endsection