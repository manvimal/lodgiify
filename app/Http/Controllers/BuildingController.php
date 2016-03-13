<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request as RequestStatic;
use Illuminate\Http\Request;


use App\User as User;
use App\vehicleOwner as vehicleOwner;
use App\userLandlord as userLandlord;
use App\UserAdmin as UserAdmin;
use App\BuildingCategory as buildingCategory;
use App\buildingModel as buildingModel;
use Input ;
use Session;
use DB;
use Redirect;
use App\buildingFacilityModel as buildingFacilityModel;
use App\roomModel as roomModel;
use App\roomFacilityModel as roomFacilityModel;
use App\packageModel as packageModel;
use App\bookingModel as bookingModel;
use App\roomBookingModel as roomBookingModel;
use App\travelModel as travelModel;
use App\bookingPackageModel as bookingPackageModel;



 class BuildingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $destinationPath = 'upload';

	// Add building
	public function register(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		$categories = buildingCategory::all();

		if ((isset($request['buildingName'])) && (!empty($request['buildingName'])) ){
			$buildingName = $request['buildingName'];
		}
		if ((isset($request['lattitude'])) && (!empty($request['lattitude'])) ){
			$lattitude = $request['lattitude'];
		}
		if ((isset($request['longitude'])) && (!empty($request['longitude'])) ){
			$longitude = $request['longitude'];
		}

		if ((isset($request['category'])) && (!empty($request['category'])) ){
				$category = $request['category'];
		}
		if ((isset($request['location'])) && (!empty($request['location'])) ){
				$location = $request['location'];
		}
		
		if ((isset($request['desc'])) && (!empty($request['desc'])) ){
				$desc = $request['desc'];
		}

		if ((isset($request['facilityCheckboxes'])) && (!empty($request['facilityCheckboxes'])) ){
				$facilityCheckboxes = $request['facilityCheckboxes'];
		}


		$uploadMsg = "";


		$fileName = '';
		if (RequestStatic::hasFile('image')  && RequestStatic::file('image')-> isValid() )
		{
		   $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		   $fileName = rand(11111,99999).'.'.$extension; // renameing image
		   $name = $this->destinationPath ;
		   
		   RequestStatic::file('image')->move($name,  $fileName );
		}
		else
		{
			$fileName = 'nopreview.jpg';
		}


		
		// Retrieve user session
		$user = $request->session()->get('user');

		//Save building for user
		$building = new buildingModel;
		$building-> buildingName = $buildingName ;
		$building-> lattitude = $lattitude ;
		$building-> longitude = $longitude ;
		$building-> buildingLocation = $location ;
		$building-> buildingCatId = $category;
		$building-> landlordID = $user[0]->id; 
		$building-> desc = $desc ;
		$building-> image = $fileName;

		$building->save();
		Session::flash('success', 'Building successfully registered'); 


		foreach($facilityCheckboxes as $facilityCheckbox){

			$facility = new buildingFacilityModel;
			$facility-> facilityid = $facilityCheckbox;
			$facility-> buildingid = $building->id;
			$facility->save();

			//var_dump($facilityCheckboxes[0]);

		}

		return Redirect::to('addBuilding');
	}


	public function viewBuildings(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		//Gets buildings
		$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();

		

		return view('pages.landlordbuildings',  array('user' => $user, 'buildings' => $buildings));


	}


	public function delete(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		if ($request['id'] != null){


			$buildings = buildingModel::where('id', '=', $request['id'])->delete();


			// delete facilities
			$buildingFacilities = buildingFacilityModel::where("buildingid","=",$request['id'])->delete();
			


			

			//delete room
			//delete room facilities
			//delete room booking
			$rooms = roomModel::where("buildingID","=",$request['id'])->get();
			foreach($rooms as $room){
				roomFacilityModel::where("roomid","=",$room->id)->delete();

				roomBookingModel::where("roomid","=",$room->id)->delete();
				$room->delete();
			}

			


			//delete packages
			$packages = packageModel::where("buildingid","=",$request['id'])->delete();
			
			//delete booking
			//delete travel
			$bookings = bookingModel::where("buildingID","=",$request['id'])->get();
			foreach($bookings as $booking){
				bookingPackageModel::where("booking_id","=",$booking->id)->delete();
				travelModel::where("bookingID","=",$booking->id)->delete();
				
				$booking->delete();
			}
			

			
			
		}
		print json_encode(array());
	}	



	// update building
	public function update(Request $request){
		//$categories = buildingCategory::all();
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		if ((isset($request['buildingid'])) && (!empty($request['buildingid'])) ){
			$buildingid = $request['buildingid'];
		}

		if ((isset($request['buildingdesc'])) && (!empty($request['buildingdesc'])) ){
				$buildingdesc = $request['buildingdesc'];
		}
		if ((isset($request['buildingLocation'])) && (!empty($request['buildingLocation'])) ){
				$buildingLocation = $request['buildingLocation'];
		}
		
		// Retrieve use session
		$user = $request->session()->get('user');

		//Save building for user
		$building = buildingModel::find($buildingid);
		$building-> buildingLocation = $buildingLocation ;
		$building-> desc = $buildingdesc ;

		$building->save();
		Session::flash('success', 'Building successfully updated'); 
		print json_encode(array(1));
	}


	function addBuildingFacility(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		$error=1;
			$messge  = array(
			   
			);


			if ((isset($_REQUEST['ddlAddBuildingFacility'])) && (!empty($_REQUEST['ddlAddBuildingFacility'])) ){
					$ddlAddBuildingFacility = $_REQUEST['ddlAddBuildingFacility'];

				}

			if ((isset($_REQUEST['addBuildingFacilityCheckboxes'])) && (!empty($_REQUEST['addBuildingFacilityCheckboxes'])) ){
					$addBuildingFacilityCheckboxes = $_REQUEST['addBuildingFacilityCheckboxes'];

				}


			$buildingFacilities = buildingFacilityModel::where('buildingid', '=',$ddlAddBuildingFacility)->get();
	                    

			foreach($addBuildingFacilityCheckboxes as $addBuildingFacilityCheckbox){
					$messgeTmp  = array(
			   
						);

					 $facilityExists = $this->checkBuildingFacilityExists($buildingFacilities, $addBuildingFacilityCheckbox);

					 if(!empty($buildingFacilities) && $facilityExists[0]) {



					 	$messgeTmp['status'] = -1;
					 	$messgeTmp['msg'] = $facilityExists[1] ." facility Already exists";
					 	

					 }
				

					 else{


						$facility = new buildingFacilityModel;
						$facility-> facilityid = $addBuildingFacilityCheckbox;
						$facility-> buildingid = $ddlAddBuildingFacility;

						
						$facility->save();

						$messgeTmp['status'] = 1;
					 	$messgeTmp['msg'] = "Facility Successfully added";
						//return redirect()->action('LandlordController@addRoom');

				}
					

				array_push($messge, $messgeTmp);
					
				
			}


			echo json_encode($messge);

	}



	private function checkBuildingFacilityExists($buildingFacilities, $idFacility){
		foreach ($buildingFacilities as $buildingFacility ) {
			if ( $idFacility == $buildingFacility->facilityid ){
				
				return array(true, $buildingFacility->facility->name);
			}
		}
		return array(false,"");
	}



	function deleteBuildingFacility(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}

			if ($request['id'] != null){
			$deleteBuildingFacility = buildingFacilityModel::where('id', '=', $request['id'])->delete();
			return redirect()->action('LandlordController@addBuilding');
		}
			print json_encode(array(1));

	}

	
}

