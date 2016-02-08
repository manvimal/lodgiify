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

class bookingModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblbooking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['id',
                            'tenantID', 'travelID', 'checkin', 'checkOut','packageId'];

    //displays the relationships in json format
    protected $with = array('tenant'/*,'travel'*/ , 'package');


   
    public function tenant()
    {
        return $this->belongsTo('App\tenantModel' , 'tenantID');
    }

    public function package()
    {
        return $this->belongsTo('App\packageModel' , 'packageId');
    }

   /* public function travel()
    {
        return $this->belongsTo('App\travelModel' , 'travelID');
    }*/
   
}

