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

class travelModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbltravel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $primarykey = 'id';

     protected $fillable = ['id',
                            'pickUpTime1',
                            'pickUpTime2',
                            'pickUpLocation1',
                            'pickUpLocation2',
                            'pickUpDestination1',
                            'pickUpDestination2',
                            'dispach','vehicleID',
                                            ];

    //displays the relationships in json format
    protected $with = array('vehicle');


    public function booking()
    {
        return $this->belongsTo('App\bookingModel' , 'bookingID');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\vehicleModel' , 'vehicleID');
    }

    
}

