<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_wilayah extends Model
{
    //
    protected $table = 'ms_wilayah';

    public function User(){
        return $this->hasMany('App\User',"id");
    }
}
