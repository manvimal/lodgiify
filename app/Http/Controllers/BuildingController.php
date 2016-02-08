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



 class BuildingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $destinationPath = 'upload';

	// Add building
	public function register(Request $request){
		$user = $request->session()->get('user');
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

		$uploadMsg = "";


		$fileName = '';
		if (RequestStatic::hasFile('image')  && RequestStatic::file('image')-> isValid() )
		{
		   $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		   $fileName = rand(11111,99999).'.'.$extension; // renameing image
		   $name = $this->destinationPath ;
		   
		   RequestStatic::file('image')->move($name,  $fileName );
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
		$building-> landlordID = $user[0]->ID; 
		$building-> desc = $desc ;
		$building-> image = $fileName;

		$building->save();
		Session::flash('success', 'Building successfully registered'); 

		return Redirect::to('addBuilding');
	}


	public function viewBuildings(Request $request){
		$user = $request->session()->get('user');

		//Gets buildings
		$buildings = buildingModel::where('landlordID', '=', $user[0]->ID)->get();

		

		return view('pages.landlordbuildings',  array('user' => $user, 'buildings' => $buildings));


	}


	public function delete(Request $request){
		if ($request['id'] != null){
			$buildings = buildingModel::where('id', '=', $request['id'])->delete();
		}
		print json_encode(array(1));
	}	



	// update building
	public function update(Request $request){
		//$categories = buildingCategory::all();

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

	
}