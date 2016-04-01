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
use App\bookingPackageModel as bookingPackageModel;




 class packageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	
    // GET a package
	public function get(Request $request, $id)
	{
		$package = packageModel::where('id', '=', $id)->first();
		return $package;
	}

	public function registerPackage(Request $request){

		$user = $request->session()->get('user');

			$messge  = array(
		    "status" => 0,
			);

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="Landlord")
		{


			// Retrieve use session
				$user = $request->session()->get('user');

			$error = false;
	
			if ((isset($request['packageName'])) && (!empty($request['packageName'])) ){
				$packageName = $request['packageName'];
			}
			else
			{
				$packageName = '';
				$error = true;
			}

			if ((isset($request['category'])) && (!empty($request['category'])) ){
					$category = $request['category'];
			}
			else
			{
				$category = '';
				$error = true;
			}

			
			if ((isset($request['desc'])) && (!empty($request['desc'])) ){
					$desc = $request['desc'];
			}
			else
			{
				$desc = '';
				$error = true;
			}

			if ((isset($request['adultPrice'])) && (!empty($request['adultPrice'])) ){
					$adultPrice = $request['adultPrice'];
			}
			else
			{
				$adultPrice = '';
				//$error = true;
			}
			if ((isset($request['childrenPrice'])) && (!empty($request['childrenPrice'])) ){
					$childrenPrice = $request['childrenPrice'];
			}
			else
			{
				$childrenPrice = '';
				//$error = true;
			}

			if ((isset($request['building'])) && (!empty($request['building'])) || (($request['building'])!="-1") ){
					$building = $request['building'];
			}
			else
			{
				$building = '';
				$error = true;
			}

			if ((isset($request['oldPrice'])) && (!empty($request['oldPrice'])) ){
					$oldPrice = $request['oldPrice'];
			}
			else
			{
				$oldPrice = '';
			//	$error = true;
			}

			if ((isset($request['newPrice'])) && (!empty($request['newPrice'])) ){
					$newPrice = $request['newPrice'];
			}
			else
			{
				$newPrice = '';
			//	$error = true;
			}




					//$checkPackageExist = packageModel::where('packageName', '=', $packageName)->get();

					$checkPackageExist = DB::table('tblpackage')->where('packageName', $packageName)->get();

					if((isset($checkPackageExist)) && (!empty($checkPackageExist)))
					{

						$messge['status'] = -1;
					 	$messge['msg'] = "Package Name Already Exist";

				
					}

					else
					{
						if($error==false)
						{

						$package = new packageModel;
						$package-> buildingID = $building;
						$package-> roomCategoryID = $category;
						$package-> packageDesc = $desc ;
						$package-> adultPrice = $adultPrice;
						$package-> ChildPrice = $childrenPrice;
						$package-> newPrice = $newPrice;
						$package-> packageName = $packageName;
						$package-> oldPrice = $oldPrice;


							

						$package->save();

						$messge['status'] = 1;
						$messge['msg'] = "Successfully inserted";
					
						}
						else
						{
							$messge['status'] = -1;
							$messge['msg'] = "Failed, PLease recheck all fields";
						}
				
					}
				return json_encode($messge);
			
		}

		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}

	

	public function viewPackage(Request $request)
	{	

		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=="Landlord")
		{
			//Gets buildings
			$buildings = buildingModel::where('landlordID', '=', $user[0]->id)->get();

				//Gets packages of building
			$packages = packageModel::where('buildingid', '=', $buildings[0]->id)->get();

			//var_dump($packages[0]->id);

			return view('pages.landlordpackages',  array('user' => $user, 'packages' => $packages, 'buildings' => $buildings));

		}

		else
		{
			
			return redirect()->action('MainController@index');
		}
		


	}


	public function delete(Request $request)
	{
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return false;
		}

		if ($request['id'] != null){
			$buildings = packageModel::where('id', '=', $request['id'])->delete();
			bookingPackageModel::where('package_id', '=', $request['id'])->delete();
		}
		print json_encode(array(1));
	}

	public function update(Request $request)
	{
		
		if ((isset($request['roomid'])) && (!empty($request['roomid'])) ){
			$roomid = $request['roomid'];
		}

		if ((isset($request['packagedesc'])) && (!empty($request['packagedesc'])) ){
				$packagedesc = $request['packagedesc'];
		}
		if ((isset($request['roomprice'])) && (!empty($request['roomprice'])) ){
				$roomprice = $request['roomprice'];
		}
		if ((isset($request['roomcapacity'])) && (!empty($request['roomcapacity'])) ){
				$roomcapacity = $request['roomcapacity'];
		}
		
		// Retrieve user session
		$user = $request->session()->get('user');

		if (is_null($user)){
			return false;
		}
		//Save room for user
		$room = roomModel::find($roomid);
		$room-> packagedesc = $packagedesc ;
		$room-> capacityAdult = $capacityAdult ;
		
		$room->save();
		Session::flash('success', 'Package successfully updated'); 
		print json_encode(array(1));

	}

	public function getbuildingCat(Request $request)
	{

		$error = false;

		if(isset($request['building']))
		{
			$buildingid = $request['building'];
		}

		else
		{
			$error = true;
			$buildingid = false;
		}


		$building = buildingModel::where('id','=', $buildingid)->get();

		$buildingCatName = $building[0]->category->buildingCatName;


		json_encode($buildingCatName);

	}


}
