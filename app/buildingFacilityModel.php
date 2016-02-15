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

class buildingFacilityModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblbuildingfacility';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['id',
                           'buildingid',
                           'facilityid'];


    protected $with = array('facility','building');
    

   public function facility()
    {
        return $this->belongsTo('App\facilityModel' , 'facilityid');
    }

    public function building()
    {
        return $this->belongsTo('App\buildingModel' , 'buildingid');
    }

}

