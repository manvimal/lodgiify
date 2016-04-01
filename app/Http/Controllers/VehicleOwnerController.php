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
use App\BuildingCategory as buildingCategory;
use App\RoomCategory as roomCategory;
use App\buildingModel as buildingModel;
use App\roomModel as roomModel;
use App\vehicleCategory as vehiclecategory;
use App\vehicleModel as vehicleModel;
use App\travelModel as travelModel;
use App\vehicleBookingModel as vehicleBookingModel;


 class VehicleOwnerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	//Loads the landlord home
	public function landlordhome(Request $request){
		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		return view('pages.LandlordHome',  array('user' => $user));
	}

	// Add Vehicle
	public function addVehicle(Request $request){

		//saves user sesssion in $user to be used in the redirected page
		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		//Gets vehicles categories
		$categories = vehicleCategory::all();
		$vehicles = vehicleModel::where('vehicleOwnerID', '=', $user[0]->id)->get();

		return view('pages.vehicleOwnerAddVehicle',  array('categories' => $categories,'user' => $user, 'vehicles' => $vehicles));
	}


	//viewVehicleBookinga

	public function viewVehicleBookinga(Request $request){
		//saves user sesssion in $user to be used in the redirected page
		$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		$bookings = travelModel::get();

		$bookingsBck = array();

		foreach ($bookings as $booking ) {

			if ($booking->vehicle->vehicleOwnerID == $user[0]->id){
						

				array_push($bookingsBck);

			}
		}
		
		return view('pages.vehicleBookings',  array('user' => $user, 'bookings' => $this->getVehicleBookingRemaining($bookingsBck)));

	}


	//Display booking in future for go and return journey
	private function getVehicleBookingRemaining($bookings){
		$bookinRemaining = array();
		foreach ($bookings as $booking){
			
			if (new \DateTime() <=   new \DateTime($booking->pickUpTime1)){
				array_push($bookinRemaining, $booking);
			}
			
			
			if (($booking->dispach =='true') && (new \DateTime() <=   new \DateTime($booking->pickUpTime2))){
				$bookingCpy = clone $booking;
				$bookingCpy ->pickUpTime1 = $bookingCpy ->pickUpTime2;
				$bookingCpy->pickUpLocation1 = $bookingCpy->pickUpLocation2;
				$bookingCpy ->pickUpDestination1 = $bookingCpy ->pickUpDestination2;
				array_push($bookinRemaining, $bookingCpy);
				
			}
		}

		
		return $bookinRemaining ;
	}



	public function viewBookedVehicles(Request $request)
	{
		$user = $request->session()->get('user');

		

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type == 'vehicleowner')
		{	


			 $VehiclebookingsDone = DB::table('tblvehiclebooking')
							->join('tblvehicle', 'tblvehiclebooking.vehicleid', '=', 'tblvehicle.id')
							->join('tblvehicleowner', 'tblvehicle.vehicleOwnerID', '=', 'tblvehicleowner.id')
							->join('tbltenant', 'tblvehiclebooking.tenantid', '=', 'tbltenant.id')
							->join('tblvehiclecat', 'tblvehicle.vehicleCatID','=' ,'tblvehiclecat.id')
							->where('tblvehicleowner.id','=', $user[0]->id)
							->select('tblvehiclebooking.*', 'tbltenant.FirstName', 'tbltenant.LastName','tbltenant.Phone', 'tbltenant.Email', 'tblvehicle.vehicleName', 'tblvehicle.driver', 'tblvehicle.image', 'tblvehiclecat.vehicleCatName')
							->orderBy('fromdate', 'desc')
							->get();

 
//print('<pre>');
//var_dump($VehiclebookingsDone);
//die;

			$timenow = $this->getTodayDateTime();


			return view('pages.vehicleOwnerVehiclesBooked',  array('user' => $user, 'VehiclebookingsDone'=> $VehiclebookingsDone, 'timenow'=>$timenow));
		}
		
		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}

	private function getTodayDateTime()
	{

		date_default_timezone_set("Indian/Mauritius");
		return date('Y-m-d H:i:s', strtotime('+0 minutes'));
	}


	public function deleteVehicleBooking(Request $request){

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return false;
		}

		if ($request['id'] != null){

			$deleteVehicleBookings = vehicleBookingModel::where('id', '=', $request['id'])->delete();


		}
			print json_encode(array(1));
	
		
	}

	



}