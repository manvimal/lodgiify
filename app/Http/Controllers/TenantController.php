<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;

use App\User as User;
use App\vehicleOwner as vehicleOwner;
use App\userLandlord as userLandlord;
use App\UserAdmin as UserAdmin;
use App\BuildingCategory as buildingCategory;
use App\RoomCategory as roomCategory;
use App\buildingModel as buildingModel;
use App\roomModel as roomModel;
use App\tenantModel as tenantModel;
use App\bookingModel as bookingModel;
use App\buildingFacilityModel as buildingFacilityModel;
use App\facilityModel as facilityModel;
 







 class tenantController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



	// Rent a room
	public function rentRoomVehicles(Request $request){
		$user = $request->session()->get('user');

		//Gets building categories
		$buildingCategories = buildingCategory::all();
	//	$buildings = buildingModel::where('landlordID', '=', $user[0]->ID)->get();

		//return view('pages.landlordAddBuilding',  array('categories' => $categories,'user' => $user, 'buildings' => $buildings));

		//Gets buildings
		$buildings = buildingModel::where('created_at', '!=', '')->orderBy('created_at', 'DESC')->get();

		
		$buildingFacAr = array();
		foreach($buildings as $building){

			//$buildingFacilities = buildingFacilityModel::where('buildingid', '=', $building->id)->get();
			$buildingFacilities = buildingFacilityModel::where('buildingid', '=', $building->id)->get();
//
			array_push($buildingFacAr , $buildingFacilities );

		}

		$Facilities = facilityModel::all();

		//return view('pages.landlordbuildings',  array('user' => $user, 'buildings' => $buildings));

		return view('pages.bestDeals',  array('user' => $user, 'Facilities'=>$Facilities, 'buildings' => $buildings,'buildingCategories'=>$buildingCategories,'buildingFacilities'=>$buildingFacAr));


	}


	// Get my bookings
	public function myBookings(Request $request){
		$user = $request->session()->get('user');

		$bookings = bookingModel::where('tenantID', '=', $user[0]->ID)->orderBy('created_at', 'DESC')->get();

		return view('pages.mybookings',  array('user' => $user, 'bookings' => $bookings));


	}
	

		public function getDirections(Request $request){
			$lat = $_REQUEST['lattitude'];
			$long = $_REQUEST['longitude'];


		$user = $request->session()->get('user');
		return view('pages.tenantGetDirections',  array('user' => $user));

		
	

	}


	public function viewBookingPDF(Request $request){

		include(app_path() . '\fpdf\fpdf.php');

		//require(app_path().'/Http/Controllers/fpdf/fpdf.php');

		if ((isset($_REQUEST['id'])) && (!empty($_REQUEST['id'])) ){
			$id = $_REQUEST['id'];


			//return view('pages.mybookings', ['booking' => bookingModel::findOrFail($id)] );
			$pdf=new \FPDF();

			$pdf->AddPage();

			$pdf->SetFont("Arial","B",20);
			$pdf->Cell(0,10,"Welcome to Lodgiify",1,1);
			$pdf->Cell(50,10,"FirstName :",1,0);
			//$pdf->Cell(50,10,$booking[0]->checkin ,1,1);


			$pdf->output();

			die;
		}

	}

	public function deleteBooking(Request $request){

		if ($request['id'] != null){
			$deleteBookings = bookingModel::where('id', '=', $request['id'])->delete();
			return redirect()->action('tenantController@myBookings');
		}
			print json_encode(array(1));
	
	}


	
	

	
}