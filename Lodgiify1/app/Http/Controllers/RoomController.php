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

		//Save room for user
		$room = new roomModel;
		$room-> buildingID = $building  ;
		$room-> roomCatID = $category;
		$room-> desc = $desc ;
		$room-> capacity = $capacity;
		$room-> price = $price;
		$room-> roomName = $roomName;
		$room-> roomName = $roomName;
		$room-> landlordID = $user[0]->ID; 

		$room->save();
		Session::flash('success', 'Room successfully registered'); 

		return Redirect::to('addRoom');
	}


	public function delete(Request $request){
		if ($request['id'] != null){
			$buildings = roomModel::where('id', '=', $request['id'])->delete();
		}
		print json_encode(array(1));
	}	


	// update room
	public function update(Request $request){
		//$categories = buildingCategory::all();

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
		$room-> capacity = $roomprice ;
		$room-> capacity = $roomcapacity ;

		$room->save();
		Session::flash('success', 'Room successfully updated'); 
		print json_encode(array(1));
	}

	
}