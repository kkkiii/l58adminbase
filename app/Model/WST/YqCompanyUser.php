<?php

namespace App\Model\WST;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class YqCompanyUser extends Authenticatable
{
    use Notifiable;
    protected $connection = 'mysql_wst';
    protected $table = 'yq_company_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'cellphone','password',
//    ];

//    protected $table="yq_users" ;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
    public function company()
    {
        return $this->hasOne('App\Model\WST\YqCompany','id' , 'company_id');
    }


}
