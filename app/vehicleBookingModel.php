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

class vehicleBookingModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblvehiclebooking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primarykey = 'id';

     protected $fillable = ['id',
                            'vehicleid',
                            'tenantid',
                            'fromdate',
                            'todate',
                            'price'                          
                                            ];

    //displays the relationships in json format
    protected $with = array('vehicle', 'tenant');


    public function vehicle()
    {
        return $this->belongsTo('App\vehicleModel' , 'vehicleid');
    }

    public function tenant()
    {
        return $this->belongsTo('App\User' , 'tenantid');
    }

    
}

