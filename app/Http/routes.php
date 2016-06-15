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

//Leaderboard routes...
Route::get('activities/{choice}', 'ActivityController@showLeaderboard');
Route::get('/', function(){return view('welcome');});

// Authentication routes...
Route::get('Auth/login', 'Auth\AuthController@getLogin');
Route::post('Auth/login', 'Auth\AuthController@postLogin');
Route::get('Auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('Auth/register', 'Auth\AuthController@getRegister');
Route::post('Auth/register', 'Auth\AuthController@postRegister');
