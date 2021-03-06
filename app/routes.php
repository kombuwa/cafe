<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

App::missing(function($exception)
{
    return Response::view('errors.missing', array('url' => Request::url()), 404);
});

Route::get('/', function()
{
    if(Auth::check())
	{
		return View::make('admin.index')->with('title','Cafe Ceylon Admin Panel');
	}
	return Redirect::to('login');
});

/////////////////////////
/*-- AFTER AUTH ROUTS --*/
///////////////////////

//  Route to the Food Category page
Route::group(array('before' => 'auth'), function(){
	Route::get('/food/category/', array(
	    'as' => 'admin.foodcategory',
	    function() {
	        return View::make('admin.foodcategory')->with('title','Food Category');
	    }
	));
});

//  Route to the Food Itempage
Route::group(array('before' => 'auth'), function(){
	Route::get('/food/item/', array(
	    'as' => 'admin.fooditem',
	    function() {
	        return View::make('admin.fooditem')->with('title','Food Item');
	    }
	));
});

//  Route to the Food Ingredient page
Route::group(array('before' => 'auth'), function(){
	Route::get('/food/ingredient/', array(
	    'as' => 'admin.foodingredient',
	    function() {
	        return View::make('admin.foodingredient')->with('title','Food Ingredient');
	    }
	));
});

//  Route to the Food Stock page
Route::group(array('before' => 'auth'), function(){
	Route::get('/food/stock/', array(
	    'as' => 'admin.foodstock',
	    function() {
	        return View::make('admin.foodstock')->with('title','Food Stock');
	    }
	));
});


//  Route to the new Order page
Route::group(array('before' => 'auth'), function(){
	Route::get('/order/new/', array(
	    'as' => 'admin.ordernew',
	    function() {
	        return View::make('admin.ordernew')->with('title','New Order');
	    }
	));
	Route::post('/order/new/', 'OrderController@newOrder');
});

//  Route to the edit Order page
Route::group(array('before' => 'auth'), function(){
	Route::get('order/edit/{id}', 'OrderController@editOrder');
});

//  Route to the Order List page
Route::group(array('before' => 'auth'), function(){
	Route::get('/order/list/', array(
	    'as' => 'admin.orderlist',
	    function() {
	        return View::make('admin.orderlist')->with('title','Order List');
	    }
	));
});

//  Route to the print Order page
Route::group(array('before' => 'auth'), function(){
	Route::get('invoice/new/{id}', 'OrderController@newinvoice');
	Route::get('order/print/{id}', 'OrderController@printOrder');
});

//  Route to the print Order Request
Route::group(array('before' => 'auth'), function(){
	Route::get('kot/full/{id}', 'OrderController@fullKot');
	//Route::get('kot/updated/{id}', 'OrderController@updatedKot');
	Route::get('kot/print/{id}', 'OrderController@printKot');
	Route::get('bot/full/{id}', 'OrderController@fullBot');
	//Route::get('bot/updated/{id}', 'OrderController@updatedBot');
	Route::get('bot/print/{id}', 'OrderController@printBot');
});
/////////////////////////
/*-- PRE AUTH ROUTS --*/
///////////////////////

// Route to the login page
Route::get('login', function()
{
        if(Auth::check())
	{
		return Redirect::to('/');
	}
	return View::make('login.loginform')->with('title','Login');
});
// Route to the login form process
Route::post('login', 'UserController@login');


// Route to the logout
Route::get('logout', function()
{
        Auth::logout();
        Session::flush();
	return Redirect::to('login');
});


// Route to the signup form
Route::get('signup', function()
{
        if(Auth::check())
	{
		return Redirect::to('/');
	}
        return View::make('login.signup')->with('title','Signup');
});
// Route to the signup form process
Route::post('signup', 'UserController@signup');


// Route to the password reset form
Route::get('reset', function()
{
        if(Auth::check())
	{
		return Redirect::to('/');
	}
        return View::make('login.reset')->with('title','Reset password');
});
// Route to the password resetform process
Route::post('reset', 'UserController@reset');


// Route to password reset code check
Route::get('resetpassword/{resetcode}', 'UserController@resetpassword');


////////////////////
/*-- API ROUTS --*/
//////////////////

Route::group(array('before' => 'auth'), function(){
	// API to get Food Item
	Route::get('api/food/category/{id}', 'FoodController@getcategory');
	// API to get Food Categorys
	Route::get('api/food/categorys/', 'FoodController@getcategorys');
	// API to add Food Category
	Route::post('api/food/category/', 'FoodController@postcategory');
	// API to delete Food Category
	Route::delete('api/food/category/{id}', 'FoodController@deletecategory');
	
	// API to get Food Item
	Route::get('api/food/item/{id}', 'FoodController@getitem');
	// API to get Food Items
	Route::get('api/food/items/', 'FoodController@getitems');
	// API to get Food Items by category
	Route::get('api/food/itemsbycategory/{fcid}', 'FoodController@getitemsbycategory');
	// API to add Food Item
	Route::post('api/food/item/', 'FoodController@postitem');
	// API to update Food Item
	Route::put('api/food/item/{id}', 'FoodController@putitem');
	// API to delete Food Item
	Route::delete('api/food/item/{id}', 'FoodController@deleteitem');

	// API to get Food ingredient
	Route::get('api/food/ingredient/{id}', 'FoodController@getingredient');
	// API to get Food ingredients
	Route::get('api/food/ingredients/', 'FoodController@getingredients');
	// API to add Food ingredient
	Route::post('api/food/ingredient/', 'FoodController@postingredient');
	// API to update Food ingredient
	Route::put('api/food/ingredient/{id}', 'FoodController@putingredient');
	// API to delete Food ingredient
	Route::delete('api/food/ingredient/{id}', 'FoodController@deleteingredient');

	// API to get Food item ingredients
	Route::get('api/food/item_ingredients/{fiid}', 'FoodController@getfooditem_ingredients');
	// API to add Food item ingredient
	Route::post('api/food/item_ingredient/', 'FoodController@postfooditem_ingredient');
	// API to delete Food item ingredient
	Route::delete('api/food/item_ingredient/{id}', 'FoodController@deletefooditem_ingredient');

	// API to get Food stock
	Route::get('api/food/stock/', 'FoodController@getstocks');
	// API to add Food stock
	Route::post('api/food/stock/', 'FoodController@poststock');
	// API to delete Food stock1
	Route::delete('api/food/stock/{id}', 'FoodController@deletestock');

	// API to get Order
	Route::get('api/order/details/{id}', 'OrderController@getorder');
	// API to get Orders
	Route::get('api/orders/', 'OrderController@getorders');
	// API to add Order Item
	Route::post('api/order/Item/', 'OrderController@postitem');
	// API to updte Order Discount
	Route::get('api/order/discount/', 'OrderController@getdiscount');
	// API to increase Order item quantity
	Route::put('api/order/item/p/{id}', 'OrderController@pitem');
	// API to decrease Order item quantity
	Route::put('api/order/item/n/{id}', 'OrderController@nitem');
	// API to get Order Items
	Route::get('api/order/items/{id}', 'OrderController@getitems');
	// API to delete Order Item
	Route::delete('api/order/item/{id}', 'OrderController@deleteitem');
	// API to get Order Items
	Route::get('/api/invoice/{id}', 'OrderController@getinvoice');
	// API to get kot 
	Route::get('/api/kot/{id}', 'OrderController@getkot');
	// API to get bot 
	Route::get('/api/bot/{id}', 'OrderController@getbot');
});