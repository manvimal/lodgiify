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
use App\buildingModel as buildingModel;
use App\travelModel as travelModel;
use App\bookingPackageModel as bookingPackageModel;
use Redirect;



 class bookingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the landlord home
	public function packages(Request $request,$id){
		
		$user = $request->session()->get('user');

		$packages = packageModel::where('buildingid', '=', $id)->get();

		$building = buildingModel::where("id",'=',  $id)->first();

		
		return view('pages.tenantDealPackage',  array('user' => $user,'packages' => $packages, 'building' => $building ));
	}


	//Book for tenant
	public function register(Request $request){
		
		$error  = false;

		$status =  array('success' => 0 , 'msg' => 'Error occured');

		

		$user = $request->session()->get('user');



		if ((isset($request['date10'])) && (!empty($request['date10'])) ){
				$date10Obj = $request['date10'];
		}
		else{

			$error  = true;
		}

		if ((isset($request['date11'])) && (!empty($request['date11'])) ){
				$date11Obj = $request['date11'];
		}
		else{
			$error  = true;
		}


		
		if ((isset($request['packages'])) && (!empty($request['packages'])) ){
			//$packageObj = $request['package'];
			//$package = packageModel::find ($request['package']);

			$bookings = bookingModel::where('tenantID', "=", $user[0]->id)
					->where('checkin' ,'>=' ,$date10Obj)
					->where('checkout' ,'<=' ,$date11Obj)
					->get();


			if (!$error){
				if (sizeof($bookings) > 0){
						$status['msg'] = "Booking conflict has been detected for the period ".$date10Obj  . " - ". $date11Obj ;
					}
					else{
						$booking = new bookingModel;
						$booking-> checkin = $date10Obj;
						$booking-> checkOut = $date11Obj ;
						$booking-> tenantID = $user[0]->id; 
						$booking->save();


						 $price = 0;
						 foreach ($request['packages'] as $packaged) {
						 	
							
							if ( isset($packaged['package']  )){
									$idpackage = $packaged['package'] ;
									$child = $packaged['child'] ;
									$adult = $packaged['adult'] ;

									$package = packageModel::find ( $idpackage );

									//Get package
									
									$buildingtype = $package->building->category;

									
									if (!is_null($buildingtype->buildingCatName) && ($buildingtype->buildingCatName == 'Hotel' 
												|| $buildingtype->buildingCatName == 'Appartment'  )) {
												$price += $booking->getPrice($package, $booking);
									}
									else if(!is_null($buildingtype->buildingCatName) && ($buildingtype->buildingCatName == 'Bungalow' 
												|| $buildingtype->buildingCatName == 'Villa'  || $buildingtype->buildingCatName == 'Penthouse' 
												|| $buildingtype->buildingCatName == 'House'    )){

												$price += $booking->getPrice($package, $booking);
											
									}

									//Add to booking

									$bookingpackage = new bookingPackageModel;
									$bookingpackage-> booking_id = $booking->id;
									$bookingpackage-> package_id = $idpackage;
									$bookingpackage->save();
							}
									
						}

						$booking-> price = $price ; 
						$booking->save();
						$status['success'] = 1;
						$status['msg'] = "Booking successfully registered";

						foreach ($request['block-vehicle'] as $blockVehicle) {
						 	
							
							if ( isset($blockVehicle)){
									$vehicle = $blockVehicle['vehicle'];
									
									
									$travelModel = new travelModel;
									$travelModel-> bookingID = $booking->id;
									$travelModel-> vehicleID = $vehicle;
									$travelModel-> dispach = $blockVehicle['dispatch'];
									$travelModel-> pickUpTime1 = $booking-> checkin;
									$travelModel-> pickUpLocation1 = $user[0]->Address;
									$travelModel-> pickUpDestination1 = $vehicle;

									if ($booking-> dispach){
										$travelModel-> pickUpTime2 = $booking-> checkout;
										$travelModel-> pickUpLocation2 = $user[0]->Address;
										$travelModel-> pickUpDestination2 = $user[0]->Address;
									}
										
									
									
									$travelModel->save();
							}
									
						}



						
				 }

				

			}

			
					
				
			
		}
		

		return $status;
	}





}
