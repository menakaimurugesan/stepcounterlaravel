<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Services\GoogleFit;

class ActivityController extends Controller
{    	
	//Authenticate users to access their own data
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activities = $request->user()->activities()->get();
		return view('activities', ['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, ['date' => 'required',]);
		$this->validate($request, ['steps' => 'required',]);
		$request->user()->activities()->create(['date' => $request->date, 'steps' => $request->steps,]);

		return redirect('/activity');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function retriveFromGoogleFit(Request $request, GoogleFit $googlefit)
	{
		session_start();
		$data = [];
		if (isset($_GET['period'])) {
			$_SESSION['period_choice'] = $_GET['period'];
		}
		$data =  $googlefit->retriveFromGoogleFit($request);
		
		if (!empty($data))
		{
			//print(json_encode($data));
			foreach($data as $key => $value)
			{				
				$request->user()->activities()->updateOrCreate(['date' => $key],['date' => $key, 'steps' => $value,]);
			}
			Session::put('message', 'Successfully retrieved data from GoogleFit');
		}
		elseif (empty(Session::get('message')))
		{
			Session::put('message', 'No data found for this period');
		}
		
		unset($_SESSION['access_token']);
		return redirect('/activity');
	}
}
