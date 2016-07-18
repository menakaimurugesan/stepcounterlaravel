<?php

namespace App\Services;
use Session;

use App\Http\Requests;
use Google_Client;
use Google_Service_Fitness;
use Carbon\Carbon;
use Google_Service_Oauth2;
use Illuminate\Support\Facades\Redirect;


Class GoogleFit
{	
	public function retriveFromGoogleFit($request)
	{		
		$client_id = '168231766340-6ds6dpfcbt6h8n4ngsp9sbvcngvttr3a.apps.googleusercontent.com';
		$client_secret = 'LEuuQoA_gtOUGmSVIDHyd_ei';
		
		//$client_id = env('FIT_CLIENT_ID');
		//$client_secret = env('FIT_CLIENT_SECRET');
		
		if ( ! session_id() ) @ session_start();
		$redirect_uri =  'http://' . $_SERVER['HTTP_HOST'] . '/GoogleFit';
				
		$client = new Google_Client();
		$client->setApplicationName('google-fit');
		$client->setAccessType('online');
		$client->setApprovalPrompt("force");
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope(Google_Service_Fitness::FITNESS_ACTIVITY_READ);
		$client->addScope('https://www.googleapis.com/auth/userinfo.email');
				
		if (isset($_SESSION['access_token'])) 
		{	
			$service = new Google_Service_Fitness($client);
			$google_oauthV2 = new Google_Service_Oauth2($client);	
		
			$client->setAccessToken($_SESSION['access_token']);				
			
			$guser = $google_oauthV2->userinfo->get();
			print($guser['email']);
			if ($guser['email'] != $request->user()->email)
			{								
				Session::put('message', 'Google email and Stepcount application email do not match!');
				return;						
			}
			$_SESSION['gmailuser'] = $guser['email'];
			$dataSources = $service->users_dataSources;
			$dataSets = $service->users_dataSources_datasets;
			$listDataSources = $dataSources->listUsersDataSources("me");					
			$endTime = strtotime("now");
			
			$period = '10';
			if (isset($_SESSION['period_choice'])){$period = $_SESSION['period_choice'];}
			$startTime = strtotime('-'.$period.' day', $endTime);			
			$data = [];	
			$dataStreamId = "derived:com.google.step_count.delta:com.google.android.gms:estimated_steps";	
			$listDatasets = $dataSets->get("me", $dataStreamId, $startTime.'000000000'.'-'.$endTime.'000000000');				
			$step_count = 0;			
			while($listDatasets->valid()) {					
				$dataSet = $listDatasets->next();												
				$dataSetValues = $dataSet['value'];								
				$date = Carbon::createFromTimestamp($dataSet['startTimeNanos']/1000000000)->format('Y-m-d');				
				if ($dataSetValues && is_array($dataSetValues)) 
				{						
					foreach($dataSetValues as $dataSetValue) 
					{
						$step_count += $dataSetValue["intVal"];													
						if (!isset($data[$date])) 
						{
							$data[$date] = 0;
						}										
						$data[$date] += $dataSetValue["intVal"];			
					}
				}
			}
			return $data;
		}
		elseif (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();			
			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
			die;
		}
		else 
		{
			$authUrl = $client->createAuthUrl();			
			header('Location:'.filter_var($authUrl, FILTER_SANITIZE_URL));
			die;
		}	
	}
}
?>
