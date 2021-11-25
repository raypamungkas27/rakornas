<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_institusi extends Model
{
    //
    protected $table = 'ms_pt';

    protected $fillable = [
        'kode_pt', 'nama_pt'
    ];

    public function User(){
        return $this->hasMany('App\User',"id");
    }
}
