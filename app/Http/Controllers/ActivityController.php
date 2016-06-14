<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;

class ActivityController extends Controller
{
    public function showLeaderboard($choice)
	{				
		$activities = App\Activity::showLeaderboard($choice);
		return view('reports',['activities' => $activities]);
	}
	public function showLeaderboardStart()
	{			
		$activities = App\Activity::showLeaderboard('1');
		return view('reports',['activities' => $activities]);
	}
}

