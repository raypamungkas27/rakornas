<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPengurusRequest extends FormRequest
{
   
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'no_aptikom' => 'required|unique:users,no_aptikom',
            'no_telp' => 'required',
            'provinsi' => 'required',
            'institusi' => 'required',
            'password' => 'required',        
        ];  
    }
    public function messages()
    {
        return [
            'email.unique' => 'Email sudah dipakai',
            'no_aptikom.unique' => 'Nomer Aptikom sudah dipakai',
        ];
    }
}
