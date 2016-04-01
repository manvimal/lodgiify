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
use App\facilityModel as facilityModel;
use App\buildingFacilityModel as buildingFacilityModel;
use App\roomFacilityModel as roomFacilityModel;
use App\packageModel as packageModel;
use App\bookingModel as bookingModel;
use App\bookingPackageModel as bookingPackageModel;
use App\travelModel as travelModel;
use App\roomBookingModel as roomBookingModel;





 class LandlordController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the landlord home
	public function landlordhome(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}
		elseif($user[0]->type=='Landlord')
		{
			return view('pages.LandlordHome',  array('user' => $user));
		}
		

		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}
	}

	// Add building
	public function addBuilding(Request $request){
		$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=='Landlord')
		{
			//Gets building categories
			$categories = buildingCategory::all();
			$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();
			$hasBuildings = buildingModel::where('landlordID','=',$user[0]->id)->get();

			$facilities = facilityModel::all();

			$buildingFacAr = array();
			foreach($buildings as $building)
			{
				$buildingFacilities = buildingFacilityModel::where('buildingid', '=', $building->id)->get();
	
				array_push($buildingFacAr , $buildingFacilities );

			}

			return view('pages.landlordAddBuilding',  array('categories' => $categories,'buildingFacilities'=>$buildingFacAr, 'user' => $user, 'buildings' => $buildings, 'facilities' => $facilities, 'hasBuildings'=>$hasBuildings));

		}

		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}
	
//var_dump($buildings);
		//die;

		}


	// Add room
	public function addRoom(Request $request){
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=='Landlord')
		{
		//Gets room categories
			$categories = roomCategory::all();

			//Gets buildings
			$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();
			
			$facilities = facilityModel::all();


			//Get rooms
			$rooms = roomModel::where('landlordID', '=', $user[0]->id)->get();
			
			$AddRoomFacilities = roomModel::where('landlordID', '=', $user[0]->id)->get();


			$roomFacAr = array();

			foreach($rooms as $room)
			{

				$roomFacilities = roomFacilityModel::where('roomid', '=', $room->id)->get();
	//
				array_push($roomFacAr , $roomFacilities );

			}

			
			return view('pages.landlordAddRoom',  array('categories' => $categories,'user' => $user, 'roomFacilities'=> $roomFacAr, 'buildings' => $buildings, 'facilities'=>$facilities, 'rooms' => $rooms, 'AddRoomFacilities' => $AddRoomFacilities));
		}

		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}
	}

	//Administere building packages
	public function insertPackage(Request $request){

		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=='Landlord')
		{
			$categories = roomCategory::all();

			$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();

			return view('pages.insertPackage',  array('user' => $user, 'buildings' => $buildings, 'categories' => $categories));
		}

		
		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}


	public function viewBookedRooms(Request $request)
	{

		$user = $request->session()->get('user');
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type == 'Landlord')
		{




			$bookingsDone = DB::table('tblbooking')
							->join('tblbuilding', 'tblbooking.buildingid', '=', 'tblbuilding.id')
							->join('tbllandlord', 'tblbuilding.landlordid', '=', 'tbllandlord.id')
							->join('tbltenant', 'tblbooking.tenantid', '=', 'tbltenant.id')
							->join('tblbuildingcat', 'tblbuilding.buildingCatID','=' ,'tblbuildingcat.id')
							->where('tbllandlord.id','=', $user[0]->id)
							->select('tblbooking.*', 'tbltenant.FirstName', 'tbltenant.LastName','tbltenant.Phone', 'tbltenant.Email', 'tblbuilding.buildingName','tblbuilding.image', 'tblbuildingcat.buildingCatName')
							->orderBy('checkIn', 'desc')
							->get();

 
//print('<pre>');
//var_dump($bookingsDone[0]);
//die;

			$timenow = $this->getTodayDateTime();


			return view('pages.landlordViewAllBookingClients',  array('user' => $user, 'bookingsDone'=> $bookingsDone, 'timenow'=>$timenow));
		}

		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}

	public function landlordDeleteTenantBooking(Request $request)
	{
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}

		elseif($user[0]->type=='Landlord')
		{

			if ($request['id'] != null)
			{
				$deleteBookings = bookingModel::where('id', '=', $request['id'])->delete();

				$deletePackageModel = bookingPackageModel::where("booking_id","=", $request['id'])->delete();

				$travelModel= travelModel::where("bookingID",'=', $request['id'])->delete();

				roomBookingModel::where("bookingId","=",$request['id'])->delete();

			}
				print json_encode(array(1));
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
	


}