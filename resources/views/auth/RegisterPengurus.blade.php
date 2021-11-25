@extends('auth.master')

@section('title',"Daftar Umum")

@section('css')
	<link rel="stylesheet" href="{{ asset("assets/peserta") }}/vendor/select2/css/select2.min.css">
	<link href="{{ asset("assets/peserta") }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
@endsection

@section('content')
<h4 class="text-center mb-4">Daftar Pengurus Rakornas Aptikom 2021 <br> <small  class="text-warning" >Jika lupa password APK MyAptikom, silahkan masukan password default 123123</small></h4>
<form id="registerPengurus" action="/register/pengurus/post" method="POST">
	@csrf
	<div class="form-group">
		<label for="email" class="mb-1"><strong>Email</strong></label>
		<input type="email" class="form-control" name="email" required id="email" placeholder="Masukan Email Anda">
	</div>
    <div class="form-group">
		<label for="no_aptikom" class="mb-1"><strong>Nomer Aptikom</strong></label>
		<input type="text" class="form-control" name="no_aptikom" required id="no_aptikom" placeholder="Masukan Nomer Aptikom Anda">
	</div>
    <div class="form-group">
		<label for="no_telp" class="mb-1"><strong>Nomer Handphone (WA)</strong></label>
		<input type="text" class="form-control" name="no_telp" required id="no_telp" placeholder="Masukan Nomer Handphone Anda">
	</div>
    <div class="form-group">
		<label for="provinsi" class="mb-1"><strong>provinsi</strong></label>
		<select class="provinsi"  name="provinsi" id="provinsi" style="width: 100%" class="form-control">
		</select>
	</div>
    <div class="form-group">
		<label for="institusi" class="mb-1"><strong>Institusi / Perguruan Tinggi</strong></label>
		<select class="institusi"  name="institusi" id="institusi" style="width: 100%" class="form-control">
		</select>
	</div>
	<div class="form-group">
		<label for="password" class="mb-1"><strong>Password APK MyAptikom</strong></label>
		<input type="password" class="form-control" name="password" required id="password" placeholder="Masukan Password APK MyAptikom Anda">
	</div>


	<div class="text-center">
		<button type="submit" class="btn btn-info btn-block">Register</button>
	</div>
</form>
<div class="new-account mt-3 text-center">
	<p>Belum punya akun ? </p>
	<a href="/register/umum" class="text-info">Daftar Umum</a> | <a href="/register/anggota" class="text-info">Daftar via anggota Aptikom</a> | <a href="/register/pengurus" class="text-info">Daftar via pengurus Aptikom</a>
</div>

<div class="new-account mt-3 text-center">
	<p>Sudah punya akun ? </p>
	<a href="/login" class="text-info" >Login</a>
</div>
@endsection

@section('js')
<script src="{{ asset("assets/peserta") }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset("assets/peserta") }}/vendor/select2/js/select2.full.min.js"></script>
<script src="{{ asset("assets/peserta") }}/js/plugins-init/select2-init.js"></script>

<script src="{{ asset("assets/peserta") }}/js/validation.js"></script>
<script src="{{ asset("assets/peserta") }}/js/auth.js"></script>
@endsection