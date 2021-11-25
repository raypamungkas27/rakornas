@extends('auth.master')

@section('title',"Daftar Umum")


@section('content')
<h4 class="text-center mb-4">Daftar Anggota Rakornas Aptikom 2021 <br> <small  class="text-warning" >Jika lupa password APK MyAptikom, silahkan masukan password default 123123</small></h4>

<form id="Registeranggota"  action="/register/anggota/post" method="POST">
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
			{{-- validasi --}}
	<script src="{{ asset("assets/peserta") }}/js/validation.js"></script>
	<script src="{{ asset("assets/peserta") }}/js/auth.js"></script>
	
@endsection