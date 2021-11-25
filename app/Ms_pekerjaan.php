<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_pekerjaan extends Model
{
    //

    protected $table ="ms_pekerjaan";

    public function User(){
        return $this->hasMany('App\User',"id");
    }
}
