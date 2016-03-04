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




 class LandlordController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the landlord home
	public function landlordhome(Request $request){
		$user = $request->session()->get('user');
		return view('pages.LandlordHome',  array('user' => $user));
	}

	// Add building
	public function addBuilding(Request $request){
		$user = $request->session()->get('user');

		//Gets building categories
		$categories = buildingCategory::all();
		$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();
		$hasBuildings = buildingModel::where('landlordID','=',$user[0]->id)->get();

		$facilities = facilityModel::all();

		$buildingFacAr = array();
		foreach($buildings as $building){

			$buildingFacilities = buildingFacilityModel::where('buildingid', '=', $building->id)->get();
//
			array_push($buildingFacAr , $buildingFacilities );

		}

	
//var_dump($buildings);
//
		//die;

		return view('pages.landlordAddBuilding',  array('categories' => $categories,'buildingFacilities'=>$buildingFacAr, 'user' => $user, 'buildings' => $buildings, 'facilities' => $facilities, 'hasBuildings'=>$hasBuildings));
	}


	// Add room
	public function addRoom(Request $request){
		$user = $request->session()->get('user');

		//Gets room categories
		$categories = roomCategory::all();

		//Gets buildings
		$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();
		
		$facilities = facilityModel::all();



		//Get rooms
		$rooms = roomModel::where('landlordID', '=', $user[0]->id)->get();
		
		$AddRoomFacilities = roomModel::where('landlordID', '=', $user[0]->id)->get();


		$roomFacAr = array();
		foreach($rooms as $room){

			$roomFacilities = roomFacilityModel::where('roomid', '=', $room->id)->get();
//
			array_push($roomFacAr , $roomFacilities );

		}

		
		return view('pages.landlordAddRoom',  array('categories' => $categories,'user' => $user, 'roomFacilities'=> $roomFacAr, 'buildings' => $buildings, 'facilities'=>$facilities, 'rooms' => $rooms, 'AddRoomFacilities' => $AddRoomFacilities));
	}

	//Administere building packages
	public function insertPackage(Request $request){

		$user = $request->session()->get('user');

		$categories = roomCategory::all();

		$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();

/**

		foreach($buildings as $building){

			$buildingArr[] = $building->id;
		}
		
		foreach($buildingArr as $array){


			
			$packages = packageModel::where('buildingid','=', $array);

			
			
		}


	var_dump($packages->packageName);

		die;

	//	var_dump($packages);
	
**/
		
		
		return view('pages.insertPackage',  array('user' => $user, 'buildings' => $buildings, 'categories' => $categories));
	}


}