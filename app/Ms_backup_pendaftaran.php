<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ms_backup_pendaftaran extends Model
{
    //

    protected $table = "ms_backup_pendaftaran";

    public function PendaftaranModel()
    {
    	return $this->belongsTo('App\PendaftaranModel',"id_pendaftaran");
    }
}
