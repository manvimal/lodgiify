<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\User as User;
use App\vehicleOwnerModel as vehicleOwnerModel;
use App\userLandlord as userLandlord;
use App\UserAdmin as UserAdmin;




 class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function index(Request $request){
		$user = $request->session()->get('user');
		return view('pages.index',  array('user' => $user));
	
	}

	public function registrationPage(Request $request){
		$user = $request->session()->get('user');
		return view('pages.registration',  array('user' => $user));
	}

	public function aboutUs(Request $request){
		$user = $request->session()->get('user');
		return view('pages.about',  array('user' => $user));
	}

	public function registerUser(Request $request){

		$messge  = array(
		    "status" => 0,
		);


	if ((isset($_REQUEST['firstName'])) && (!empty($_REQUEST['firstName'])) ){
			$firstName = $_REQUEST['firstName'];
	}

	if ((isset($_REQUEST['lastName'])) && (!empty($_REQUEST['lastName'])) ){
			$lastName = $_REQUEST['lastName'];
	}
	if ((isset($_REQUEST['userName'])) && (!empty($_REQUEST['userName'])) ){
			$userName = $_REQUEST['userName'];
	}
	if ((isset($_REQUEST['Password'])) && (!empty($_REQUEST['Password'])) ){
			$Password = md5($_REQUEST['Password']);
	}
	if ((isset($_REQUEST['DOB'])) && (!empty($_REQUEST['DOB'])) ){
			$DOB = $_REQUEST['DOB'];
	}
	if ((isset($_REQUEST['phone'])) && (!empty($_REQUEST['phone'])) ){
			$Phone = $_REQUEST['phone'];
	}
	if ((isset($_REQUEST['Email'])) && (!empty($_REQUEST['Email'])) ){
			$Email = $_REQUEST['Email'];
	}
	if ((isset($_REQUEST['address'])) && (!empty($_REQUEST['address'])) ){
			$Address = $_REQUEST['address'];
	}
	if ((isset($_REQUEST['postalCode'])) && (!empty($_REQUEST['postalCode'])) ){
			$PostalCode = $_REQUEST['postalCode'];
	}

		$Gender = $_REQUEST['rdbGender'];
		$Country = $_REQUEST['country'];
		$memberType = $_REQUEST['userType'];


		if ($memberType == 'Tenant'){
			$users = DB::table('tbltenant')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();

                     $user1 = DB::table('tbllandlord')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();

                     $user2 = DB::table('tblvehicleowner')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();
		
		
		 if(!empty($users) OR !empty($user1) OR !empty($user2)){
		 	$messge['status'] = -1;
		 	$messge['msg'] = "Already exists";

		 }
		 else{

			$user = User::create(['FirstName' => $firstName,
								'LastName' => $lastName,
								'UserName' => $userName,
								'Password' => $Password,
								'DOB' => $DOB,
								'Phone' => $Phone,
								'Email' => $Email,
								'Address' => $Address,
								'Country' => $Country,
								'PostalCode' => $PostalCode,
								'Gender' => $Gender,
								'type' => "tenant"
								 ]);


			$messge['status'] = 1;
		 	$messge['msg'] = "Tenant registered";

	
		}

	}
		elseif($memberType == 'Landlord'){
			$users = DB::table('tbllandlord')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();

                     	$user1 = DB::table('tbltenant')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();

                     $user2 = DB::table('tblvehicleowner')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();
		
          

		           if(!empty($users) OR !empty($user1) OR !empty($user2)){
				 	$messge['status'] = -1;
				 	$messge['msg'] = "Already exists";

					 }

					 else{

					$user = userLandlord::create(['FirstName' => $firstName,
													'LastName' => $lastName,
													'UserName' => $userName,
													'Password' => $Password,
													'DOB' => $DOB,
													'Phone' => $Phone,
													'Email' => $Email,
													'Address' => $Address,
													'Country' => $Country,
													'PostalCode' => $PostalCode,
													'Gender' => $Gender,
													'type' => "Landlord"
													 ]);


					$messge['status'] = 1;
				 	$messge['msg'] = "LandLord registered";
		
			}

		}

			elseif($memberType == 'Vehicle Owner'){
			$users = DB::table('tblvehicleowner')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();

           if(!empty($users)){
		 	$messge['status'] = -1;
		 	$messge['msg'] = "Already exists";

		 }
			 else{

			$user = vehicleOwnerModel::create(['FirstName' => $firstName,
													'LastName' => $lastName,
													'UserName' => $userName,
													'Password' => $Password,
													'DOB' => $DOB,
													'Phone' => $Phone,
													'Email' => $Email,
													'Address' => $Address,
													'Country' => $Country,
													'PostalCode' => $PostalCode,
													'Gender' => $Gender,
													'type' => "vehicleowner"
													 ]);
			$messge['status'] = 1;
		 	$messge['msg'] = "Vehicle Owner registered";
	
		}

		}

		echo json_encode ($messge);

	}

	public function logoff(Request $request){
		$request->session()->pull('user');
		return redirect()->action('MainController@index');
	}


	public function loginUser(Request $request){

		$messge  = array(
		    "status" => 0,
		);

		$userName = strip_tags(trim($_REQUEST['LoginUserName']));
		$password = md5(strip_tags(trim($_REQUEST['LoginPassword'])));
		


		if (!empty($userName) && !empty($password)){
			$users = DB::table('tbltenant')
			                     ->select(DB::raw('*'))
			                     ->where('UserName', '=', $userName)
			                     ->where('Password', '=', $password)
			                     ->get();

			 if(!empty($users)){
				$messge['status'] = 1;
				$messge['msg'] = "User logged in";
				$users['type'] = 'tenant';
				$request->session()->put('user', $users);

				}

				else{

				$users = DB::table('tbllandlord')
			                     ->select(DB::raw('*'))
			                     ->where('UserName', '=', $userName)
			                     ->where('Password', '=', $password)
			                     ->get();

								 if(!empty($users)){
									$messge['status'] = 1;
									$messge['msg'] = "User logged in";
									$users['type'] = 'landlord';
									$request->session()->put('user', $users);

																		}
								else{

										$users = DB::table('tblvehicleowner')
							                     ->select(DB::raw('*'))
							                     ->where('UserName', '=', $userName)
							                     ->where('Password', '=', $password)
							                     ->get();

													if(!empty($users)){
													$messge['status'] = 1;
													$messge['msg'] = "User logged in";
													$users['type'] = 'vehicleowner';
													$request->session()->put('user', $users);
																		}


													else{
															 if(!empty($users)){
														$messge['status'] = 1;
														$messge['msg'] = "User logged in";
														
																				}
			}
				
			}
		}
}

	else{
		$messge['status'] = -1;
		$messge['msg'] = "User not found";
		}

		echo json_encode ($messge);
		return redirect()->action('MainController@index');
	}
	

	public function contactus(Request $request){
		$user = $request->session()->get('user');
		return view('pages.contact',  array('user' => $user));
	}


	public function viewItems(Request $request){

		  $users = DB::select('select * from tbltenant ');
      //  var_dump($users);

		  $html = "";

		  //create header
		  if (count($users) > 0){
		  	 $html .= "<table>";
		  	 $html .= "<tr><th> Id </th> <th> Firstname</th><th> Lastname</th><th> Action</th> </tr>";
		  }

		  foreach($users as $user){
		  	
		  	 $html .= "<tr><td> ".$user->ID." </td> <td>".$user->FirstName." </td><td> ".$user->LastName."</th><th> <a href=''>Rent</a></th> </tr>";

		  }

		   if (count($users) > 0){
		  	 $html .= "</table>";
		  }

		  print $html;
        
	}


	function generateRandomKey($key){
			return uniqid($key, true);
	}


	function sendMsg(Request $request){

		$contactName = '';
		$contactemail = '';
		$desc = '';
		$contactsubject = '';

		if ((isset($request['contactName'])) && (!empty($request['contactName'])) ){
			$contactName = $request['contactName'];
		}

		

		if ((isset($request['contactemail'])) && (!empty($request['contactemail'])) ){
				$contactemail = $request['contactemail'];
		}


		
		if ((isset($request['desc'])) && (!empty($request['desc'])) ){
				$desc = $request['desc'];
		}



		if ((isset($request['contactsubject'])) && (!empty($request['contactsubject'])) ){
				$contactsubject = $request['contactsubject'];
		}

		
		Mail::send('layout.email', ['contactName' => $contactName, 'contactemail' => $contactemail,'desc' => $desc], function($message)  use ($request)
		{

		    $message->to("lokeshpravin@gmail.com", "ADMIN")->subject($request['contactsubject']);
		    $message->from($request['contactemail'],$request['contactName'] );
		});

	}



	public function userAccount(Request $request){
		$user = $request->session()->get('user');
		return view('pages.UpdateAccount',  array('user' => $user));

	}


	public function updateAccount(Request $request){


		$messge  = array(
		    "status" => 0,
		);


	if ((isset($_REQUEST['firstName'])) && (!empty($_REQUEST['firstName'])) ){
			$firstName = $_REQUEST['firstName'];
			
	}

	if ((isset($_REQUEST['lastName'])) && (!empty($_REQUEST['lastName'])) ){
			$lastName = $_REQUEST['lastName'];
	}
	if ((isset($_REQUEST['userName'])) && (!empty($_REQUEST['userName'])) ){
			$userName = $_REQUEST['userName'];
	}
	if ((isset($_REQUEST['Password'])) && (!empty($_REQUEST['Password'])) ){
			$Password = md5($_REQUEST['Password']);
	}
	if ((isset($_REQUEST['DOB'])) && (!empty($_REQUEST['DOB'])) ){
			$DOB = $_REQUEST['DOB'];
	}
	if ((isset($_REQUEST['phone'])) && (!empty($_REQUEST['phone'])) ){
			$Phone = $_REQUEST['phone'];
	}
	if ((isset($_REQUEST['Email'])) && (!empty($_REQUEST['Email'])) ){
			$Email = $_REQUEST['Email'];
	}
	if ((isset($_REQUEST['address'])) && (!empty($_REQUEST['address'])) ){
			$Address = $_REQUEST['address'];
	}
	if ((isset($_REQUEST['postalCode'])) && (!empty($_REQUEST['postalCode'])) ){
			$PostalCode = $_REQUEST['postalCode'];
	}

		$Gender = $_REQUEST['rdbGender'];
		$Country = $_REQUEST['country'];
		//$memberType = $_REQUEST['userType'];

	$user = $request->session()->get('user');

	

if(($user[0]->type)=="tenant"){

		//Save room for user
		$tenant = User::find($user[0]->ID);
		$tenant-> FirstName = $firstName ;
		$tenant-> LastName = $lastName ;
		$tenant-> Password = md5($Password) ;

		$tenant->save();
		

	}

	elseif(($user[0]->type)== "landlord"){
		$landlord = userLandlord::find($user[0]->ID);
		$landlord-> FirstName = $firstName ;
		$landlord-> LastName = $lastName ;
		$landlord-> Password = md5($Password) ;

		$landlord->save();
		

	}
		else {
			$vehicleowner = vehicleOwnerModel::find($user[0]->ID);
			$vehicleowner-> FirstName = $firstName ;
			$vehicleowner-> LastName = $lastName ;
			$vehicleowner-> Password = md5($Password) ;

			$vehicleowner->save();

	}

		
		echo json_encode ($messge);


}

	
}
?>

	



	






	