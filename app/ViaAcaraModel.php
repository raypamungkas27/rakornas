<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViaAcaraModel extends Model
{
    //

    protected $table = "via_acara";

    public function AcaraModel()
    {
    	return $this->belongsTo('App\AcaraModel','id_acara');
    }
}
