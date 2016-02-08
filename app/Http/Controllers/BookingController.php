<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;

use App\User as User;
use App\vehicleOwner as vehicleOwner;
use App\userLandlord as userLandlord;
use App\UserAdmin as UserAdmin;

use App\packageModel as packageModel;
use App\bookingModel as bookingModel;





 class bookingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the landlord home
	public function packages(Request $request,$id){
		
		$user = $request->session()->get('user');

		$packages = packageModel::where('buildingid', '=', $id)->get();

		
		return view('pages.tenantDealPackage',  array('user' => $user,'packages' => $packages));
	}


	//Book for tenant
	public function register(Request $request){
		
		$error  = false;

		$status =  array('success' => 0 , 'msg' => 'Error occured');

		

		$user = $request->session()->get('user');
		if ((isset($request['package'])) && (!empty($request['package'])) ){
			$packageObj = $request['package'];
			$package = packageModel::find ($request['package']);
			
		}
		else{
			$error  = true;
		}



		if ((isset($request['numAdult'])) && (!empty($request['numAdult']) ) ){
				$adultsObj = $request['numAdult'];
		}
		else if ( ($package -> building -> category -> buildingCatName == 'House' || $package -> building -> category -> buildingCatName == 'Bungalow')){

		}
		else{
				$error  = true;
		}
		
		if ((isset($request['numChild'])) && (!empty($request['numChild'])) ){
				$childrenObj = $request['numChild'];
		}
		

		if ((isset($request['start'])) && (!empty($request['start'])) ){
				$date10Obj = $request['start'];
		}
		else{

			$error  = true;
		}


		if ((isset($request['end'])) && (!empty($request['end'])) ){
				$date11Obj = $request['end'];
		}
		else{
			$error  = true;
		}


		$bookings = bookingModel::where('tenantID', "=", $user[0]->ID)
					->where('checkin' ,'>=' ,$date10Obj)
					->where('checkout' ,'<=' ,$date11Obj)
					->get();

		//Save booking for user
		if (!$error ){
			if (sizeof($bookings) > 0){
				$status['msg'] = "Booking conflict has been detected for the period ".$date10Obj  . " - ". $date11Obj ;
			}
			else{
				$booking = new bookingModel;
				$booking-> checkin = $date10Obj;
				$booking-> checkOut = $date11Obj ;
				$booking-> tenantID = $user[0]->ID; 
				$booking-> packageId = $packageObj ; 
				

				//Get package
				$price = 0;
				$buildingtype = $package->building->category;
				if (!is_null($buildingtype->buildingCatName) && ($buildingtype->buildingCatName == 'Hotel' 
					|| $buildingtype->buildingCatName == 'Appartment'  )) {
					$price = $booking->getPrice($package, $booking);
				}
				else if(!is_null($buildingtype->buildingCatName) && ($buildingtype->buildingCatName == 'Bungalow' 
					|| $buildingtype->buildingCatName == 'Villa'  || $buildingtype->buildingCatName == 'Penthouse' 
					|| $buildingtype->buildingCatName == 'House'    )){

					$price = $booking->getPrice($package, $booking);
				}
				

				
				$booking-> price = $price ; 
				$booking->save();


			
				$status['success'] = 1;
				$status['msg'] = "Booking successfully registered";
			}
			
		}else{

			$status['msg'] = "Error in field validation";

		}
		
		return $status;
	}





}
