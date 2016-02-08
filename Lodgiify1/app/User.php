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

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbltenant';
     protected $guarded = array( 'Password');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['UserName',
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

    public function register($firstName){
        $users = DB::select('select * from tbltenant ');
        var_dump($users);
        die;

        
    }

    public static $validation = array(

        'FirstName' => 'required|unique:tbltenant:alpha_hash[min:4',
        'Password' => 'required|alpha_num|between:4-15|confirmed',
        'confirmPassword'=>'required|alpha_num|between:4-15'

        );
        
    
}

