<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\User as User;
use App\vehicleOwner as vehicleOwner;
use App\userLandlord as userLandlord;
use App\UserAdmin as UserAdmin;
use App\BuildingCategory as buildingCategory;
use App\buildingModel as buildingModel;
use App\vehicleModel as vehicleModel;
use Input ;
use Session;
use DB;
use Redirect;




 class SearchController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the search
	public function search(Request $request){
		$result = null;
		if ($_GET != null){
			$action = $request['action'];
			if ($action == "buildings"){
				$result =$this->getQueryBuildings($request) -> toJson();
			}
			else if ($action == "users"){
				$result =$this->getQueryUsers($request) -> toJson();
			}
			else if ($action == "vehicles"){
				$result =$this->getQueryVehicles($request)-> toJson();
			}
			else if ($action == "rooms"){
				$result =$this->getQueryRooms($request)-> toJson();
			}

		}
		print $result;
	}

	private function getQueryBuildings(Request $request){
		$initialised  = false;
		$query = '';

		//Search by id
		if ($request['id'] != null){
			$query = buildingModel :: where ('id' , '=' , $request['id']);

			$initialised = true;
		}

		//Search by landlord
		if($request['landlord'] != null && $initialised ){
			$query->where('landlordID','=',$request['landlord']);
		}
		else{
			if (!$initialised){
				$query = buildingModel :: where ('landlordID','=',$request['landlord']);
				$initialised = true;
			}
			
		}

		//Search by buildingcategory
		if($request['buildingcategory'] != null && $initialised ){
			$query->where('buildingCatID','=',$request['buildingcategory']);
		}
		else{
			if (!$initialised){
				$query = buildingModel :: where ('buildingCatID','=',$request['buildingcategory']);
				$initialised = true;
			}
		}

		//Search by desc
		if($request['buildingname'] != null && $initialised ){
			$query->where('buildingName','LIKE',  "%".$request['buildingname']."%");
		}
		else{
			if (!$initialised){
				$query = buildingModel :: where ('buildingName','LIKE', "%".$request['buildingname']."%");
				$initialised = true;
			}
		}

		//Search by buildingcategory
		if($request['buildingdesc'] != null && $initialised ){
			$query->where('desc','LIKE', "%".$request['buildingdesc']."%");
		}
		else{
			if (!$initialised){
				$query = buildingModel :: where ('desc','LIKE', "%".$request['buildingdesc']."%");
				$initialised = true;
			}
		}

		//limit query 
		if($request['limit'] != null &&  $query != ''){
			$query->take($request['limit']);
		}
		


		$buildings = $query->get();
		return $buildings;
	}

	private function getQueryVehicles(Request $request){
	$initialised  = false;
		$query = '';

		//Search by id
		if ($request['id'] != null){
			$query = vehicleModel :: where ('id' , '=' , $request['id']);

			$initialised = true;
		}

		//Search by landlord
		if($request['vehicleOwnerID'] != null && $initialised ){
			$query->where('vehicleOwnerID','=',$request['vehicleOwnerID']);
		}
		else{
			if (!$initialised){
				$query = vehicleModel :: where ('vehicleOwnerID','=',$request['vehicleOwnerID']);
				$initialised = true;
			}
			
		}

		//Search by buildingcategory
		if($request['category'] != null && $initialised ){
			$query->where('category','=',$request['category']);
		}
		else{
			if (!$initialised){
				$query = vehicleModel :: where ('vehicleCatID','=',$request['category']);
				$initialised = true;
			}
		}

		//Search by desc
		if($request['name'] != null && $initialised ){
			$query->where('name','LIKE',  "%".$request['name']."%");
		}
		else{
			if (!$initialised){
				$query = vehicleModel :: where ('name','LIKE', "%".$request['name']."%");
				$initialised = true;
			}
		}

		//Search by buildingcategory
		if($request['numOfSeats'] != null && $initialised ){
			$query->where('numOfSeats','LIKE', "%".$request['numOfSeats']."%");
		}
		else{
			if (!$initialised){
				$query = buildingModel :: where ('numOfSeats','LIKE', "%".$request['numOfSeats']."%");
				$initialised = true;
			}
		}

		//limit query 
		if($request['limit'] != null &&  $query != ''){
			$query->take($request['limit']);
		}
		


		$vehicles = $query->get();
		return $vehicles;

	}
	private function getQueryUsers(Request $request){


	}
	private function getQueryRooms(Request $request){


	}

	
}