@extends('auth.master')

@section('title',"Login")

@section('content')
<h4 class="text-center mb-4">Login Rakornas Aptikom 2021</h4>
<form action="/login-post" id="login" method="POST"  >
	@csrf
	<div class="form-group">
		<label class="mb-1"><strong>Email</strong></label>
		<input type="email" class="form-control" name="email" required placeholder="Masukan Email Anda">
	</div>
	<div class="form-group">
		<label class="mb-1"><strong>Password</strong></label>
		<input type="password" class="form-control" name="password" required placeholder="Masukan Password Anda">
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-info btn-block">login</button>
	</div>
</form>
<div class="new-account mt-3 text-center">
	<p>Belum punya akun ? </p>
	<a href="/register/umum" class="text-info">Daftar Umum</a> | <a href="/register/anggota" class="text-info">Daftar via anggota Aptikom</a> | <a href="/register/pengurus" class="text-info">Daftar via pengurus Aptikom</a>
</div>
@endsection

@section('js')
		
		{{-- validasi --}}
	<script src="{{ asset("assets/peserta") }}/js/validation.js"></script>
	<script src="{{ asset("assets/peserta") }}/js/auth.js"></script>
	
@endsection