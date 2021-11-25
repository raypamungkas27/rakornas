<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcaraModel extends Model
{
    //

    protected $table = "ms_acara";

    public function ViaAcaraModel()
    {
    	return $this->hasOne('App\ViaAcaraModel','id_acara');
    }

    public function PendaftaranModel(){
        return $this->hasMany('App\PendaftaranModel',"id_acara");
    }
    public function Ms_narasumber(){
        return $this->hasMany('App\Ms_narasumber',"id_acara");
    }
}
