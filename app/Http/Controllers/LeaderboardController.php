<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class LeaderboardController extends Controller
{
    public function showLeaderboard($choice)
	{				
		$activities = App\Activity::showLeaderboard($choice);
		return view('reports',['activities' => $activities, 'choice' => $choice]);
	}
}

