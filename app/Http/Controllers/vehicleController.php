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
use App\vehicleCategory as vehicleCategory;
use App\vehicleModel as vehicleModel;
use Input ;
use Session;
use DB;
use Redirect;
use App\travelModel as travelModel;
use App\vehicleBooking as vehicleBooking;




 class vehicleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $destinationPath = 'upload';

	// Add building
	public function register(Request $request){
		$user = $request->session()->get('user');
		
		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		$categories = vehicleCategory::all();


		if ((isset($request['name'])) && (!empty($request['name'])) ){
			$name = $request['name'];
		}

		if ((isset($request['category'])) && (!empty($request['category'])) ){
				$category = $request['category'];
		}
		if ((isset($request['models'])) && (!empty($request['models'])) ){
				$models = $request['models'];
		}
		
		if ((isset($request['color'])) && (!empty($request['color'])) ){
				$color = $request['color'];
		}

		if ((isset($request['numOfSeats'])) && (!empty($request['numOfSeats'])) ){
				$numOfSeats = $request['numOfSeats'];
		}

		if ((isset($request['transmission'])) && (!empty($request['transmission'])) ){
				$transmission = $request['transmission'];
		}


		if ((isset($request['price'])) && (!empty($request['price'])) ){
				$price = $request['price'];
		}
		if ((isset($request['driver'])) && (!empty($request['driver'])) ){
				if(($request['driver']) == 'true')
				{
					$driver = 1;
				}
				else
				{
					$driver = 0;
				}
				
		}
		if ((isset($request['price'])) && (!empty($request['price'])) ){
				$price = $request['price'];
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
		   $nameF = $this->destinationPath ;
		   
		   RequestStatic::file('image')->move($nameF,  $fileName );
		}

	
		
		// Retrieve user session
		$user = $request->session()->get('user');

		//Save vehicles for specific user
		$vehicle = new vehicleModel;
		$vehicle-> vehicleOwnerID = $user[0]->id; 
		$vehicle-> vehicleName = $name ;
		$vehicle-> color = $color ;
		$vehicle-> numOfSeats = $numOfSeats ;
		$vehicle-> transmission = $transmission;
		$vehicle-> image = $fileName;
		$vehicle-> models = $models;
		$vehicle-> vehicleCatID = $category;		
		$vehicle-> price = $price;
		$vehicle-> driver = $driver;
		$vehicle-> description = $desc;		

		$vehicle->save();
		Session::flash('success', 'vehicle successfully registered'); 

		return Redirect::to('addVehicle');
	}


	public function viewVehicle(Request $request)
	{
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type=='vehicleowner')
		{
			//Gets vehicles
			$vehicles = vehicleModel::where('vehicleOwnerID', '=', $user[0]->id)->get();

			return view('pages.vehicleOwnerVehicles',  array('user' => $user, 'vehicles' => $vehicles));
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

		if ($request['id'] != null)
		{
			$vehicles = vehicleModel::where('id', '=', $request['id'])->delete();
			
			$travels = travelModel::where('vehicleID', '=', $request['id'])->delete();

			$vehicleBooking = vehicleBooking::where('vehicleID', '=', $request['id'])->delete();
		}
		print json_encode(array(1));
	
	}	



	// update vehicle
	public function update(Request $request){
		//$categories = buildingCategory::all();
		$color = "";
		$vehicleid = "";


		$error = false;
		if ((isset($request['color'])) && (!empty($request['color'])) ){
				$color = $request['color'];
		}

		if ((isset($request['vehicleid'])) && (!empty($request['vehicleid'])) ){
				$vehicleid = $request['vehicleid'];
		}
		


		// Retrieve use session
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		//Save vehicle for user
		$vehicle = vehicleModel::find($vehicleid);


		$vehicle-> color = $color ;
		
		$vehicle->save();


		Session::flash('success', 'vehicle successfully updated'); 
		print json_encode(array(1));
	}
}