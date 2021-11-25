<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_narasumber extends Model
{
    //

    protected $table = "ms_narasumber";

    public function AcaraModel(){
        return $this->BelongsTo('App\AcaraModel',"id_acara");
    }
}
