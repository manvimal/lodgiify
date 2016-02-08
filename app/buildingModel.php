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

class buildingModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblBuilding';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['id',
                            'buildingLocation','buildingCatId','landlordID','desc','image','buildingName' ,'lattitude','longitude'
                            ];

    //displays the relationships in json format
    protected $with = array('category', 'landlord', 'rooms');


    public function category()
    {
        return $this->belongsTo('App\buildingCategory' , 'buildingCatID');
    }

    public function landlord()
    {
        return $this->belongsTo('App\userLandlord' , 'landlordID');
    }

    //Gets all rooms
    public function rooms()
    {
        return $this->hasMany('App\roomModel','buildingID');
    }

    public function packages()
    {
        return $this->hasMany('App\packageModel', 'buildingid');
    }
}

