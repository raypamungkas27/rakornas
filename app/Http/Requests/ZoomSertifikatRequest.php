<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoomSertifikatRequest extends FormRequest
{

    public function rules()
    {
        return [
            'upload' => 'required|max:2500|mimes:jpg,jpeg,png,pdf' 
        ];
    }
}
