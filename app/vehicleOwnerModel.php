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

class vehicleOwnerModel extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tblvehicleowner';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [ 'ID',
                            'UserName',
                            'FirstName', 
                            'LastName', 
                            'Password',
                            'DOB',
                            'Phone',
                            'Gender',
                            'Email', 
                            'Address',
                            'PostalCode',
                            'Country',
                            'type'
                            ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
 

  //Gets all vehicles
    public function vehicles()
    {
        return $this->hasMany('App\vehicleModel','vehicleOwnerID');
    }
}


