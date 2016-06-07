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

/**
 * Display All Activities
 */
Route::get('/l', function () {
	$activities = Activity::orderBy('date', 'asc')->get();

    return view('activities', [
        'activities' => $activities
    ]);
   
});

use Carbon\Carbon;

Route::get('/', function () {
    	$activities = Activity::select(DB::raw('month, MAX(sumsteps) as maxsteps, T.user_id'))
		->from(DB::raw('(SELECT MONTH(date) as month, SUM(steps) as sumsteps, user_id from activities where date between date_sub(now(),INTERVAL 1 YEAR) and now() group by month, user_id order by SUM(steps) desc) as T'))
		->groupBy ('month')		
		-> get();	
	
	return view('activities', [
        'activities' => $activities
    ]);

});
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
