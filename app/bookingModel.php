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
                            'tenantID', 'travelID', 'checkin', 'checkOut','packageId','price'];

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

    public function getPrice($package, $booking){

            if (!is_null($package->building->category->buildingCatName) && ($package->building->category->buildingCatName == 'Hotel' 
                    || $package->building->category->buildingCatName == 'Appartment'  )) {
                    //$price = 
                    $checkIn = new \DateTime($booking -> checkIn);
                    $checkOut =  new \DateTime($booking -> checkOut);
                    $noDays = $checkOut->diff( $checkIn)->format("%a");
                    $perprice = $this->getPromotionalPrice($package, 0);
                    $price = $noDays *  $perprice;
                }
                else if(!is_null($package->building->category->buildingCatName) && ($package->building->category->buildingCatName == 'Bungalow' 
                    || $package->building->category->buildingCatName == 'Villa'  || $package->building->category->buildingCatName == 'Penthouse' 
                    || $package->building->category->buildingCatName == 'House'    )){
                    $checkIn = new \DateTime($booking -> checkIn);
                    $checkOut =  new \DateTime($booking -> checkOut);
                    $noDays = $checkOut->diff( $checkIn)->format("%a");
                    $perprice = $this->getPromotionalPrice($package, 1);
                    $price = $noDays *  $perprice;

                }
               
            return $price ;
    }


    private function getPromotionalPrice($package, $type){
        if (!is_null($type) && !is_null($package)){
            if ($package->promotion || (new \DateTime() < $package->promotionExpiryDate)){
                if ($type == 0){
                    return array(
                         "adult" => $package-> adultPrice,
                        "child" => $package-> childPrice,
                    );

                }
                if ($type == 1){
                    return $package-> newPrice;
                }
            }
            else{

                if ($type == 0){
                    return array(
                        "adult" => $package-> adultPrice,
                        "child" => $package-> childPrice,
                    );

                }
                if ($type == 1){
                    return $package-> oldPrice;
                }
            }
        }
        return 0;
    }

   /* public function travel()
    {
        return $this->belongsTo('App\travelModel' , 'travelID');
    }*/
   
}

