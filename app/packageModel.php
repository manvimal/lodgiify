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

class packageModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblpackage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['id',
                            'buildingid','packageName','packageDesc','newPrice','capacityAdult','Promotion' ,'capacityChildren','roomCategoryID','oldPrice','promotionDescription','promotionExpiryDate'
                            ,'basic','adultPrice','childPrice'];

    //displays the relationships in json format
    protected $with = array('building', 'roomCategory');


    public function building()
    {
        return $this->belongsTo('App\buildingModel' , 'buildingid');
    }

    public function roomCategory()
    {
        return $this->belongsTo('App\roomCategory' , 'roomCategoryID');
    }

   
}

