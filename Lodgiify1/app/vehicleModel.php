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

class vehicleModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblvehicle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primarykey = 'id';

     protected $fillable = ['id',
                            'vehicleName',
                            'vehicleCatID',
                            'vehicleOwnerID',
                            'models',
                            'color',
                            'numOfSeats',
                            'image',
                            'transmission'
                                            ];

    //displays the relationships in json format
    protected $with = array('category', 'vehicleOwner');


    public function category()
    {
        return $this->belongsTo('App\vehicleCategory' , 'vehicleCatID');
    }

    public function vehicleOwner()
    {
        return $this->belongsTo('App\vehicleOwnerModel' , 'vehicleOwnerID');
    }

    
}

