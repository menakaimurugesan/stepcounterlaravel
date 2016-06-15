<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class ActivityController extends Controller
{
	//Authenticate users to access Leaderboard
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function showLeaderboard($choice)
	{				
		$activities = App\Activity::showLeaderboard($choice);
		return view('reports',['activities' => $activities]);
	}
}

