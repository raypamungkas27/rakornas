<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcaraRequest extends FormRequest
{

    public function rules()
    {
        return [
            'judul_acara' => 'required',
            'tema' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'jam_akhir' => 'required',
            'kuota' => 'required',
            'harga_zoom_umum' => 'required',
            'harga_zoom_aptikom' => 'required',
            'harga_youtube_umum' => 'required',
            'harga_youtube_aptikom' => 'required',
            'id_status' => 'required',

        ];
    }
}
