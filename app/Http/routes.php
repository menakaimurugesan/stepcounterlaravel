<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

Route::get('activities/{choice}', 'ActivityController@showLeaderboard');
Route::get('/', 'ActivityController@showLeaderboardStart');

// Authentication routes...
Route::get('Auth/login', 'Auth\AuthController@getLogin');
Route::post('Auth/login', 'Auth\AuthController@postLogin');
Route::get('Auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('Auth/register', 'Auth\AuthController@getRegister');
Route::post('Auth/register', 'Auth\AuthController@postRegister');


/**
 * Add A New Activity
 */
Route::post('/activity', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'activity-date' => 'required',
		'step-count' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Create activity...
	
	$activity = new Activity;
    $activity->date = $request->activty-date;
	$activity->steps = $request->step-count;
    $activity->save();

    return redirect('/');
	
});

/**
 * Delete An Existing Activity
 */
Route::delete('/activity/{id}', function ($id) {
    //
});
