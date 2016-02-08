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
/**** USER ***/
Route::get('/user/registration', 'MainController@registerUser');
Route::post('/user/update', 'MainController@updateAccount');
Route::get('/user/login', 'MainController@loginUser');
Route::get('/user/logoff', 'MainController@logoff');
Route::get('/user/sendMsg', 'MainController@sendMsg');


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



/*** PACKAGE ***/
Route::get('/package/get/{id}', 'packageController@get');
Route::get('/booking/getDirections', 'tenantController@getDirections');
Route::get('/insertPackage','LandlordController@insertPackage');
Route::post('/package/register','packageController@registerPackage');
Route::get('/package/delete','packageController@delete');