<?php

	require_once("includes/initialize.php");

	ini_set('max_execution_time', '300');

	$packagename = "";

	if(isset($_GET['packagename']))
	{
		$packagename = $_GET['packagename'];
	}

	if(isset($_POST['packagename']))
	{
		$packagename = $_POST['packagename'];
	}

	$theurl = "http://api.evozi.com/apk-downloader/download";

	// $fields = array
	// (
	// 		'packagename' => urlencode($packagename),
	// 		'api_key' => urlencode(_EVOZI_API_KEY)
	// );

	// //url-ify the data for the POST
	// foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	// rtrim($fields_string, '&');

	// $ch = curl_init();
	// curl_setopt($ch,CURLOPT_URL, $theurl);
	// curl_setopt($ch,CURLOPT_POST, count($fields));
	// curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $response = curl_exec($ch);
	// curl_close($ch);

	// $postdata = http_build_query(
	//     array(
	//         'packagename' => $packagename,
	//         'api_key' => _EVOZI_API_KEY
	//     )
	// );

	// $opts = array('http' =>
	//     array(
	//         'method'  => 'POST',
	//         'header'  => 'Content-type: application/x-www-form-urlencoded',
	//         'content' => $postdata
	//     )
	// );

	// $context  = stream_context_create($opts);

	// $response = file_get_contents($theurl, false, $context);

	$myvars = 'api_key=' . _EVOZI_API_KEY . '&packagename=' . $packagename;

	$ch = curl_init( $theurl );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);

	var_dump($response);

?>
