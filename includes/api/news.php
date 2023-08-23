<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://bing-news-search1.p.rapidapi.com/news/search?q=latest%20news%20nigeria&freshness=Day&textFormat=Raw&safeSearch=Off",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-BingApis-SDK: true",
		"X-RapidAPI-Host: bing-news-search1.p.rapidapi.com",
		"X-RapidAPI-Key: 1306216a98mshf1f2c2f714606dcp17a627jsn4b3fd3cef40c"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {

	$datas = json_decode($response, true);
	
	$datas = $datas["value"];
foreach($datas as $keys => $value){
	echo '
	<div class="col-xs-6 col-sm-4">
	<div class="card">
    <a href="'.$value["url"].'">
	<img  src="'. $value["image"]["thumbnail"]["contentUrl"].'" />
    <div  class="card-content">
	<h5 class="card-title">
		<a href="'.$value["url"].'">'.$value["name"].'</a>
	</h5>
	<p class="">
	'. $value["description"].'
	</p>
    <h6 class="mb-0"></h6>
    <p class="mb-0 opacity-75">'. $value["description"].'</p>
  </div>

        
    </a></div></div>';
}



                    
                    

}