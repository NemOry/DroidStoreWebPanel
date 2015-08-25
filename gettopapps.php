<?php

	require_once("includes/initialize.php");

	ini_set('max_execution_time', '300');

	$listName 		= $_GET['listName'];
	$country 		= $_GET['country'];
	$lang 			= $_GET['lang'];
	$category 		= $_GET['category'];

	$theurl = "https://42matters.com/api/1/apps/top.json?access_token="._42MATTERS_ACCESS_TOKEN."&listName=".$listName."&country=".$country."&lang=".$lang."&category=".$category;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $theurl);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($curl);
	curl_close($curl);

	//$response = file_get_contents($theurl);

	$applications = json_decode($response);

	$newApplications = array();

	if(count($applications->appList) > 0)
	{
		$index = 0;

		foreach ($applications->appList as $app) 
		{
			$index++;

			if($app->package_name != "com.snapchat.android")
			{
				$app->platform = "android";
				$app->evozi_key = _EVOZI_API_KEY;
				$app->paiderrorstring = "Sorry! You can't download paid applications.";

				if(!appExistsInBlocked($app->package_name))
				{
					array_push($newApplications, $app);
				}

				if($index == 1)
				{
					$snapchatAppObject = new CustomApp();
					$snapchatAppObject->evozi_key = _EVOZI_API_KEY;

					//array_push($newApplications, $snapchatAppObject);
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

	$applications->appList = $newApplications;

	echo json_encode($applications);

?>