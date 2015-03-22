<?php
	require_once("config.php");
	header("Content-Type : application/json");
	$API_URL = sprintf("%s?method=%s&api_key=%s&format=json&nojsoncallback=1",$BASE_API_URL,"flickr.photos.search",$API_KEY);
	$action = $_GET["action"];
	$per_page = 20;

	switch($action){
		case 1:
			$text = $_GET["text"];
			$requestUrl = sprintf("%s&text=%s&per_page=%s&sort=interestingness-desc",$API_URL,$text,$per_page);
			break;
		case 2:
			$lat = $_GET["lat"];
			$lon = $_GET["lon"];
			$requestUrl = sprintf("%s&lat=%s&lon=%s&per_page=%s&sort=interestingness-desc&radius=1",$API_URL,$lat,$lon,$per_page);
			break;
	}	
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $requestUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$output = curl_exec($ch);	
	curl_close($ch);
	echo json_encode(json_decode($output,true));
?>