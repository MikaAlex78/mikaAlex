<?php
   
   ini_set('display_errors', 0);
   ini_set('display_startup_errors', 0);
   error_reporting(0);

    
    $url='https://disease.sh/v3/covid-19/countries/'. $_REQUEST['countryCodeA2'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);

	$result=curl_exec($ch);

	curl_close($ch);
    $covid = json_decode($result,true);

    //output status
    $output['status']['code'] = "200";
    $output['status']['name'] = "ok";
    $output['status']['description'] = "success";
    $output['status']['executedIn'] = intval((microtime(true) - $executionStartTime) * 1000) . " ms";
    
    $output['data']['covidData'] = $covid;

    echo json_encode($output);
?>