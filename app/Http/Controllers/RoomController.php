<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request as RequestStatic;
use Illuminate\Http\Request;


use App\User as User;
use App\roomModel as roomModel;
use Input ;
use Session;
use DB;
use Redirect;
use App\roomFacilityModel as roomFacilityModel;
use App\facilityModel as facilityModel;
use App\roomBookingModel as roomBookingModel;


 class RoomController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	// Add room
	public function register(Request $request){

	
		$user = $request->session()->get('user');
	
		if ((isset($request['roomName'])) && (!empty($request['roomName'])) ){
			$roomName = $request['roomName'];
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

		if ((isset($request['roomName'])) && (!empty($request['roomName'])) ){
				$roomName = $request['roomName'];
		}
		
		if ((isset($request['price'])) && (!empty($request['price'])) ){
				$price = $request['price'];
		}

		if ((isset($request['facilityCheckboxes'])) && (!empty($request['facilityCheckboxes'])) ){
				$facilityCheckboxes = $request['facilityCheckboxes'];




		
		}


		$uploadMsg = "";

	


		/*$fileName = '';
		if (RequestStatic::hasFile('image')  && RequestStatic::file('image')-> isValid() )
		{
		   $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		   $fileName = rand(11111,99999).'.'.$extension; // renameing image
		   $name = $this->destinationPath ;
		   
		   RequestStatic::file('image')->move($name,  $fileName );
		}*/

	

		// Retrieve use session

		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}

		//Save room for user
		$room = new roomModel;
		$room-> buildingID = $building  ;
		$room-> roomCatID = $category;
		$room-> desc = $desc ;
		$room-> capacity = $capacity;
		$room-> price = $price;
		$room-> roomName = $roomName;
		$room-> roomName = $roomName;
		$room-> landlordID = $user[0]->id; 

		$room->save();
		Session::flash('success', 'Room successfully registered'); 
//var_dump($room->id);die;



	foreach($facilityCheckboxes as $facilityCheckbox){

			$facility = new roomFacilityModel;
			$facility-> facilityid = $facilityCheckbox;
			$facility-> roomid = $room->id;
			$facility->save();

			//var_dump($facilityCheckboxes[0]);

		}



		return Redirect::to('addRoom');
	}


	public function delete(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		if ($request['id'] != null){
			$rooms = roomModel::where('id', '=', $request['id'])->delete();

			roomFacilityModel::where("roomid","=",$request['id'])->delete();

			roomBookingModel::where("roomid","=",$request['id'])->delete();


		}


		
			
		print json_encode(array(1));
	}	




	// update room
	public function update(Request $request){
		//$categories = buildingCategory::all();
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		if ((isset($request['roomid'])) && (!empty($request['roomid'])) ){
			$roomid = $request['roomid'];
		}

		if ((isset($request['roomdesc'])) && (!empty($request['roomdesc'])) ){
				$roomdesc = $request['roomdesc'];
		}
		if ((isset($request['roomprice'])) && (!empty($request['roomprice'])) ){
				$roomprice = $request['roomprice'];
		}
		if ((isset($request['roomcapacity'])) && (!empty($request['roomcapacity'])) ){
				$roomcapacity = $request['roomcapacity'];
		}
		
		// Retrieve user session
		$user = $request->session()->get('user');

		//Save room for user
		$room = roomModel::find($roomid);
		$room-> desc = $roomdesc ;
		$room-> price = $roomprice ;
		$room-> capacity = $roomcapacity ;

		$room->save();
		Session::flash('success', 'Room successfully updated'); 

		

		print json_encode(array(1));
	}



	
	function addRoomFacility(Request $request){

			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}
			$error=1;
			$messge  = array(
			   
			);


			if ((isset($_REQUEST['ddlAddRoomFacility'])) && (!empty($_REQUEST['ddlAddRoomFacility'])) ){
					$ddlAddRoomFacility = $_REQUEST['ddlAddRoomFacility'];

				}

			if ((isset($_REQUEST['AddfacilityCheckboxes'])) && (!empty($_REQUEST['AddfacilityCheckboxes'])) ){
					$AddfacilityCheckboxes = $_REQUEST['AddfacilityCheckboxes'];

				}


			$roomFacilities = roomFacilityModel::where('roomid', '=',$ddlAddRoomFacility)
	                    ->get();
	                    
$facilities  = array(
			   
						);
			foreach($AddfacilityCheckboxes as $facilityCheckbox){
					$messgeTmp  = array(
			   
						);

					 $facilityExists = $this->checkFacilityExists($roomFacilities, $facilityCheckbox);
					 if(!empty($roomFacilities) && $facilityExists[0]) {



					 	$messgeTmp['status'] = -1;
					 	$messgeTmp['msg'] = $facilityExists[1] ." facility Already exists";
					 	

					 }
				

					 else{


						$facility = new roomFacilityModel;
						$facility-> facilityid = $facilityCheckbox;
						$facility-> roomid = $ddlAddRoomFacility;
						$facility->save();


						$room = roomModel::where('id','=', $ddlAddRoomFacility)->get();
						$fac = facilityModel::where('id','=', $facilityCheckbox)->get();
						
						
						$facility['facility']= $fac;
						$facility['room']= $room;



						$messgeTmp['status'] = 1;
					 	$messgeTmp['msg'] = "Facility Successfully added";
					 	$messgeTmp['facility'] = $facility;


						//return redirect()->action('LandlordController@addRoom');
					 	array_push($facilities, $facility);
				}
					

				array_push($messge, $messgeTmp);
					
				
			}


			echo json_encode($messge);

	}



	private function checkFacilityExists($roomFacilities, $idFacility){
		foreach ($roomFacilities as $roomFacility ) {
			if ( $idFacility == $roomFacility->facilityid ){
				
				return array(true, $roomFacility->facility->name);
			}
		}
		return array(false,"");
	}

	function deleteRoomFacility(Request $request){
			$user = $request->session()->get('user');
			if (is_null($user)){
				return false;
			}

			if ($request['id'] != null){
			$deleteRoomFacility = roomFacilityModel::where('id', '=', $request['id'])->delete();
			return redirect()->action('LandlordController@addBuilding');
		}
			print json_encode(array(1));

	}

	
}