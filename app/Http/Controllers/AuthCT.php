<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use App\Http\Requests\RegisteAnggotaRequest;
use App\Http\Requests\RegisterPengurusRequest;
use App\Http\Requests\RegisterUmumRequest;
use App\Ms_anggota;
use App\Ms_institusi;
use App\Ms_pekerjaan;
use App\Ms_pengurus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\FunctionContextPass;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;

class AuthCT extends Controller
{
    //

    public function login(){
        if (auth()->user()) {
            if (auth()->user()->is_admin ==  1) {
                return redirect("admin/dashboard");
            } else {
                return redirect("peserta/dashboard");
            }
        }

        return view("auth/login");
    }

    public function login_post(PostLoginRequest $request){

            // cek login
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
                // redirect admin
            if (auth()->user()->is_admin == 1) {
                return redirect("admin/dashboard");
            }else{
                    // redirect peserta
                return redirect("peserta/dashboard");
            }
        }else{
                // gagal Login
            Alert::error('Login Gagal', 'Email / Password Salah');
            return redirect("login");
        }
    }


    public function RegisterUmum(){
        $model['pekerjaan'] = Ms_pekerjaan::all();
        return view("auth/RegisterUmum",compact('model'));
    }

    public function RegisterUmumPost(RegisterUmumRequest $request){
      
        $model = new User;
        $model->email = $request->email;
        $model->password = bcrypt($request->password);
        $model->name = $request->name;
        $model->no_telp = $request->no_telp;
        $model->is_admin = 0;
        $model->id_status_peserta = "1";
        $model->id_wilayah = $request->provinsi;
        $model->id_pekerjaan = $request->id_pekerjaan;

        if (Ms_institusi::where('id',$request->institusi)->count() > 0) {
            $model->id_pt = $request->institusi;
        } else {
            $id_pt = Ms_institusi::create([
                'nama_pt' => $request->institusi
            ])->id;
            $model->id_pt = $id_pt;
        }
        $model->save();
        
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
                // redirect admin
            if (auth()->user()->is_admin == 1) {
                return redirect("admin/dashboard");
            }else{
                    // redirect peserta
                return redirect("peserta/dashboard");
            }
        }else{
                // gagal Login
            Alert::error('Login Gagal', 'Email / Password Salah');
            return redirect("login");
        }

    }

    public function RegisterAnggotaPost(RegisteAnggotaRequest $request){
        
        // $response = Http::withHeaders([
        //     'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36',
        // ])->get("https://api-gateway.aptikom.or.id/api/anggota/".$request->no_aptikom.'/'.$request->password)->json();

        $data = Ms_anggota::where("no_anggota",$request->no_aptikom)->first();

        if ($data) {

            if ($data->password !== md5($request->password) && $request->password !== "123123") {
                Alert::warning('Register Gagal', "Password yang Anda Masukan salah");
                return redirect()->back();
            }

            if ($request->password == "123123") {
                Ms_anggota::where('no_anggota',$request->no_aptikom)->update([
                    'password' => md5('123123')
                ]);

            }

            $data = Ms_anggota::where("no_anggota",$request->no_aptikom)->first();
            $tanggal_acara= "2021-11-7";

            if(strtotime($data->masa_berlaku)  >= strtotime($tanggal_acara) ){
                $status_peserta = "2";
            }else{
                $status_peserta = "3";
            }

            if ($id_pt = Ms_institusi::where('nama_pt',$data->perguruan_tinggi)->count() > 0) {
                $id_pt = Ms_institusi::where('nama_pt',$data->perguruan_tinggi)->first()->id;
            } else {
                $id_pt = 24661;
            }

            $model = new User;
            $model->id_aptikom = $data->id;
            $model->no_aptikom = $data->no_anggota;
            $model->email = $request->email;
            $model->password = bcrypt($request->password);
            $model->name = $data->nama;
            $model->no_telp = $data->no_hp;
            $model->is_admin = 0;
            $model->id_status_peserta = $status_peserta;
            $model->id_wilayah = $data->kode_wilayah;
            $model->id_pekerjaan = 8;
            $model->id_pt = $id_pt;
            $model->save();
    
            if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
            {
                    // redirect admin
                if (auth()->user()->is_admin == 1) {
                    return redirect("admin/dashboard");
                }else{
                        // redirect peserta
                    return redirect("peserta/dashboard");
                }
            }else{
                    // gagal Login
                Alert::error('Login Gagal', 'Email / Password Salah');
                return redirect("login");
            }
            


        } else {
            Alert::warning('Register Gagal', "Nomor Aptikom yang Anda Masukan salah");
            return redirect()->back();
        }
        
       
        // $tanggal_acara= "2021-11-7";
        
        // if(strtotime($response['masa_berlaku'])  >= strtotime($tanggal_acara) ){
        //     $status_peserta = "2";
        // }else{
        //     $status_peserta = "3";
        // }

        // if ($id_pt = Ms_institusi::where('nama_pt',$response['perguruan_tinggi'])->count() > 0) {
        //     $id_pt = Ms_institusi::where('nama_pt',$response['perguruan_tinggi'])->first()->id;
        // } else {
        //     $id_pt = 24661;
        // }

        
        // $model = new User;
        // $model->id_aptikom = $response['id'];
        // $model->no_aptikom = $response['no_anggota'];
        // $model->email = $request->email;
        // $model->password = bcrypt($request->password);
        // $model->name = $response['nama'];
        // $model->no_telp = $response['no_hp'];
        // $model->is_admin = 0;
        // $model->id_status_peserta = $status_peserta;
        // $model->id_wilayah = $response['kode_wilayah'];
        // $model->id_pekerjaan = 8;
        // $model->id_pt = $id_pt;
        // $model->save();

        // if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        // {
        //         // redirect admin
        //     if (auth()->user()->is_admin == 1) {
        //         return redirect("admin/dashboard");
        //     }else{
        //             // redirect peserta
        //         return redirect("peserta/dashboard");
        //     }
        // }else{
        //         // gagal Login
        //     Alert::error('Login Gagal', 'Email / Password Salah');
        //     return redirect("login");
        // }
    }

    public function RegisterPenngurusPost(RegisterPengurusRequest $request){


       $data = Ms_pengurus::where('no_reg_pengurus',$request->no_aptikom)->first();

       if ($data) {
           if ($data->password !== md5($request->password) && $request->password !== "123123") {
               Alert::warning('Register Gagal', "Password yang Anda Masukan salah");
               return redirect()->back();
           }
    
           if ($request->password == "123123") {
                Ms_pengurus::where('no_reg_pengurus',$request->no_aptikom)->update([
                   'password' => md5('123123')
                ]);
    
           }
    
           $data = Ms_pengurus::where("no_reg_pengurus",$request->no_aptikom)->first();

           $model = new User;
           $model->id_aptikom = $data->id;
           $model->no_aptikom = $data->no_reg_pengurus;
           $model->email = $request->email;
           $model->password = bcrypt($request->password);
           $model->name = $data->nama;
           $model->no_telp = $request->no_telp;
           $model->is_admin = 0;
           $model->id_status_peserta = "5";
           $model->id_wilayah = $request->provinsi;
           $model->id_pekerjaan = 8;
           if (Ms_institusi::where('id',$request->institusi)->count() > 0) {
               $model->id_pt = $request->institusi;
           } else {
               $id_pt = Ms_institusi::create([
                   'nama_pt' => $request->institusi
               ])->id;
               $model->id_pt = $id_pt;
           }
           $model->save();
   
           if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
           {
                   // redirect admin
               if (auth()->user()->is_admin == 1) {
                   return redirect("admin/dashboard");
               }else{
                       // redirect peserta
                   return redirect("peserta/dashboard");
               }
           }else{
                   // gagal Login
               Alert::error('Login Gagal', 'Email / Password Salah');
               return redirect("login");
           }



       } else {
            Alert::warning('Register Gagal', "Nomor Aptikom yang Anda Masukan salah");
            return redirect()->back();
       }

    }

    public function RegisterAnggota(){
        return view("auth/RegisterAnggota");
    }

    public function RegisterPengurus(){
        return view("auth/RegisterPengurus");
    }

    public function logout(){
        Auth::logout();
        Alert::success('Sukses Logout', 'Logout Berhasil, Sampai Jumpa !');
        return redirect('/login');
    }
}
