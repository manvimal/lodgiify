<?php

namespace App\Http\Controllers;

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


 class roomCategoryController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function getAll(Request $request){
		$user = $request->session()->get('user');

		//Gets room categories
		$categories = roomCategory::all();
		
		print json_encode($categories);

	}

}