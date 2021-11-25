<?php
   
namespace App;
   
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
   
class User extends Authenticatable
{
    use Notifiable;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function PendaftaranModel(){
        return $this->hasMany('App\PendaftaranModel',"id_user");
    }
    public function Ms_wilayah(){
        return $this->BelongsTo('App\Ms_wilayah',"id_wilayah");
    }

    public function Ms_pekerjaan(){
        return $this->BelongsTo('App\Ms_pekerjaan',"id_pekerjaan");
    }

    public function Ms_institusi(){
        return $this->BelongsTo('App\Ms_institusi',"id_pt");
    }


}