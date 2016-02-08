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
		$buildings = buildingModel::where('landlordID', '=', $user[0]->ID)->get();

		return view('pages.landlordAddBuilding',  array('categories' => $categories,'user' => $user, 'buildings' => $buildings));
	}


	// Add room
	public function addRoom(Request $request){
		$user = $request->session()->get('user');

		//Gets room categories
		$categories = roomCategory::all();

		//Gets buildings
		$buildings = buildingModel::where('landlordID', '=', $user[0]->ID)->get();
		

		//Get rooms
		$rooms = roomModel::where('landlordID', '=', $user[0]->ID)->get();
		
		return view('pages.landlordAddRoom',  array('categories' => $categories,'user' => $user, 'buildings' => $buildings, 'rooms' => $rooms));
	}

	//Administere building packages
	public function insertPackage(Request $request){

		$user = $request->session()->get('user');

		$categories = roomCategory::all();

		$buildings = buildingModel::where('landlordID', '=', $user[0]->ID)->get();
		
		return view('pages.insertPackage',  array('user' => $user, 'buildings' => $buildings, 'categories' => $categories));
	}


}