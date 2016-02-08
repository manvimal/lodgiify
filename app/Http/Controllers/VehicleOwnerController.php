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

 class VehicleOwnerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	//Loads the landlord home
	public function landlordhome(Request $request){
		$user = $request->session()->get('user');
		return view('pages.LandlordHome',  array('user' => $user));
	}

	// Add Vehicle
	public function addVehicle(Request $request){

		//saves user sesssion in $user to be used in the redirected page
		$user = $request->session()->get('user');

		//Gets vehicles categories
		$categories = vehicleCategory::all();
		$vehicles = vehicleModel::where('vehicleOwnerID', '=', $user[0]->id)->get();

		return view('pages.vehicleOwnerAddVehicle',  array('categories' => $categories,'user' => $user, 'vehicles' => $vehicles));
	}

}