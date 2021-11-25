<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',"HomeCT@index");

Auth::routes([
    "login" => false,
    "register" => false
]);

Route::get('login',"AuthCT@login")->name("login");
Route::get('logout',"AuthCT@logout");
Route::post('login-post',"AuthCT@login_post");


Route::get('select2/daftarProvinsi',"Select2CT@daftarProvinsi");
Route::get('select2/daftarInstitusi',"Select2CT@daftarInstitusi");


Route::get('register/umum',"AuthCT@RegisterUmum");
Route::get('register/anggota',"AuthCT@RegisterAnggota");
Route::get('register/pengurus',"AuthCT@RegisterPengurus");

Route::post('register/umum/post',"AuthCT@RegisterUmumPost");
Route::post('register/anggota/post',"AuthCT@RegisterAnggotaPost");
Route::post('register/pengurus/post',"AuthCT@RegisterPenngurusPost");



Route::group(['middleware' => 'is_admin','middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('dashboard',"AdminCT@dashboard");

    Route::group(['prefix' => 'master'], function () {
        Route::resource('acara',"AcaraCT");
        Route::get('acara/status/{id}',"AcaraCT@status");
        Route::get('acara/status_presensi/{id}',"AcaraCT@status_presensi");
        Route::get('acara/pendaftar/{id}',"AdminCT@pendaftar");
        Route::get('acara/sertifikat/{id}',"SertifikatCT@index");
        Route::post('acara/sertifikat/add/{id}',"SertifikatCT@add");
        Route::post('acara/sertifikat/edit/{id}',"SertifikatCT@edit");
        Route::get('acara/sertifikat/show/{id}',"SertifikatCT@show");
        Route::get('acara/sertifikat/generate/{id}',"SertifikatCT@generate");

        Route::get('acara/kuesioner/{id}',"KuesionerCT@index");
        Route::post('acara/kuesioner/add/pg/{id}',"KuesionerCT@addPg");
        Route::post('acara/kuesioner/add/cb/{id}',"KuesionerCT@addCb");
        Route::post('acara/kuesioner/add/essai/{id}',"KuesionerCT@addEssai");
        

        Route::get('user',"UserCT@index");
        Route::get('user/reset/{id}',"UserCT@reset");
        Route::get('validasi',"AdminCT@validasi");
        Route::get('validasi/dataGagal',"AdminCT@dataGagal");
        Route::get('validasi/sukses/{id}',"PendaftaranCT@sukses");
        Route::get('validasi/gagal/{id}',"PendaftaranCT@gagal");
        // Route::resource('artikel',"ArtikelCT");
        // route::post("uploadImgArtikel","ArtikelCT@upload")->name("upload");
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'peserta'], function () {
    Route::get('dashboard',"PesertaCT@dashboard");
    Route::get('app',"PesertaCT@app");
    Route::get('app/acara',"PesertaCT@acara");
    Route::get('app/acara/daftar/{id}',"PesertaCT@daftarAcara");

    Route::post('app/daftar/zoom/sertifikat/{id}',"PendaftaranCT@zoomSertifikat");
    Route::get('app/daftar/zoom/gratis/{id}',"PendaftaranCT@zoomGratis");

    Route::post('app/daftar/youtube/sertifikat/{id}',"PendaftaranCT@youtubeSertifikat");
    Route::get('app/daftar/youtube/gratis/{id}',"PendaftaranCT@youtubeGratis");

    Route::get('app/acaradiikuti',"PesertaCT@acaradiikuti");

    Route::get('app/presensi',"PesertaCT@presensi");
    Route::get('app/presensi/{id}',"PesertaCT@actionPresensi");

    Route::get('app/file',"PesertaCT@file");
    Route::get('app/file/sertifikat/{id}',"PesertaCT@fileSertifikat");
    Route::get('app/file/generateSertifikat/{id}',"PesertaCT@generateSertifikat");

    Route::get('app/kuesioner',"PesertaCT@kuesioner");
    Route::get('app/kuesioner/show/{id}',"PesertaCT@kuesionerShow");
    Route::post('app/kuesioner/add/{id}',"PesertaCT@kuesionerAdd");

    Route::get('profile',"PesertaCT@profile");
    Route::post('profile/edit',"UserCT@edit");
    
    Route::get('app/buktiPembayaran/{id}',"PendaftaranCT@buktiPembayaran");


    // Route::group(['prefix' => 'blog'], function () {
    //     Route::resource('kategori',"KategoriCT");
    //     Route::resource('artikel',"ArtikelCT");
    //     route::post("uploadImgArtikel","ArtikelCT@upload")->name("upload");
    // });
});




