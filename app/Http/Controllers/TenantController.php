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
 use App\bookingPackageModel as bookingPackageModel;
 use App\travelModel as  travelModel;
 use App\roomBookingModel as  roomBookingModel;
 use App\vehicleModel as vehicleModel;
  use App\vehicleCategory as vehicleCategory;

 use App\vehicleBookingModel as vehicleBookingModel;







 class tenantController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



	// Rent a room
	public function rentRoomVehicles(Request $request){
		$user = $request->session()->get('user');



		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		else if($user[0]->type == 'tenant')
		{
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
	
				array_push($buildingFacAr , $buildingFacilities );

			}

			$Facilities = facilityModel::all();

			//return view('pages.landlordbuildings',  array('user' => $user, 'buildings' => $buildings));

			return view('pages.bestDeals',  array('user' => $user, 'Facilities'=>$Facilities, 'buildings' => $buildings,'buildingCategories'=>$buildingCategories,'buildingFacilities'=>$buildingFacAr));
		}

		else
		{

			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}


	// Get my bookings
	public function myBookings(Request $request)
	{
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type == 'tenant')
		{

			$bookings = bookingModel::where('tenantID', '=', $user[0]->id)->orderBy('created_at', 'DESC')->get();

			return view('pages.mybookings',  array('user' => $user, 'bookings' => $bookings));
		}
		
		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}
	

		public function getDirections(Request $request){

			if(isset($_REQUEST['lattitude']))
			{
				$lat = $_REQUEST['lattitude'];
			}

			else
			{
				$lat=false;
			}

			if(isset($_REQUEST['longitude']))
			{
				$long = $_REQUEST['longitude'];
			}

			else
			{
				$long=false;
			}
			


			$user = $request->session()->get('user');

			if (is_null($user))
			{
				return redirect()->action('MainController@index');
			}
			elseif($user[0]->type == 'tenant')
			{
				return view('pages.tenantGetDirections',  array('user' => $user));
			}
			else
			{
				return response()->view('pages.404', ['user'=>$user], 404);
			}
		
	

	}


	public function viewBookingPDF(Request $request){

	$error=true;
	$user = $request->session()->get('user');
	
		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}


		elseif($user[0]->type=="tenant")
		{

			if(isset($request['id']))
			{

				$bookingid= $request['id'];
				$error=false;
			}

			else
			{
				$bookingid= false;
				$error=true;

			}

			if($error == false){

				$bookings = bookingModel::where('id', '=', $bookingid)->get();

				foreach($bookings as $booking){




				foreach($booking->packages as $book)
				{

					foreach($book as $books)
					{

					}
				

				}

			}

			$buildingName = $book->building->buildingName;
			$buildingLocation = $book->building->buildingLocation;
			$buildingImage = $book->building->image;
			$buildingCaTID = $book->building->category->buildingCatName;


			include(app_path() . '\fpdf\fpdf.php');


			if ((isset($_REQUEST['id'])) && (!empty($_REQUEST['id'])) )
			{
				$id = $_REQUEST['id'];

				$pdf=new \FPDF();

				$pdf->AddPage();

				$pdf->Rect(5, 5, 200, 287, 'D'); //For A4

				$pdf->SetFont("Arial","B",30);
				$pdf->SetFillColor(36, 96, 84);
				
				$pdf->write(6, $pdf->Image('images/logo.png',145,10,-100),1,1);


				$pdf->SetFont("Arial","B",8);
				$pdf->Ln( 30 );

				$pdf->Cell(135);
				$pdf->Write( 10, "Phone: 2612205/57139151" );
				$pdf->Ln( 10 );
				$pdf->Cell(135);
				$pdf->Write( 10, "Email: Lokeshpravin@gmail.com" );
		


				$pdf->SetFont("Arial","B",30);
				$pdf->Write( 10, "Welcome to Lodgiify" );
				$pdf->Ln( 20 );

				$pdf->SetFont("Arial","B",12);
				$pdf->Cell(20);
				$pdf ->MultiCell(25,6,"Booking Form:", 'LRT', 'L', 0);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Full Name :",1,0);
				$pdf->Cell(75,10,$user[0]->FirstName . ' ' .  $user[0]->LastName,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Check In :",1,0);
				$pdf->Cell(75,10,$bookings[0]->checkin,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Check Out :",1,0);
				$pdf->Cell(75,10,$bookings[0]->checkOut,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Price :",1,0);
				$pdf->Cell(75,10,'Rs' . $bookings[0]->price,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Building Name :",1,0);
				$pdf->Cell(75,10,$buildingName,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Building Type :",1,0);
				$pdf->Cell(75,10,$buildingCaTID,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Building Location : ",1,0);
				$pdf->Cell(75,10,$buildingLocation,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,60,"Image : ",1,0);
				$pdf->Cell(75,60, $pdf->Image('upload'."/".$buildingImage, 118,167,50,50), 1,1);
				

				$pdf->Ln( 45 );
				$pdf->SetFont("Arial","B",10);
				$pdf->Cell(155);
				$pdf->Cell(0, 5, "Page " . $pdf->PageNo(),  0, 1);
				
				$pdf->output();
				die;
				}
			}
		}
	else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}

	public function deleteBooking(Request $request)
	{
		$user = $request->session()->get('user');
		if (is_null($user)){
			return false;
		}
		if ($request['id'] != null){
			$deleteBookings = bookingModel::where('id', '=', $request['id'])->delete();

			$deletePackageModel = bookingPackageModel::where("booking_id","=", $request['id'])->delete();

			$travelModel= travelModel::where("bookingID",'=', $request['id'])->delete();

			roomBookingModel::where("bookingId","=",$request['id'])->delete();

			//return redirect()->action('tenantController@myBookings');
		}
			print json_encode(array(1));
	
	}


	public function vehicleBooking(Request $request)
	{

		$user = $request->session()->get('user');

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}

		else if($user[0]->type == 'tenant')
		{
			

		
			$vehicles = vehicleModel::where('created_at', '!=', '')->orderBy('created_at', 'DESC')->paginate(9);

			$vehicleCategories = vehicleCategory::all();

			return view('pages.tenantBookVehicles',  array('user' => $user, 'vehicles'=>$vehicles, 'vehicleCategories'=>$vehicleCategories));
		}

		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}

	public function myVehicleBookings(Request $request)
	{
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}

		elseif($user[0]->type == 'tenant')
		{

			$vehicleBookings = vehicleBookingModel::where('tenantID', '=', $user[0]->id)->orderBy('created_at', 'DESC')->get();

			return view('pages.myVehicleBookings',  array('user' => $user, 'vehicleBookings' => $vehicleBookings));
		}
		
		else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	}

	public function deleteVehicleBooking(Request $request)
	{
		$user = $request->session()->get('user');

		if (is_null($user))
		{
			return false;
		}

		if ($request['id'] != null){

			$deleteVehicleBookings = vehicleBookingModel::where('id', '=', $request['id'])->delete();


			//return redirect()->action('tenantController@myBookings');
		}
			print json_encode(array(1));
	
	}

	public function viewVehicleBookingPDF(Request $request){

	$error=true;

	$user = $request->session()->get('user');
	
		if (is_null($user))
		{
			return redirect()->action('MainController@index');
		}


		elseif($user[0]->type=="tenant")
		{

			if(isset($request['id']))
			{

				$bookingid= $request['id'];
				$error=false;
			}

			else
			{
				$bookingid= false;
				$error=true;

			}

			if($error == false)
			{

				$bookings = vehiclebookingModel::where('id', '=', $bookingid)->get();

				$driver = $bookings[0]->vehicle->driver;


				if($driver = 0)
				{
					$x = 'NO';
				}
				else
				{
					$x = 'Yes';

				}
			$vehicleName = $bookings[0]->vehicle->vehicleName;
			$vehicleModel = $bookings[0]->vehicle->models;
			$vehicleCat = $bookings[0]->vehicle->category->vehiclecatname;
			$vehicleImage = $bookings[0]->vehicle->image;


			include(app_path() . '\fpdf\fpdf.php');


			if ((isset($_REQUEST['id'])) && (!empty($_REQUEST['id'])) )
			{
				$id = $_REQUEST['id'];

				$pdf=new \FPDF();

				$pdf->AddPage();

				$pdf->Rect(5, 5, 200, 287, 'D'); //For A4

				$pdf->SetFont("Arial","B",30);
				$pdf->SetFillColor(36, 96, 84);
				
				$pdf->write(6, $pdf->Image('images/logo.png',145,10,-100),1,1);


				$pdf->SetFont("Arial","B",8);
				$pdf->Ln( 30 );

				$pdf->Cell(135);
				$pdf->Write( 10, "Phone: 2612205/57139151" );
				$pdf->Ln( 10 );
				$pdf->Cell(135);
				$pdf->Write( 10, "Email: Lokeshpravin@gmail.com" );
		


				$pdf->SetFont("Arial","B",30);
				$pdf->Write( 10, "Welcome to Lodgiify" );
				$pdf->Ln( 20 );

				$pdf->SetFont("Arial","B",12);
				$pdf->Cell(20);
				$pdf ->MultiCell(25,6,"Booking Form:", 'LRT', 'L', 0);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Full Name :",1,0);
				$pdf->Cell(75,10,$user[0]->FirstName . ' ' .  $user[0]->LastName,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"From :",1,0);
				$pdf->Cell(75,10,$bookings[0]->fromdate,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"To :",1,0);
				$pdf->Cell(75,10,$bookings[0]->todate,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Price :",1,0);
				$pdf->Cell(75,10,'Rs' . $bookings[0]->price,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Vehicle Name :",1,0);
				$pdf->Cell(75,10,$vehicleName,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Type :",1,0);
				$pdf->Cell(75,10,$vehicleCat,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Model : ",1,0);
				$pdf->Cell(75,10,$vehicleModel,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"With driver : ",1,0);
				$pdf->Cell(75,10,$x,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,10,"Transmission : ",1,0);
				$pdf->Cell(75,10,$bookings[0]->vehicle->transmission,1,1);
				$pdf->Cell(20);
				$pdf->Cell(75,60,"Image : ",1,0);
				$pdf->Cell(75,60, $pdf->Image('upload'."/".$vehicleImage, 118,187,50,50), 1,1);
				

				$pdf->Ln( 45 );
				$pdf->SetFont("Arial","B",10);
				$pdf->Cell(155);
				$pdf->Cell(0, 5, "Page " . $pdf->PageNo(),  0, 1);
				
				$pdf->output();
				die;
				}
			
		}
	

	}

	else
		{
			return response()->view('pages.404', ['user'=>$user], 404);
		}

	
}


}