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
use App\buildingModel as buildingModel;

use App\adminModel as adminModel;
use App\tenantModel as tenantModel;
use App\sessionModel as sessionModel;
use URL;
use Carbon\Carbon;




 class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function index(Request $request){

		$user = $request->session()->get('user');

		$blockedUsers = UserLandlord::where('userStatus','=', 1)->get();

		$building = buildingModel::orderBy('created_at', 'DESC')->paginate(3);


		foreach($blockedUsers as $blockedUser){
			$blocked = ($blockedUser['id']);

		}

		if(!empty($blocked)){

			$buildings = buildingModel::where('landlordID', '=', $blocked)->get();
		}
		else{

			$buildings = "";
		}

		return view('pages.index',  array('user' => $user, 'buildings'=>$buildings,'building'=>$building));
	
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
                     ->orWhere('Email','=', $Email)
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
                     ->orWhere('Email','=', $Email)
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
/**
					$messge['status'] = 1;
				 	$messge['msg'] = "Please wait...";

					$subject = "Hello" . $userName;
					$body ="Please confirm your mail";
					$to=$Email;

					$this->emailConfirmation($userName, $to, $subject, $body);


					$messge['status'] = 1;
				 	$messge['msg'] = "LandLord Successfully registered, Please confirm your mail.";
				 	**/
		
			}

		}

			elseif($memberType == 'Vehicle Owner'){
			$users = DB::table('tblvehicleowner')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->orWhere('Email','=', $Email)
                     ->get();

            			 $user2 = DB::table('tbllandlord')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();

                     	$user1 = DB::table('tbltenant')
                     ->select(DB::raw('*'))
                     ->where('UserName', '=', $userName)
                     ->get();



 			if(!empty($users) OR !empty($user1) OR !empty($user2)){
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
			                    ->Where('userStatus', '=', '1' )
			                    ->get();

			if(!empty($users))
			{

				$messge['status'] = 1;
				$messge['msg'] = "Tenant logged in. Please wait...";
				$users['type'] = 'tenant';
				$request->session()->put('user', $users);

				
				

				sessionModel::where('username','=',$users[0]->UserName)->get();

				
				//var_dump($checkLoginExists);
				//die;
				if(isset($checkLoginExists) && !empty($checkLoginExists) && (count($checkLoginExists) >0))
				{


					DB::table('tblsession')
		                	->where('username', $users[0]->UserName )
		                	->update(array('logindatetime' =>  $this->getTodayDateTime() ));


				}

				else
				{
				
					$userStatusInsert = new sessionModel;
					$userStatusInsert-> username = $users[0]->UserName;
					$userStatusInsert-> logindatetime = $this->getTodayDateTime();
					$userStatusInsert-> type = $users[0]->type;
					$userStatusInsert->save();
		

				}
				

			}


			else 
			{

				$users = DB::table('tbllandlord')
			                     ->select(DB::raw('*'))
			                     ->where('UserName', '=', $userName)
			                     ->where('Password', '=', $password)
			                     ->Where('userStatus', '=', '1' )
			                     ->get();

					if(!empty($users)){
						$messge['status'] = 1;
						$messge['msg'] = "Landlord logged in. Please wait...";
						$users['type'] = 'landlord';
						$request->session()->put('user', $users);

						}


					else
					{

						$users = DB::table('tblvehicleowner')
							           		->select(DB::raw('*'))
							                ->where('UserName', '=', $userName)
							                ->where('Password', '=', $password)
							                ->Where('userStatus', '=', '1' )
							                ->get();

						if(!empty($users)){
							$messge['status'] = 1;
							$messge['msg'] = "Vehicle Owner logged in. Please wait...";
							$users['type'] = 'vehicleowner';
							$request->session()->put('user', $users);
																		}


						else
						{
													

														$users = DB::table('tbladmin')
							                     ->select(DB::raw('*'))
							                     ->where('UserName', '=', $userName)
							                     ->where('Password', '=', $password)
							                     ->get();



													if(!empty($users)){
													$messge['status'] = 1;
													$messge['msg'] = "Admin logged in. Please wait...";
													$users['type'] = 'admin';
													$request->session()->put('user', $users);
														
													}

											else
											{

												if(empty($users)){
													$messge['status'] = -1;
												$messge['msg'] = "Wrong email/password or Account blocked";
												}
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

		if (is_null($user)){
			return redirect()->action('MainController@index');
		}
		return view('pages.UpdateAccount',  array('user' => $user));

	}


	public function updateAccount(Request $request){


		$messge  = array(
		    "status" => 0,
		);

		$error=true;


	if ((isset($_REQUEST['firstName'])) && (!empty($_REQUEST['firstName'])) ){
			$firstName = $_REQUEST['firstName'];
			$messge['status'] = 1;
			$error=false;
	}
	else{
			$messge['status'] = -1;
			$error=true;
			$firstName=false;

	}

	if ((isset($_REQUEST['lastName'])) && (!empty($_REQUEST['lastName'])) ){
			$lastName = $_REQUEST['lastName'];
			$error=false;
			$messge['status'] = 1;
	}
	else{
		$messge['status'] = -1;
			$error=true;
			$lastName=false;


	}

	if ((isset($_REQUEST['DOB'])) && (!empty($_REQUEST['DOB'])) ){
			$DOB = $_REQUEST['DOB'];
			$error=false;
			$messge['status'] = 1;
	}
	else{
			$messge['status'] = -1;
			$error=true;
			$DOB=false;

	}

	if ((isset($_REQUEST['phone'])) && (!empty($_REQUEST['phone'])) ){
				$error=false;
				$Phone = $_REQUEST['phone'];
				$messge['status'] = 1;
	} 
	
	else{
		$messge['status'] = -1;
			$error=true;
			$Phone=false;

	}
	if ((isset($_REQUEST['Email'])) && (!empty($_REQUEST['Email'])) ){
			$Email = $_REQUEST['Email'];
			$error=false;
			$messge['status'] = 1;
	}
	else{
		$messge['status'] = -1;
			$error=true;
			$Email=false;

	}
	if ((isset($_REQUEST['address'])) && (!empty($_REQUEST['address'])) ){
			$Address = $_REQUEST['address'];
			$messge['status'] = 1;
			$error=false;
	}
	else{
		$messge['status'] = -1;
			$error=true;
			$Address=false;

	}
	if ((isset($_REQUEST['postalCode'])) && (!empty($_REQUEST['postalCode'])) ){
			$PostalCode = $_REQUEST['postalCode'];
			$error=false;
			$messge['status'] = 1;
	}
	else{
		$messge['status'] = -1;
			$error=true;
			$PostalCode=false;

	}

		$Gender = $_REQUEST['rdbGender'];
		$Country = $_REQUEST['country'];


	$user = $request->session()->get('user');

	
	if (is_null($user)){
		return false;
	}
	if($error==false){

	

	if(($user[0]->type)=="tenant"){

		//Save room for user
		$tenant = User::find($user[0]->id);
		$tenant-> FirstName = $firstName ;
		$tenant-> LastName = $lastName ;
		$tenant-> DOB = $DOB ;
		$tenant-> Address = $Address ;
		$tenant-> Country = $Country ;
		$tenant-> PostalCode = $PostalCode ;
		$tenant->save();


					 	$messge['status'] = 1;
			
					 	$messge['msg'] = $user[0]->UserName . ",Tenant Successfully updated";
		

	}

	elseif(($user[0]->type)== "Landlord"){



		$landlord = userLandlord::find($user[0]->id);

		$landlord-> FirstName = $firstName ;
		$landlord-> LastName = $lastName ;
		$landlord-> DOB = $DOB ;
		$landlord-> phone = $Phone ;
		$landlord-> Address = $Address ;
		$landlord-> Country = $Country ;
		$landlord-> PostalCode = $PostalCode ;

		$landlord->save();


					 	$messge['status'] = 1;
					 	$messge['msg'] = $user[0]->UserName . " Landlord Successfully updated";



	}
		else {
			$vehicleowner = vehicleOwnerModel::find($user[0]->id);
			$vehicleowner-> FirstName = $firstName ;
			$vehicleowner-> LastName = $lastName ;
			$vehicleowner-> DOB = $DOB ;
			$vehicleowner-> phone = $Phone ;
			$vehicleowner-> Address = $Address ;
			$vehicleowner-> Country = $Country ;
			$vehicleowner-> PostalCode = $PostalCode ;

			$vehicleowner->save();


					 	$messge['status'] = 1;

					 	$messge['msg'] = $user[0]->UserName . ", Vehicle owner Successfully updated";

	}
}
else{

			$messge['status'] = -1;
			$messge['msg'] = " Update Failed";
}


echo json_encode($messge);


}



function emailConfirmation($contactName, $to, $subject, $body){

 // create curl resource 
        $ch = curl_init(); 

	    $link = "http://localhost:8082/lodgiify_/peerExternalMailPlugin/mainTest.php?contactname=".$contactName.'&email='.$to.'&contactsubject='.$subject.'&desc='.$body;
        // set url contactName
        curl_setopt($ch, CURLOPT_URL, $link); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        curl_close($ch);     



}



//Contact Us email form

function customerQuery(Request $request){




 // create curl resource 
        $ch = curl_init(); 


	    $link = "http://localhost:8082/lodgiify_/peerExternalMailPlugin/mainTest.php?contactname=".$request['contactName'].'&email='.$request['contactemail'].'&contactsubject='.$request['contactsubject'].'&desc='.$request['desc'];
        // set url contactName
        curl_setopt($ch, CURLOPT_URL, $link); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
//var_dump($output);die;
        // close curl resource to free up system resources 
        curl_close($ch);     



}




function sendEmail($contactName, $to, $subject, $body){

 // create curl resource 
        $ch = curl_init(); 

	    $link = "http://localhost:8082/lodgiify_/peerExternalMailPlugin/mainTest.php?contactname=".$contactName.'&email='.$to.'&contactsubject='.$subject.'&desc='.$body;
        // set url contactName
        curl_setopt($ch, CURLOPT_URL, $link); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        curl_close($ch);     



}



	public function forgetPassword(Request $request){
		$user = $request->session()->get('user');

		return view('pages.forgetPassword', array('user' => $user));
	}

	public function postForgetPassword($hash, Request $request){
		$user = $request->session()->get('user');

		
		$usertoUpdate = $this->getUserBy("hash",$hash );
		$msg = array();

		$return = array();
		$return['hash'] = $hash;
		if (!is_null($usertoUpdate)){

			$then = new \DateTime($usertoUpdate->expiryHash);
	
			
			$now = new \DateTime();
			$now->setTimezone(new \DateTimeZone('Indian/Mauritius'));
			

			
			if ($now < $then){
				
				$msg['statuspost'] = 1;
				$msg['msgpost'] = "OK";
			}
			else{
				
				$msg['statuspost'] = -1;
				$msg['msgpost'] = "Link has expired";
			}
			$return['userforget'] = $usertoUpdate;
			
		}
		else{
			$msg['statuspost'] = -1; 
			$msg['msgpost'] = "Link is not valid";
		}
		$return['user'] = $user;
		$return['msg'] = $msg;

		return view('pages.forgetPassword', $return);
	}



	public function forgetPasswordProcess(Request $request){
		
		if ((isset($request['id'])) && (!empty($request['id'])) ){
			$usertoUpdate = $this->getUserBy("hash",$request['hash'] );

			$usertoUpdate->hash ="";
			$usertoUpdate-> expiryHash= "";
			if (isset($request['password']) && !empty($request['password'])){
				$usertoUpdate->password = md5($request['password'] );
			}
			$usertoUpdate->save();

			$messge['status'] = 1;
			$messge['msg'] = "Password successfully changed.";

		}
		else{

			$messge = array('msg'=>'A mail has been sent');
			if ((isset($_REQUEST['userName'])) && (!empty($_REQUEST['userName'])) ){
				$userName = $_REQUEST['userName'];
				$usertoUpdate = $this->getUserBy("userName",$userName );

				if (!is_null($usertoUpdate)){
					$strmd5 = md5(($usertoUpdate->Email)."".$this->rand_char(20));
					$usertoUpdate->hash = $strmd5 ;

					$dt = new \DateTime();

					$dt->setTimezone(new \DateTimeZone('Indian/Mauritius'));
					$dt->add(new \DateInterval('PT1H'));

					$usertoUpdate->expiryHash = $dt ;
					$usertoUpdate->save();

					$messge['status'] = 1;
					$messge['msg'] = "A link has been sent to your email.";
					$error=false;

					$body = "Hello ". $userName. "," ."\n";
					$body .="The link to reset your password is :";



					$url = URL::to('/user/postForgetPassword', array($strmd5));;
					//$body .="<a href='".$url."'>".$url."</a>";
					$body .=$url;
					
					$body .="   Your link will expire in 1 hour.";
					$body .= "Lodgiify team";

					$body = urlencode($body);

					$this-> sendEmail($userName, $usertoUpdate->Email, urlencode("Password reset link for Lodgiify"), $body);

				}
				else{
					$messge['status'] = -1;
					$messge['msg'] = "User not found.";
				}

				

			}
			else{
					$messge['status'] = -1;
					$error=true;
					$userName=false;

			}

		}

		return json_encode($messge) ;
	}



	private function getUserBy($filter,$value){
		$vehicleOwnerModel = vehicleOwnerModel::where($filter, '=', $value)->first();
		if (is_null($vehicleOwnerModel)){

			$userLandlord = userLandlord::where($filter, '=', $value)->first();

			if (is_null($userLandlord)){
				$adminModel = adminModel::where($filter, '=', $value)->first();

				if (is_null($adminModel)){
					$tenantModel = tenantModel::where($filter, '=', $value)->first();

					if (is_null($tenantModel)){
						return null;
					}
					else{
							return $tenantModel; 
					}
				}
				else{
						
						return $adminModel; 
				}

				
			}
			else{
					
					return $userLandlord; 
			}

			
		}
		else{
			
			return $vehicleOwnerModel; 
		}
		
		return null;
		
	}


	private function rand_char($length) {
	  $random = '';
	  for ($i = 0; $i < $length; $i++) {
	    $random .= chr(mt_rand(33, 126));
	  }
	  return $random;
	}

	private function getTodayDateTime()
	{

		date_default_timezone_set("Indian/Mauritius");
		return date('Y-m-d H:i:s', strtotime('+0 minutes'));
	}

	
}
?>

	



	






	