<?php

/*
 * |--------------------------------------------------------------------------
 * | Routes File
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you will register all of the routes in an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */

/**
 * Default route
 */
Route::get ( '/', function () {
	return view ( 'admin.user' );
} );

/**
 * user route
 * 
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ('/user', 'UserController@index' );
	Route::get ('/userall', 'UserController@all' );
	Route::post ('/user', 'UserController@store' );
	Route::get ('/user/view/{id}', 'UserController@show' );
	Route::get ('/user/delete/{id}', 'UserController@destroy' );
	Route::put ('/user/update/{id}', 'UserController@update' );
	Route::get ('/user/page/{pageid}/item/{limit}', 'UserController@listUser' );
	Route::get ('/user/page/{pageid}/item/{limit}/{key}', 'UserController@search' );
});

/**
 * job route
 * 
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ('/job', 'JobController@index' );
	Route::get ('/job/view/{id}', 'JobController@show' );
	Route::get ('/job/delete/{id}', 'JobController@destroy' );
	Route::get ('/job/edit/{id}', 'JobController@edit' );
	Route::get ('/job/search', 'JobController@search' );
	Route::post ( '/job/store', 'JobController@store' );
	Route::post ( '/job/update', 'JobController@update' );
});

/**
 * attendee route
 * 
 */
Route::group(['middleware' => ['web']], function () {
	Route::get ('/attendee', 'AttendeeController@index');
	Route::get ('/attendee/view/{id}', 'AttendeeController@show');
	Route::get ('/attendee/delete/{id}', 'AttendeeController@destroy');
	Route::get ('/attendee/edit/{id}', 'AttendeeController@edit');
	Route::get ('/attendee/search', 'AttendeeController@search');
	Route::post ('/attendee/store', 'AttendeeController@store');
	Route::post ('/attendee/update', 'AttendeeController@update');
});