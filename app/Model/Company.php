<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Dict\RegEntType ;
class Company extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cname', 'unicode', 'rtype', 'province' , 'city','district' ,'reg_addr' ,'legal_person'
    ];

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
    public function reg_ent_type()
    {
        return $this->hasOne('App\Model\Dict\RegEntType','cd' , 'rtype');
    }
    public function company_verify()
    {
        return $this->hasOne('App\Model\Dict\CompanyVerify','cd' , 'verify');
    }
    public function login_acct()
    {
        return $this->hasOne('App\Model\Customer','id' , 'customner_id');
    }

}
