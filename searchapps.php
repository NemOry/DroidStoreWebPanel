<?php

	require_once("includes/initialize.php");

	ini_set('max_execution_time', '300');

	$limit 			= $_GET['limit'];
	$q 				= urlencode($_GET['q']);

	$theurl = "https://42matters.com/api/1/apps/search.json?access_token="._42MATTERS_ACCESS_TOKEN."&limit=".$limit."&q=".$q;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $theurl);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($curl);
	curl_close($curl);

	//$response = file_get_contents($theurl);

	$applications = json_decode($response);

	$newApplications = array();

	if(count($applications->results) > 0)
	{
		foreach ($applications->results as $app) 
		{
			if($app->package_name != "com.snapchat.android")
			{
				$app->platform = "android";
				$app->evozi_key = _EVOZI_API_KEY;
				$app->paiderrorstring = "Sorry! You can't download paid applications.";

				if(!existsInBlockedApps($app->package_name))
				{
					array_push($newApplications, $app);
				}
			}
			else
			{
				$snapchatAppObject = new CustomApp();
				$snapchatAppObject->evozi_key = _EVOZI_API_KEY;

				array_push($newApplications, $snapchatAppObject);
			}
		}
	}
	else
	{
		if(strtolower($q) == "snap2chat")
		{
			$snapchatAppObject = new CustomApp();
			$snapchatAppObject->evozi_key = _EVOZI_API_KEY;

			array_push($newApplications, $snapchatAppObject);
		}
	}

	$applications->results = $newApplications;

	//echo json_encode($applications);

	echo "EXISTS: " . existsInBlockedApps('com.test.test');

?>