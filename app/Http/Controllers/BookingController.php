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
use App\buildingCategory as buildingCategory;
use App\bookingPackageModel as bookingPackageModel;
use App\roomBookingModel as roomBookingModel;
use App\starReviewModel as starReviewModel;

use Redirect;



 class bookingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the landlord home
	public function packages(Request $request,$id){
		
		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		else if($user[0]->type == 'tenant'){
		$packages = packageModel::where('buildingid', '=', $id)->get();

		$building = buildingModel::where("id",'=',  $id)->first();

		$buildingCat = buildingCategory::where('id', '=', $building->buildingCatID)->get();

		
	
		return view('pages.tenantDealPackage',  array('user' => $user,'packages' => $packages, 'building' => $building, 'buildingCat'=> $buildingCat  ));
	}
	else{
		return redirect()->action('MainController@index');
	}

	
	}


	//Book for tenant
	public function register(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		$error  = false;

		$status =  array('success' => 0 , 'msg' => 'Error occured');

		

		$user = $request->session()->get('user');


		$building = buildingModel::where("id",'=',  $request['buildingId'])->first();

		$buildingCat = buildingCategory::where('id', '=', $building->buildingCatID)->get();

	

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




			if(($buildingCat[0]->buildingCatName == "Hotel") || ($buildingCat[0]->buildingCatName == "Appartment"))

			{

					$bookings = bookingModel::where('tenantID', "=", $user[0]->id)
					->where('checkin' ,'>=' ,$date10Obj)
					->where('checkout' ,'<=' ,$date11Obj)
					->get();

					if (sizeof($bookings) > 0){
						$status['msg'] = "Booking conflict has been detected for the period ".$date10Obj  . " - ". $date11Obj ;
						return $status;
					}
					else{


						//Check if all rooms available in this package
						$buildingId = $request['buildingId'];
						$error = false;
						$roomPackage = array();

						foreach ($request['packages'] as $packaged) {
					
							if ( isset($packaged['package']  )){
								$idpackage = $packaged['package'];
								$child = $packaged['child'] ;
								$adult = $packaged['adult'] ;
								$roomsNum = $packaged['room'] ;


								$package = packageModel::find($idpackage );
			 //var_dump($packaged->id);
								$rooms = DB::table('tblroom')
					                     ->select(DB::raw('*'))
					                     ->where('buildingid', '=', $buildingId)
					                     ->where('roomCatID', '=', $package->roomCategoryID)
					                     ->get();




					            $roomsub = DB::table('tblroombooking')
									           ->join('tblroom', 'tblroombooking.roomId', '=', 'tblroom.id')
									           ->join('tblbooking', 'tblroombooking.bookingId', '=', 'tblbooking.id')
									           ->where('tblroom.roomCatID', '=', $package->roomCategoryID)
									           ->where('tblroom.buildingID','=', $buildingId)
									           ->where('tblbooking.checkin','>=', $date10Obj )
									           ->where('tblbooking.checkOut','<=', $date11Obj)
									           ->select('tblroom.*')

					            ->get();


					           if (!empty($rooms) && !empty($roomsub)){
							   		$roomsAvailable = array_diff($rooms ,$roomsub);
							   }
					           else if (!empty($rooms) ){
							   		$roomsAvailable = $rooms;
							   }
							   else if (!empty($roomsub) ){
							   		$roomsAvailable = array();
							   }
					           
					           else{
					           	$roomsAvailable = array();
					           }
			          
				           
					           if (isset($roomsNum ) && ($roomsNum  > 0) &&  ($roomsNum  <= count($roomsAvailable)))
					           {
					           		$roomPackage[$idpackage]  = $roomsAvailable;
					           		//success

					           }

					         	else if(($roomsNum == 0) && ($roomsNum >count($roomsAvailable)))
				         		{

									$error = true;
						      

						           	$status['msg'] = "No selected room ";
	
				           		}



					           	else if(($roomsNum > 0) && ($roomsNum >count($roomsAvailable)))
				         		{
				         			$error = true;
				         			$status['msg'] = "Not enough rooms for the period ".$date10Obj  . " - ". $date11Obj . "  for package" . $package->packageName ;
				         		}
								 else
						           {
						           		$error = true;
						           		$status['msg'] = "Error ";
						           }

				


						}

					}

					//iF ALL ROOMS AVAILABLE AND NO ERROR INSERT INTO BOOKING
					//INSERT INTO ROOMBOOKING
					if (!$error){
						$booking = new bookingModel;
						$booking-> checkin = $date10Obj;
						$booking-> checkOut = $date11Obj ;
						$booking-> tenantID = $user[0]->id; 
						$booking-> buildingID = $request['buildingId'];
						$booking->save();

						$price = 0;

						foreach ($request['packages'] as $packaged) {
							if ( isset($packaged['package']  )){
								$idpackage = $packaged['package'];
								$child = $packaged['child'] ;
								$adult = $packaged['adult'] ;
								$roomsNum = $packaged['room'] ;
								$roomPackage[$idpackage] ;

								$package = packageModel::find($idpackage );

								//insert into booking package 
								$bookingpackage = new bookingPackageModel;
								$bookingpackage-> booking_id = $booking->id;
								$bookingpackage-> package_id = $idpackage;
								$bookingpackage->save();

								//insert into roombooking
								$availablerooms = $roomPackage[$idpackage ];
								for ($i=0; $i< $roomsNum;$i++){
									$roomBookingModel = new roomBookingModel;
									$roomBookingModel->roomId = $availablerooms[$i]->id;
									$roomBookingModel->bookingId = $booking->id;
									$roomBookingModel->save();
								}

								$priceArr = $booking->getPrice($package, $booking);

								

								$price += ((float)$priceArr['days'] )* (($priceArr['child'] * $child)  + ($adult * $priceArr['adult']) );
								
							}
							

							

						}

						$booking-> price = $price ; 
						
						$booking->save();
						$status['success'] = 1;
						$status['msg'] = "Booking successfully registered";

						if (count($request['block-vehicle']) > 0){

							foreach ($request['block-vehicle'] as $blockVehicle) {
							 	
								
								if ( isset($blockVehicle)){
										$vehicle = $blockVehicle['vehicle'];
										
										
										$travelModel = new travelModel;
										$travelModel-> bookingID = $booking->id;
										$travelModel-> vehicleID = $vehicle;
										$travelModel-> dispach = $blockVehicle['dispatch'];
										$travelModel-> pickUpTime1 = $booking-> checkin;
										$travelModel-> pickUpLocation1 = $user[0]->Address;


										$travelModel-> pickUpDestination1 = $booking->building->buildingLocation;



										if ($travelModel-> dispach == 'true'){
											$travelModel-> pickUpTime2 = $booking-> checkOut;
											$travelModel-> pickUpLocation2 = $booking->building->buildingLocation;
											$travelModel-> pickUpDestination2 = $user[0]->Address;
										}
											
										
										
										$travelModel->save();
								}
										
							}
						}


					}
		           	}
				
				 
				}
	



		//building cat = villa/house etc....
		else{

			

			$bookings = bookingModel::where('tenantID', '=', $user[0]->id)
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
						$booking-> buildingID = $request['buildingId'];
						$booking->save();


						 $price = 0;
						 foreach ($request['packages'] as $packaged) {
						 	
							
							if ( isset($packaged['package']  )){

								//Access array packaged key pacakges, ie:number of selected packages
									$idpackage = $packaged['package'] ;
									$child = $packaged['child'] ;
									$adult = $packaged['adult'] ;

									$package = packageModel::find ( $idpackage);

									
									$price += $booking->getPrice($package, $booking);
											
								
									//Add to booking

									$bookingpackage = new bookingPackageModel;
									$bookingpackage->booking_id = $booking->id;
									$bookingpackage->package_id = $idpackage;



									$bookingpackage->save();
							}
									
						}
						

						//update price in booking

						$booking->price = $price ; 
						$booking->save();
						$status['success'] = 1;
						$status['msg'] = "Booking successfully registered";
						if (!empty($request['block-vehicle'] )){
						foreach ($request['block-vehicle'] as $blockVehicle) {
						 	
							
							if ( isset($blockVehicle)){
									$vehicle = $blockVehicle['vehicle'];
									
									
									$travelModel = new travelModel;
									$travelModel-> bookingID = $booking->id;
									$travelModel-> vehicleID = $vehicle;
									$travelModel-> dispach = $blockVehicle['dispatch'];
									$travelModel-> pickUpTime1 = $booking->checkin;
									$travelModel-> pickUpLocation1 = $user[0]->Address;


									$travelModel-> pickUpDestination1 = $booking->building->buildingLocation;
	


									if ($travelModel->dispach == 'true'){
										$travelModel-> pickUpTime2 = $booking->checkOut;
										$travelModel-> pickUpLocation2 = $booking->building->buildingLocation;
										

										$travelModel-> pickUpDestination2 = $user[0]->Address;
										
									}
										
									
									
									$travelModel->save();
							}
									
						}


					}
						
				 }

				

			}

			
					
				}
			
		}

		

		return $status;
	}




	public function checkAvailability(Request $request){
		$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}


		if ((isset($request['buildingid'])) && (!empty($request['buildingid'])) ){
				$buildingId = $request['buildingid'];
		}	


		if ((isset($request['checkin'])) && (!empty($request['checkin'])) ){
				$date10Obj = $request['checkin'];
		}


		if ((isset($request['checkout'])) && (!empty($request['checkout'])) ){
				$date11Obj = $request['checkout'];
		}

		if ((isset($request['packageid'])) && (!empty($request['packageid'])) ){
				$packageid = $request['packageid'];
		}
		

       /* $package = DB::table('tblpackage')
                     ->select(DB::raw('*'))
                     ->where('id', '=', $packageid)
                     ->first(); */
		$package = packageModel::where('id', '=', $packageid)->first();


		$rooms = DB::table('tblroom')
                     ->select(DB::raw('*'))
                     ->where('buildingid', '=', $buildingId)
                     ->where('roomCatID', '=', $package->roomCategoryID)
                     ->get();


        $roomsub = DB::table('tblroombooking')
		            ->join('tblroom', 'tblroombooking.roomId', '=', 'tblroom.id')
		            ->join('tblbooking', 'tblroombooking.bookingId', '=', 'tblbooking.id')
		            ->where('tblroom.roomCatID', '=', $package->roomCategoryID)
		            ->where('tblroom.buildingID','=', $buildingId)
		            ->where('tblbooking.checkin','>=', $date10Obj )
		             ->where('tblbooking.checkOut','<=', $date11Obj)
		            ->select('tblroom.*')

		            ->get();



            $arrmsg = array();


                    
		   if (!empty($rooms) && !empty($roomsub)){
		   		$roomsAvailable = array_diff($rooms ,$roomsub);
		   }
           else if (!empty($rooms) ){
		   		$roomsAvailable = $rooms;
		   }
		   else if (!empty($roomsub) ){
		   		$roomsAvailable = array();
		   }
           
           else{
           	$roomsAvailable = array();
           }
          
           if (isset($request['rooms']) && ($request['rooms'] > 0) &&  ($request['rooms'] <= count($roomsAvailable))){
           		$arrmsg['status'] = 1;
           		$arrmsg['msg'] = "Enough rooms available";
           }
           else if(isset($request['rooms']) && ($request['rooms'] == 0)){
           		$arrmsg['status'] = -1;
           		$arrmsg['msg'] = "You have not selected no of rooms";
           }
           else if(isset($request['rooms']) && ($request['rooms'] > 0)  &&  ($request['rooms'] >count($roomsAvailable))){
           		$arrmsg['status'] = -1;
           		$arrmsg['msg'] = "We do not have so any rooms for this period";
           }
           else{
           		$arrmsg['status'] = -1;
           		$arrmsg['msg'] = "Error";
           }
           return json_encode($arrmsg);

	}

	public function tenantFeedback(Request $request){

		$user = $user = $request->session()->get('user');
		$bookingid = $request['id'];

		$user = $request->session()->get('user');

		if (is_null($user)){

			
			return redirect()->action('MainController@index');
		}
		else if($user[0]->type == 'tenant'){ 
		

/**			$checkExists = starReviewModel::where('tenantid', '=', $user[0]->id)
								->where('bookingid','=',$bookingid) ->get();
var_dump($checkExists[0]->numofstar);
								
	**/							
		$checkExists = DB::table('tbluserstarreview')->where('tenantid', '=', $user[0]->id)
												->where('bookingid','=',$bookingid) ->get();

		return view('pages.tenantFeedback',  array('user' => $user, 'checkExists'=>$checkExists,'bookingid'=>$bookingid));
	}
	else{
		return redirect()->action('MainController@index');
	}

	}


	public function insertRating(Request $request){

		  $messge  = array(
		    "status" => 0,
		);

		$user = $user = $request->session()->get('user');


		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		else if($user[0]->type == 'tenant'){ 


			if(isset($request['rating'])){

				$numberOfStars = $request['rating'];
			}
			if(isset($request['bookingid'])){

				$bookingid = $request['bookingid'];
			}

		$checkExists = DB::table('tbluserstarreview')->where('tenantid', '=', $user[0]->id)
													 ->where('bookingid','=',$bookingid) ->get();



		if(empty($checkExists) ){

			$InsertReview = DB::table('tbluserstarreview')->insert(
   													 array('tenantid' => $user[0]->id, 
   													       'bookingid' => $bookingid, 
   													       'numofstar' =>  $numberOfStars)
												  );

												  

			$messge['status'] = 1;
		 	$messge['msg'] = "Successfully Inserted. Please Wait...";
    
		    //Return json formatted rating data
		    echo json_encode($messge);		

		}
		else{


		}

			


	}
	else{
		return redirect()->action('MainController@index');
	}

	}
	



}
