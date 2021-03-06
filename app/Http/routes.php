<?php



/****  MENU ****/
Route::get('/index', 'MainController@index');
Route::get('/registration', 'MainController@registrationPage');
Route::get('/contactus', 'MainController@contactus');
Route::get('/aboutus', 'MainController@aboutUs');
Route::get('/viewItems', 'MainController@viewItems');
Route::get('/addBuilding','LandlordController@addBuilding');
Route::get('/addRoom','LandlordController@addRoom');
Route::get('viewBuildings','buildingController@viewBuildings');
Route::get('/addVehicle','VehicleOwnerController@addVehicle');
Route::get('/viewVehicles','vehicleController@viewVehicle');
Route::get('/booking','tenantController@rentRoomVehicles');
Route::get('/mybooking','tenantController@myBookings');
Route::post('/feedback','MainController@customerQuery');
Route::get('/userAccount', 'MainController@userAccount');
Route::get('/viewPackage','packageController@viewPackage');
Route::get('/viewVehicleBookings','VehicleOwnerController@viewVehicleBookinga');
Route::get('/user/forgetPassword','MainController@forgetPassword');
Route::get('/user/sessionTimeOutRedirect','MainController@sessionTimeOutRedirect');
Route::get('/viewBookedRooms','LandlordController@viewBookedRooms');
Route::get('/myVehicleBookings','tenantController@myVehicleBookings');


Route::get('/viewBookedVehicles','VehicleOwnerController@viewBookedVehicles');
Route::get('/vehicleBooking/delete','VehicleOwnerController@deleteVehicleBooking');

/**** USER ***/
Route::post('/user/registration', 'MainController@registerUser');
Route::post('/user/update', 'MainController@updateAccount');
Route::post('/user/login', 'MainController@loginUser');
Route::get('/user/logoff', 'MainController@logoff');
Route::get('/user/sendMsg', 'MainController@sendMsg');
Route::post('/user/forgetPasswordProcess','MainController@forgetPasswordProcess');
Route::get('/user/postForgetPassword/{hash}','MainController@postForgetPassword');


/****  LANDLORD ****/
Route::get('/landlordhome','LandlordController@landlordhome');


/***** BUILDING ****/
Route::post('/building/register','buildingController@register');
Route::post('/building/update','buildingController@update');
Route::get('/building/delete','buildingController@delete');


/***** ROOM ****/
Route::post('/room/register','roomController@register');
Route::get('/room/delete','roomController@delete');
Route::post('/room/update','roomController@update');


/**** SEARCH  ****/
Route::get('search','searchController@search');


/**** VEHICLE ****/
Route::post('/vehicle/register', 'vehicleController@register');
Route::get('/vehicle/delete', 'vehicleController@delete');
Route::post('/vehicle/update', 'vehicleController@update');


/**** Booking ****/
Route::get('/booking/roomCategory', 'roomCategoryController@getAll');
Route::post('/booking/register', 'bookingController@register');
Route::get('/package/{id}', 'bookingController@packages');
Route::get('/booking/viewBooking', 'tenantController@viewBookingPDF');
Route::get('/booking/delete','tenantController@deleteBooking');
Route::post('/checkRoomAvail','bookingController@checkAvailability');
Route::get('/vehicleBooking','tenantController@vehicleBooking');
Route::get('/bookVehiclesProcess/{id}','bookingController@bookVehiclesProcess');
Route::post('/checkVehicleAvail','bookingController@checkVehicleAvailability');
Route::post('/vehiclebooking/register','bookingController@bookVehicles');

Route::get('vehicleBooking/delete','tenantController@deleteVehicleBooking');
Route::get('vehicleBooking/view','tenantController@viewVehicleBookingPDF');

Route::get('deleteVehicleBooking','VehicleOwnerController@deleteVehicleBooking');





Route::get('/bookingTenant/delete','LandlordController@landlordDeleteTenantBooking');



/*** PACKAGE ***/
Route::get('/package/get/{id}', 'packageController@get');
Route::get('/booking/getDirections', 'tenantController@getDirections');
Route::get('/insertPackage','LandlordController@insertPackage');
Route::post('/package/register','packageController@registerPackage');
Route::get('/deletePackage/delete','packageController@delete');
Route::post('/updatePackage/update','packageController@update');



/**Admin **/
Route::get('/viewUsers', 'adminController@viewUsers');
Route::get('/tenant/delete','adminController@deleteTenant');
Route::get('/tenant/update','adminController@updateTenant');
Route::get('/landlord/delete','adminController@deleteLandlord');
Route::get('/landlord/update','adminController@updateLandlord');
Route::get('/vehicleowner/delete','adminController@deleteVehicleOwner');
Route::get('/vehicleowner/update','adminController@updateVehicleOwner');
Route::get('/addCategoryPage','adminController@addCategoryPage');
Route::post('/addCategories','adminController@addCategories');
Route::get('/roomCategory/delete','adminController@deleteRoomCat');
Route::get('/buildingCategory/delete','adminController@deleteBuildingCat');
Route::get('/vehicleCategory/delete','adminController@deleteVehicleCat');
Route::get('/viewCategoryPage','adminController@viewCategoryPage');
Route::get('/addFacilityPage','adminController@addFacilityPage');
Route::post('/addFacilities','adminController@addFacilities');
Route::get('/facility/delete','adminController@deleteFacility');
Route::get('/facility/updatePage','adminController@updateFacilityPage');
Route::get('/updateFacilities','adminController@updateFacility');
Route::get('/roomCategory/update','adminController@updateRoomCatPage');
Route::get('/buildingCategory/update','adminController@updateBuildingCatPage');
Route::get('/vehicleCategory/update','adminController@updateVehicleCatPage');
Route::get('/updateCategories','adminController@updateCategories');
Route::get('/tenant/update','adminController@tenantUpdatePage');
Route::get('/user/block', 'adminController@blockUsers');
Route::get('/manageBuilding', 'adminController@manageBuilding');
Route::get('/managePackage','adminController@managePackage');
Route::get('/manageVehicles', 'adminController@manageVehicles');
Route::get('/manageRoomBookings', 'adminController@manageRoomBookings');

Route::get('/manageAllVehicleBookings', 'adminController@manageAllVehicleBookings');


Route::get('/adminVehicleBooking/delete','adminController@deleteVehicleBooking');
Route::get('adminRoombooking/delete','adminController@adminDeleteBooking');



Route::post('/landlord/addRoomFacility','RoomController@addRoomFacility');
Route::post('/landlord/addBuildingFacility', 'BuildingController@addBuildingFacility');
Route::get('/buildingFacility/delete', 'BuildingController@deleteBuildingFacility');

Route::get('/RoomFacility/delete', 'RoomController@deleteRoomFacility');


Route::get('/buildingSuggestion','searchController@buildingSuggestion');

Route::post('/getAdvancedSearch','searchController@getAdvancedSearch');
Route::post('/getVehicleAdvancedSearch','searchController@getVehicleAdvancedSearch');




Route::post('/insertRating', 'bookingController@insertRating');
Route::get('/tenantfeedback', 'bookingController@tenantFeedback');





