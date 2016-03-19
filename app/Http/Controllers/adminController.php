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
use App\facilityModel as facilityModel;
use App\bookingModel as bookingModel;
use App\travelModel as travelModel;
use App\bookingPackageModel as bookingPackageModel;
use App\roomBookingModel as roomBookingModel;
use App\vehicleModel as vehicleModel;
use App\buildingFacilityModel as buildingFacilityModel;
use App\roomFacilityModel as roomFacilityModel;





 class adminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function viewUsers(Request $request){
		
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{
			 $tenants = User::all();
			 $landlords = userLandlord::all();
			 $vehicleowners = vehicleOwnerModel::all();
			return view('pages.adminViewUsers',  array('user'=>$user, 'tenants' => $tenants, 'landlords' => $landlords, 'vehicleowners' => $vehicleowners));
		}

		else
		{

			return redirect()->action('MainController@index');
		}
	}




	public function deleteTenant(Request $request){
			
			$user = $request->session()->get('user');

			if (is_null($user))
			{
				return redirect()->action('MainController@index');
			}

			elseif($user[0]->type=="admin")
			{

			if ($request['id'] != null)
			{
			$deleteTenant = User::where('id', '=', $request['id'])->delete();

			//Get all bookings

			//delete travel
			$bookings = bookingModel::where("tenantID","=",$request['id'])->get();

			foreach($bookings as $booking)
			{
				bookingPackageModel::where("booking_id","=",$booking->id)->delete();
				travelModel::where("bookingID","=",$booking->id)->delete();
				roomBookingModel::where("bookingId","=",$booking->id)->delete();
				
				$booking->delete();
			}


			//delete bookings
			// delete bookingpackage
			//delete roombooking
			//delete travel
				return redirect()->action('adminController@viewUsers');
			}
				print json_encode(array(1));
			}

		else
		{
			return redirect()->action('MainController@index');
		}
	}


	public function updateTenant(Request $request){






	}


	public function deleteLandlord(Request $request){
			
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}
			if ($_REQUEST['id'] != null){
				
					
				$buildings = buildingModel::where('landlordID', '=', $request['id'])->get();

				foreach($buildings as $building){
					// delete facilities
					$buildingFacilities = buildingFacilityModel::where("buildingid","=",$building->id)->delete();
					//delete room
					//delete room facilities
					//delete room booking
					$rooms = roomModel::where("buildingID","=",$building->id)->get();
					foreach($rooms as $room){
						roomFacilityModel::where("roomid","=",$room->id)->delete();

						roomBookingModel::where("roomid","=",$room->id)->delete();
						$room->delete();
					}

					//delete packages
					$packages = packageModel::where("buildingid","=",$building->id)->delete();


					//delete booking
					//delete travel
					$bookings = bookingModel::where("buildingID","=",$building->id)->get();
					foreach($bookings as $booking){
						bookingPackageModel::where("booking_id","=",$booking->id)->delete();
						travelModel::where("bookingID","=",$booking->id)->delete();
						
						$booking->delete();
					}

					$building->delete();
				}
		

			$deletelandlord = userLandlord::where('id', '=', $_REQUEST['id'])->delete();


			return redirect()->action('adminController@viewUsers');
		}
			print json_encode(array(1));
	
	}
   

   public function updateLandlord(Request $request){




		

	}




	public function deleteVehicleOwner(Request $request){
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}

			if ($request['id'] != null){
			$deletevehicleowner = vehicleOwnerModel::where('id', '=', $request['id'])->delete();
			
			$vehicles = vehicleModel::where('vehicleOwnerID', '=', $request['id'])->get();
			foreach($vehicles as $vehicle){
				$travels = travelModel::where('vehicleID', '=', $vehicle->id)->delete();
				$vehicle->delete();
			}
			
			return redirect()->action('adminController@viewUsers');
		}
			print json_encode(array(1));
	
	}
   

   public function updateVehicleOwner(Request $request){




		

	}


	 public function addCategoryPage(Request $request){
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{

			return view('pages.adminAddCategories',  array('user' => $user));
		}

		else
		{
			return redirect()->action('MainController@index');
		}		
	}




	public function addCategories(Request $request){
			$error=1;
			$messge  = array(
			    "status" => 0,
			);
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}

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

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		$roomCategories = roomCategory::all();
		$buildingCategories = buildingCategory::all();
		$vehicleCategories = vehicleCategory::all();
		return view('pages.adminViewCategories',  array('user'=>$user, 'roomCategories' => $roomCategories, 'buildingCategories' => $buildingCategories, 'vehicleCategories' => $vehicleCategories)); 
	}

	function deleteRoomCat(Request $request){
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}

			if ($request['id'] != null){
			$deleteRoomcat = roomCategory::where('id', '=', $request['id'])->delete();
			return redirect()->action('adminController@viewCategoryPage');
		}
			print json_encode(array(1));
	
	}



	function deleteBuildingCat(Request $request){
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}

			if ($request['id'] != null){
			$deleteBuildingCat = buildingCategory::where('id', '=', $request['id'])->delete();
			return redirect()->action('adminController@viewCategoryPage');
		}
			print json_encode(array(1));
	
	}


	function deleteVehicleCat(Request $request){
			
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}
			if ($request['id'] != null){
			$deletevehicleCat = vehicleCategory::where('id', '=', $request['id'])->delete();
			return redirect()->action('adminController@viewCategoryPage');
		}
			print json_encode(array(1));
	
	}



	public function addFacilityPage(Request $request){

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{
		$facilities = facilityModel::all();
		
		return view('pages.adminAddFacility',  array('user'=>$user, 'facilities'=>$facilities)); 
		}

		else
		{
			return redirect()->action('MainController@index');
		}

	}


	public function addFacilities(Request $request){
			$error=True;
			$messge  = array(
			    "status" => 0,
			);


		if ((isset($request['facilityName'])) && (!empty($request['facilityName'])) ){
			$facilityName = $request['facilityName'];
			$error=false;
		}
		else{
			$error=true;

		}

		if ((isset($request['facilityType'])) && (!empty($request['facilityType'])) ){
				$facilityType = $request['facilityType'];
				$error=false;
		}
		else{
			$error=true;

		}
	
		if($error==false){

		$facilityNameCheck = DB::table('tblfacility')
	                    ->select(DB::raw('*'))
	                    ->where('name', '=', $facilityName)
	                    ->get();

	                     
				
			if(!empty($facilityNameCheck)) {
			$messge['status'] = -1;
			$messge['msg'] = "Already exists";

			}


			else{

					//Save vehicles for specific user
					$facility = new facilityModel;
					$facility-> name = $facilityName; 
					$facility-> type = $facilityType ;
					

					$facility->save();


					return Redirect::to('addFacilityPage');
							
				}
				echo json_encode ($messge);

			}

	}

	public function deleteFacility(Request $request){
			
			$user = $request->session()->get('user');
			if (is_null($user))
			{
				return false;
			}

			elseif($user[0]->type=="admin")
			{
				if ($_REQUEST['id'] != null)
				{
					$deletFacility = facilityModel::where('id', '=', $request['id'])->delete();
					return redirect()->action('adminController@addFacilityPage');
				}
					print json_encode(array(1));
			}

			else
			{
				return redirect()->action('adminController@viewCategoryPage');
			}

	}

	public function updateFacilityPage(Request $request)
	{

		$user = $request->session()->get('user');

		if(isset($_REQUEST['id'])) 
			{
				$facilityid = $_REQUEST['id'];
			
			}


		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}


		elseif($user[0]->type=="admin")
		{
			$facility = facilityModel::where('id', '=', $facilityid)->get();

			return view('pages.adminUpdateFacility',  array('user' => $user, 'facility'=>$facility));
		}

		else
		{
			return redirect()->action('MainController@index');
		}

	
	}

	public function updateFacility(Request $request){

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{

			if((isset($_REQUEST['facilityType'])) && (isset($_REQUEST['idText'])))  
				{
					$facilityType = $_REQUEST['facilityType'];
					$idText = $_REQUEST['idText'];

				}

					$facilityUpdate = facilityModel::find($idText);

					$facilityUpdate-> type = $facilityType ;

					$facilityUpdate->save();

					return Redirect::to('/addFacilityPage');
		}

		else
		{
			return redirect()->action('MainController@index');
		}
	}


	function updateRoomCatPage(Request $request){

		if(isset($_REQUEST['id'])) {
			$roomcatId = $_REQUEST['id'];
		
		}

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{
			$roomCat = roomCategory::where('id', '=', $roomcatId)->get();

			return view('pages.adminUpdateCategories',  array('user' => $user, 'roomCat'=>$roomCat));	
		}

		else
		{
			return redirect()->action('MainController@index');
		}

		
	}

	function updateBuildingCatPage(Request $request){

		if(isset($_REQUEST['id'])) {
			$buildingcatId = $_REQUEST['id'];
		
		}

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{
			$buildingCat = buildingCategory::where('id', '=', $buildingcatId)->get();

			return view('pages.adminUpdateCategories',  array('user' => $user, 'buildingCat'=>$buildingCat));	
		}

		else
		{
			return redirect()->action('MainController@index');
		}
		
	}

	function updateVehicleCatPage(Request $request){
			if(isset($_REQUEST['id'])) {
			$vehiclecatId = $_REQUEST['id'];
		
		}

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{
			$vehicleCat = vehicleCategory::where('id', '=', $vehiclecatId)->get();

			return view('pages.adminUpdateCategories',  array('user' => $user, 'vehicleCat'=>$vehicleCat));	
		}

		else
		{
		return redirect()->action('MainController@index');
		}
	
		
	}



	function updateCategories(Request $request){
	
		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}


		if((isset($_REQUEST['roomCatName'])) && (!empty($_REQUEST['roomCatName'])) && (isset($_REQUEST['roomCategoryID'])) && (!empty($_REQUEST['roomCategoryID'])))  {
			$roomCatName = $_REQUEST['roomCatName'];
			$roomCategoryID = $_REQUEST['roomCategoryID'];

		

		$roomCatNameUpdate = roomCategory::find($roomCategoryID);

		$roomCatNameUpdate-> roomCatName = $roomCatName ;

		$roomCatNameUpdate->save();

		return Redirect::to('/viewCategoryPage');
	}

	
		if((isset($_REQUEST['buildingcatName'])) && (!empty($_REQUEST['buildingcatName'])) && (!empty($_REQUEST['buildingCategoryID'])) && (isset($_REQUEST['buildingCategoryID'])))  {
			$buildingcatName = $_REQUEST['buildingcatName'];
			$buildingCategoryID = $_REQUEST['buildingCategoryID'];

		

		$buildingcatNameUpdate = buildingCategory::find($buildingCategoryID);

		$buildingcatNameUpdate-> buildingCatName = $buildingcatName ;

		$buildingcatNameUpdate->save();

		return Redirect::to('/viewCategoryPage');
	}



		else  {
			$vehiclecatName = $_REQUEST['vehiclecatName'];
			$vehicleCategoryID = $_REQUEST['vehicleCategoryID'];

		

		$vehiclecatNameUpdate = vehicleCategory::find($vehicleCategoryID);

		$vehiclecatNameUpdate-> vehiclecatnameType = $vehiclecatName ;

		$vehiclecatNameUpdate->save();

		return Redirect::to('/viewCategoryPage');
	}



	}


	function tenantUpdatePage(Request $request){
		if(isset($_REQUEST['id'])) {
			$tenantID = $_REQUEST['id'];
		
		}

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="admin")
		{
		$tenant = User::where('id', '=', $tenantID)->get();

		return view('pages.adminUpdateUsers',  array('user' => $user, 'tenant'=>$tenant));	
		}

		else
		{
			return redirect()->action('MainController@index');
		}

	}

	function blockUsers(Request $request){
		if((isset($_REQUEST['id'])) && isset($_REQUEST['type'])){
			$id = $_REQUEST['id'];
			$type = $_REQUEST['type'];


		
		}
		$user = $request->session()->get('user');
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}



		if($type=="Landlord"){

			$checkBlockedStatus = userLandlord::where('id','=', $id)->get();



			if($checkBlockedStatus[0]->userStatus == 0 ){



				$landlord = userLandLord::find($id);

				$landlord-> userStatus = '1' ;

				$landlord->save();


			}
			else{
				$landlord = userLandLord::find($id);

				$landlord-> userStatus = '0' ;

				$landlord->save();


			}


			}

		


		
		elseif($type=="tenant"){


			$checkBlockedStatus = User::where('id','=', $id)->get();



			if($checkBlockedStatus[0]->userStatus == 0 ){



				$tenant = User::find($id);

				$tenant-> userStatus = '1' ;

				$tenant->save();


			}
			else{
				$tenant = User::find($id);

				$tenant-> userStatus = '0' ;

				$tenant->save();


			}


		}
		elseif($type=="vehicleowner"){


			$checkBlockedStatus = vehicleOwnerModel::where('id','=', $id)->get();



			if($checkBlockedStatus[0]->userStatus == 0 ){



				$vehicleowner = vehicleOwnerModel::find($id);

				$vehicleowner-> userStatus = '1' ;

				$vehicleowner->save();


			}
			else{
				$vehicleowner = vehicleOwnerModel::find($id);

				$vehicleowner-> userStatus = '0' ;

				$vehicleowner->save();


			}

		}

		return redirect()->action('adminController@viewUsers');

	}

	function manageBuilding(Request $request){

		$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		//Gets buildings
		elseif($user[0]->type == "admin"){

			$buildings = buildingModel::all();

			return view('pages.adminManageBuildings',  array('user'=>$user, 'buildings' => $buildings));


		}
		else{

			return redirect()->action('MainController@index');
		}
		
	}

	function managePackage(Request $request){

			$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type == "admin"){
			$packages = packageModel::all();

			$buildings = buildingModel::all();

			return view('pages.adminManagePackages',  array('user'=>$user,'buildings' => $buildings ,'packages' => $packages));

		}
		else
		{
			return redirect()->action('MainController@index');
		}
	}

	function manageVehicles(Request $request){

		$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type == "admin")
		{
			//Gets all vehicles
			$vehicles = vehicleModel::all();

			return view('pages.adminManageVehicles',  array('user' => $user, 'vehicles' => $vehicles));
		}

		else
		{
			return redirect()->action('MainController@index');
		}
	
	}



}
