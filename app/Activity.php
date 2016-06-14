<?php

namespace App;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','date','steps'];
	
	/**
     * Get the user that owns the activity.
     */
    public function user()
    {
        return $this->belongsTo(user::class);
    }	
	
	public static function showLeaderboard($choice)
	{
		switch($choice)
		{
			case '1':
					$sql = "SELECT U.name UserName, SUM(UA.steps) AS TotalSteps FROM activities AS UA, users AS U where U.id=UA.user_id group by UA.user_id order by TotalSteps desc\n". "\n". "";
					break;
			case '2':
					$sql = "SELECT U.name UserName, SUM(UA.steps) AS TotalSteps FROM activities AS UA, users AS U where U.id=UA.user_id and UA.date between date_sub(now(),INTERVAL 1 WEEK) and now() group by UA.user_id order by TotalSteps desc";
					break;
			case '3':
					$sql = "SELECT U.name UserName, SUM(UA.steps) AS TotalSteps FROM activities AS UA, users AS U where U.id=UA.user_id and UA.date between date_sub(now(),INTERVAL 1 MONTH) and now() group by UA.user_id order by TotalSteps desc";
					break;
			case '4':
					$sql = "SELECT Year, InnerQuery.week as Week, users.name as UserName, InnerQuery.TotalSteps as TotalSteps, InnerQuery.DateRange from 
					(SELECT Winner.UserId, Winner.Year, Winner.Week as Week, MAX(Winner.TotalSteps) as TotalSteps, Winner.DateRange from 
					(SELECT UA.user_id as UserId,  YEAR(UA.date) AS Year, CONCAT(DATE_FORMAT(DATE_ADD(UA.date, INTERVAL(1-DAYOFWEEK(UA.date)) DAY),'%Y-%m-%e'), ' TO ',    
					DATE_FORMAT(DATE_ADD(UA.date, INTERVAL(7-DAYOFWEEK(UA.date)) DAY),'%Y-%m-%e')) AS DateRange, WEEK(UA.date) Week, 
					SUM(UA.steps) AS TotalSteps FROM activities AS UA 
					where UA.date between date_sub(now(),INTERVAL 1 YEAR) and now()
					group by WEEK(UA.date), UA.user_id order by SUM(UA.steps) desc) 
					AS Winner group by Winner.Week) 
					AS InnerQuery, users where users.id = InnerQuery.UserId order by InnerQuery.Year, InnerQuery.Week";
					break;
			case '5':				
					$sql = "SELECT Year, InnerQuery.month as Month, users.name as UserName, InnerQuery.TotalSteps as TotalSteps from 
					(SELECT Winner.UserId, Winner.Year, Winner.Month as Month, MAX(Winner.TotalSteps) as TotalSteps, monthnum from 
					(SELECT UA.user_id as UserId,  YEAR(UA.date) AS Year, MONTH(UA.date) as monthnum, MONTHNAME(UA.date) Month, 
					SUM(UA.steps) AS TotalSteps FROM activities AS UA 
					where UA.date between date_sub(now(),INTERVAL 1 YEAR) and now()
					group by MONTH(UA.date), UA.user_id order by SUM(UA.steps) desc) 
					AS Winner group by Winner.Month) 
					AS InnerQuery, users where users.id = InnerQuery.UserId order by InnerQuery.Year, InnerQuery.monthnum";
					break;
		}
		return DB::select(DB::raw($sql));
	}	
}
