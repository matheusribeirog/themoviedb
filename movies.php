<?php
global $contador;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.themoviedb.org/3/movie/popular?api_key=67c0954e550e9963ea2935f24fe3db55&language=en-US&page=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
  
  
	$obj = json_decode($response);
	
	foreach($obj->{'results'} as $valor){	
		print_r ("<br> <img width='150px' style='float:right;' src='https://image.tmdb.org/t/p/w500/".$valor->{'poster_path'}."'>".'<br>');
		print_r ('<br> <h1>'.$valor->{'original_title'}.'</h1>');
		print_r ('<p>'.$valor->{'overview'}.'</p>');	
		if ($contador >= 10){
			break;
		}
		$contador ++;
	}
	
}



