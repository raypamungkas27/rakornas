<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendaftaranModel extends Model
{
    //

    use SoftDeletes;

    protected $table = "pendaftaran";

    public function User(){
        return $this->BelongsTo('App\User',"id_user");
    }

    public function AcaraModel(){
        return $this->BelongsTo('App\AcaraModel',"id_acara");
    }

    public function Ms_backup_pendaftaran()
    {
    	return $this->hasOne('App\Ms_backup_pendaftaran',"id_pendaftaran");
    }

}
