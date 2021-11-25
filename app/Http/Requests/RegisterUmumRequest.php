<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUmumRequest extends FormRequest
{

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'id_pekerjaan' => 'required',
            'no_telp' => 'required',
            'provinsi' => 'required',
            'institusi' => 'required',
            'password' => 'required',
            'password2' => 'required',            
        ];
    }
}
