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
use App\vehicleOwnerModel as vehicleOwnerModel;
use App\vehicleCategory as vehicleCategory;



 class adminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function viewTenant(Request $request){
		
		$user = $request->session()->get('user');
		$tenants = User::all();
		return view('pages.adminViewTenants',  array('user'=>$user, 'tenants' => $tenants));
	}


	public function deleteTenant(Request $request){
			

			if ($request['id'] != null){
			$deleteTenant = User::where('id', '=', $request['id'])->delete();
			return redirect()->action('adminController@viewTenant');
		}
			print json_encode(array(1));
	}


	public function updateTenant(Request $request){






	}


	public function viewLandlord(Request $request){

		$user = $request->session()->get('user');
		 $landlords = userLandlord::all();
		 return view('pages.adminViewLandlords',  array('user'=>$user, 'landlords' => $landlords)); 
	}


	public function deleteLandlord(Request $request){
			

			if ($request['id'] != null){
			$deletelandlord = userLandlord::where('id', '=', $request['id'])->delete();
			return redirect()->action('adminController@viewLandlord');
		}
			print json_encode(array(1));
	
	}
   

   public function updateLandlord(Request $request){




		

	}


	public function viewVehicleOwner(Request $request){

		$user = $request->session()->get('user');
		$vehicleowners = vehicleOwnerModel::all();
		return view('pages.adminViewVehicleOwner',  array('user'=>$user, 'vehicleowners' => $vehicleowners)); 
	}


	public function deleteVehicleOwner(Request $request){
			

			if ($request['id'] != null){
			$deletevehicleowner = vehicleOwnerModel::where('id', '=', $request['id'])->delete();
			return redirect()->action('adminController@viewVehicleOwner');
		}
			print json_encode(array(1));
	
	}
   

   public function updateVehicleOwner(Request $request){




		

	}


	 public function addCategoryPage(Request $request){
		$user = $request->session()->get('user');
		return view('pages.adminAddCategories',  array('user' => $user));		
	}




	public function addCategories(Request $request){
			$error=1;
			$messge  = array(
			    "status" => 0,
			);


			if ((isset($_REQUEST['roomCatName'])) && (!empty($_REQUEST['roomCatName'])) ){
					$roomCatName = $_REQUEST['roomCatName'];



					$roomCategoryName = DB::table('tblroomcat')
	                    ->select(DB::raw('*'))
	                    ->where('roomCatName', '=', $roomCatName)
	                    ->get();

	                     
		
					 if(!empty($roomCategoryName)) {
					 	$messge['status'] = -1;
					 	$messge['msg'] = "Already exists";

					 }

					 else{

						$user = roomCategory::create(['roomCatName' => $roomCatName]);


						$messge['status'] = 1;
					 	$messge['msg'] = "Room Category registered";

				
					}




				
			}
			 	else if((isset($_REQUEST['buildingcatName'])) && (!empty($_REQUEST['buildingcatName'])) ){

				$buildingCatName = $_REQUEST['buildingcatName'];


				$buildingcategoryName = DB::table('tblbuildingcat')
	                    ->select(DB::raw('*'))
	                    ->where('buildingCatName', '=', $buildingCatName)
	                    ->get();

	                     
		
					 if(!empty($buildingcategoryName)) {
					 	$messge['status'] = -1;
					 	$messge['msg'] = "Already exists";

					 }

					 else{

						$user = buildingCategory::create(['buildingCatName' => $buildingCatName]);


						$messge['status'] = 1;
					 	$messge['msg'] = "Building Category registered";
				
					}


			}

				else if((isset($_REQUEST['vehiclecatName'])) && (!empty($_REQUEST['vehiclecatName'])) ){
				
				$vehicleCatName = $_REQUEST['vehiclecatName'];

				$vehicleCategoryName = DB::table('tblvehiclecat')
	                    ->select(DB::raw('*'))
	                    ->where('vehiclecatnameType', '=', $vehicleCatName)
	                    ->get();

	                     
				
					 if(!empty($vehicleCategoryName)) {
					 	$messge['status'] = -1;
					 	$messge['msg'] = "Already exists";

					 }

					 else{

						$user = vehicleCategory::create(['vehiclecatnameType' => $vehicleCatName,
														 'vehiclecatname' => $vehicleCatName
														  ]);

						$messge['status'] = 1;
					 	$messge['msg'] = "Vehicle Category registered";
					}

			}

				else{


			}
		
			



	echo json_encode ($messge);
	}


	public function viewCategoryPage(Request $request){

		$user = $request->session()->get('user');
		$roomCategories = roomCategory::all();
		$buildingCategories = buildingCategory::all();
		$vehicleCategories = vehicleCategory::all();
		return view('pages.adminViewCategories',  array('user'=>$user, 'roomCategories' => $roomCategories, 'buildingCategories' => $buildingCategories, 'vehicleCategories' => $vehicleCategories)); 
	}

}
