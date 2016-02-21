<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class bookingPackageModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblbookingpackage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['id',
                            'booking_id','package_id'
                            ];

    //displays the relationships in json format
    protected $with = array('category', 'landlord', 'rooms');


    public function booking()
    {
        return $this->belongsTo('App\bookingModel' , 'bookingid');
    }

    public function package()
    {
        return $this->belongsTo('App\packageModel' , 'packageid');
    }

   
  
}

