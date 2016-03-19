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
use App\buildingFacilityModel as buildingFacilityModel;
use App\travelModel as travelModel;
use App\packageModel as packageModel;






 class SearchController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	//Loads the search
	public function search(Request $request){
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}

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
			else if($action == "availabilityVehicle"){
				$result = json_encode ($this->getQueryAvailableVehicles($request));
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


		foreach($buildings as $building){
			$package = packageModel::where('buildingid', '=', $building->id)->get();
			$building['packages'] = $package;
		}
		return $buildings;
	}

	//Query to search all vehiclers based on different filters
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
			if (!$initialised && isset($request['vehicleOwnerID'])){
				$query = vehicleModel :: where ('vehicleOwnerID','=',$request['vehicleOwnerID']);
				$initialised = true;
			}
			
		}

		//Search by buildingcategory
		if($request['category'] != null && $initialised ){
			$query->where('category','=',$request['category']);
		}
		else{
			if (!$initialised && isset($request['category'])){
				$query = vehicleModel :: where ('vehicleCatID','=',$request['category']);
				$initialised = true;
			}
		}

		//Search by desc
		if($request['name'] != null && $initialised ){
			$query->where('name','LIKE',  "%".$request['name']."%");
		}
		else{
			if (!$initialised && isset($request['name'])){
				$query = vehicleModel :: where ('name','LIKE', "%".$request['name']."%");
				$initialised = true;
			}
		}

		//Search by buildingcategory
		if($request['numOfSeats'] != null && $initialised ){
			$query->where('numOfSeats','LIKE', "%".$request['numOfSeats']."%");
		}
		else{
			if (!$initialised && isset($request['numOfSeats'])){
				$query = buildingModel :: where ('numOfSeats','LIKE', "%".$request['numOfSeats']."%");
				$initialised = true;
			}
		}

		//limit query 
		if($request['limit'] != null &&  $query != ''){
			$query->take($request['limit']);
		}
		

		if ($initialised){
			$vehicles = $query->get();
		}else{
			$vehicles= vehicleModel :: get();
		}
		
		return $vehicles;

	}



	//Get if vehicle is available
	private function getQueryAvailableVehicles(Request $request){
		$initialised  = false;
		$query = '';

		//Search by id
		if ($request['id'] != null){
			$query = travelModel :: where ('id' , '=' , $request['id']);

			$initialised = true;
		}

		//Search by checkin
		if($request['vehicleid'] != null && $initialised ){
			$query->where('vehicleID','=',$request['vehicleid']);
		}
		else{
			if (!$initialised && isset($request['vehicleid'])){
				$query = travelModel :: where ('vehicleID','=',$request['vehicleid']);
				$initialised = true;
			}
			
		}

		

		//limit query 
		if($request['limit'] != null &&  $query != ''){
			$query->take($request['limit']);
		}
		

		if ($initialised){
			$vehicles = $query->get();
		}else{
			$vehicles= vehicleModel :: get();
		}



		//Check if greater than today
		$errorMessage = "";

		$checkIn =  new \DateTime($request['checkin']);
		$checkOut =  new \DateTime($request['checkout']);
		$dispatch =  $request['dispatch'];

		$error = false;

		foreach ($vehicles as $vehicle) {
			$checkInVehicle =  new \DateTime($vehicle->pickUpTime1);
			$checkOutVehicle =  new \DateTime($vehicle->pickUpTime2);

			$checkInVehicle1h =  new \DateTime($vehicle->pickUpTime1);
			$checkOutVehicle1h =  new \DateTime($vehicle->pickUpTime2);

			$checkInVehicle1h->add(new \DateInterval('PT1H'));
			$checkOutVehicle1h->add(new \DateInterval('PT1H'));

			$dispatchvehicle =  $request['dispach'];

			
			if (($checkIn >= $checkInVehicle ) && ($checkIn <= $checkInVehicle1h)){
				//Conflict in check in
				$errorMessage  = "A conflict in checkin time";
				$error = true;
			}
			elseif(($dispatch=='true' ) && ($checkOut >= $checkInVehicle ) && ($checkOut <= $checkInVehicle1h)){
				// Conflict in return journey
				$errorMessage  = "A conflict in checkout time";
				$error = true;
				

			}
			elseif($dispatchvehicle && ($checkIn >= $checkOutVehicle ) && ($checkIn <= $checkOutVehicle1h)){
				// Conflict in return journey
				$errorMessage  = "A conflict in checkin time";
				$error = true;
				
			}
			elseif($dispatchvehicle && $dispatch && ($checkOut >= $checkOutVehicle ) && ($checkOut <= $checkOutVehicle1h)){
				// Conflict in return journey
				$errorMessage  = "A conflict in checkout time";
				$error = true;
				
			}else{
				$errorMessage  = "No conflict in checkout time";
				
			}
			
		}
		
		return array('status'=>$error, 'msg'=>$errorMessage);

	}
	private function getQueryUsers(Request $request){


	}
	private function getQueryRooms(Request $request){


	}

	public function buildingSuggestion(Request $request){

		$user = $request->session()->get('user');

		if(isset($request['term'])){
		$searchTerm = $request['term'];
		}
	
		$buildings = buildingModel::where('buildingName','LIKE', $searchTerm.'%')->get();
	

		foreach($buildings as $building){

		 $buildingName[] = $building['buildingName'];

		}

		echo json_encode($buildingName);

	}

	public function getAdvancedSearch(Request $request){

		$error=False;

		
		if(isset($request['buildingName'])){
			$buildingName = $request['buildingName'];

		}
		else{
			$buildingName = False;
			$error=True;


		}

		if($error==False){


						if(isset($request['buildingLocation'])){
								
						$buildingLocation = $request['buildingLocation'];


						}

						else{
							$buildingLocation = False;

						}


						if((isset($request['buildingCat'])) && ($request['buildingCat'])!= -1){
					
							$buildingCat = $request['buildingCat'];
						

						}

						else{
							$buildingCat = False;


						}

						if((isset($request['buildingFacility'])) && ($request['buildingFacility'])!= -1){
					
							$buildingFacility = $request['buildingFacility'];
						//	var_dump($request['buildingFacility']);


						}

						else{

							$buildingFacility = False;


						}




								


						//foreach($buildingFacilities as $x){

						//	$a[]=$x->buildingid;
							
					//	}




						//var_dump($buildingFacility);
						//var_dump($buildingFacilities[0]);
					// /	var_dump($a);

						
			$buildings = buildingModel::where('buildingName','Like', $buildingName.'%')


							  ->Where(function($query) use ($buildingLocation, $buildingCat, $buildingFacility){

								if($buildingLocation){
							

									$query->where('buildingLocation', 'like', $buildingLocation .'%');

								}

								if($buildingCat) {
								

									$query->where('buildingCatID', 'like', $buildingCat .'%');

								}

								if($buildingFacility){



									$buildingFacilities = buildingFacilityModel::where('facilityid', '=', $buildingFacility)

																		->get();


										foreach($buildingFacilities as $buildingFacility){

										//$a[]=$buildingFacility->building->buildingName;
											$buildingFacilitiesArray[]=$buildingFacility->buildingid;
												//$query->where('id', '=', $buildingFacility->buildingid);
										
										
										//var_dump('<br />'.$buildingFacility->building->buildingName);
									}


									foreach($buildingFacilitiesArray as $buildingFacilityArray){
									

											$query->orwhere('id', '=', $buildingFacilityArray);

										
									}

							
               			
               			}
                     
            				})
  						  ->get();	


//var_dump($buildings);

//var_dump($request['buildingCat']);


//var_dump($buildings);
	}

		return json_encode($buildings);
	
	}



	public function getVehicleAdvancedSearch(Request $request){

		$error=False;

		
		if(isset($request['vehicleName'])){

			$vehicleName = $request['vehicleName'];

		}
		

						if(isset($request['vehicleCategory']) && ($request['vehicleCategory'])!= -1)
						{
								
						$vehicleCategory = $request['vehicleCategory'];

						}

						else{
							$vehicleCategory = False;

						}


						if((isset($request['driver'])) && ($request['driver'])!= -1){
					
							$driver = $request['driver'];
						//	var_dump($request['buildingFacility']);


						}

						else{

							$driver = False;


						}

						if(isset($request['price'])){
					
							$price = $request['price'];
						//	var_dump($request['buildingFacility']);


						}

						else{

							$price = False;


						}

						
						if((isset($request['transmission'])) && ($request['transmission'])!= -1)
						{
					
							$transmission = $request['transmission'];
						//	var_dump($request['buildingFacility']);


						}

						else
						{

							$transmission = False;

						}

						if((isset($request['numberOfSeats'])) && ($request['numberOfSeats'])!= -1)
						{
					
							$numberOfSeats = $request['numberOfSeats'];
						//	var_dump($request['buildingFacility']);


						}

						else
						{

							$numberOfSeats = False;

						}

						if(isset($request['checkIn']))
						{
					
							$checkIn = $request['checkIn'];
						
						}

						else
						{

							$checkIn = False;

						}
						if(isset($request['checkout']))
						{
					
							$checkout = $request['checkout'];
						//	var_dump($request['buildingFacility']);


						}

						else
						{

							$checkout = False;


						}

						
			$vehicles = vehicleModel::where('vehicleName','Like', $vehicleName.'%')


							  ->Where(function($query) use ($vehicleCategory, $driver, $transmission, $price, $numberOfSeats){

								if($vehicleCategory)
								{
							

									$query->where('vehicleCatID', 'like', $vehicleCategory .'%');

								}

								if($driver) 
								{
								

									$query->where('driver', 'like', $driver .'%');

								}
								if($transmission) 
								{
								

									$query->where('transmission', 'like', $transmission .'%');

								}
								if($price) 
								{
								
									$query->where('price', 'like', $price .'%');

								}

								if($numberOfSeats) 
								{
								
									$query->where('numOfSeats', 'like', $numberOfSeats .'%');

								}

								
                     
            				})
  						  ->get();	




//var_dump($request['buildingCat']);


//var_dump($buildings);
	

		return json_encode($vehicles);
	
	}
	
}