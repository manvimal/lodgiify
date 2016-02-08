<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
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
use App\packageModel as packageModel;




 class packageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	
    // GET a package
	public function get(Request $request, $id){
		$package = packageModel::where('id', '=', $id)->first();
		return $package;
	}

	public function registerPackage(Request $request){

		$user = $request->session()->get('user');
	
		if ((isset($request['packageName'])) && (!empty($request['packageName'])) ){
			$packageName = $request['packageName'];
		}

		if ((isset($request['category'])) && (!empty($request['category'])) ){
				$category = $request['category'];
		}
		
		if ((isset($request['desc'])) && (!empty($request['desc'])) ){
				$desc = $request['desc'];
		}

		if ((isset($request['capacity'])) && (!empty($request['capacity'])) ){
				$capacity = $request['capacity'];
		}


		if ((isset($request['building'])) && (!empty($request['building'])) ){
				$building = $request['building'];
		}

		if ((isset($request['newPrice'])) && (!empty($request['newPrice'])) ){
				$newPrice = $request['newPrice'];
		}
		

		// Retrieve use session
		$user = $request->session()->get('user');

		//Save room for user
		$package = new packageModel;
		$package-> buildingID = $building  ;
		$package-> roomCategoryID = $category;
		$package-> packageDesc = $desc ;
		$package-> capacityAdult = $capacity;
		$package-> newPrice = $newPrice;
		$package-> packageName = $packageName;

		$package->save();
		//Session::flash('success', 'Package successfully registered'); 

		return Redirect::to('/insertPackage');

	}

	public function viewPackage(Request $request){	

		$user = $request->session()->get('user');

		//Gets buildings
		$buildings = buildingModel::where('landlordID', '=', $user[0]->ID)->get();

			//Gets packages of building
		$packages = packageModel::where('buildingid', '=', $buildings[0]->id)->get();

		//var_dump($packages[0]->id);

		return view('pages.landlordpackages',  array('user' => $user, 'packages' => $packages, 'buildings' => $buildings));

	}
	public function delete(Request $request){


	}


}
