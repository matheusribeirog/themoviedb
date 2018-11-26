<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>The Movie DB - API</title>
</head>
<body>
	<?php
	global $contador; /* Essa Variável será utilizada  para contar quantos filmes serão mostrados na tela*/
	$curl = curl_init();
	/*Realizando a conexão com a API*/
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.themoviedb.org/3/movie/popular?api_key=YourKeyHERE",//add your the movie db key here
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
	} else { /*Caso a conexão seja feita com sucesso ele roda o código abaixo */
	    /* Decodifica o JSON */
		$obj = json_decode($response);

		foreach($obj->{'results'} as $valor){	
			print_r ("<br> <img width='150px' src='https://image.tmdb.org/t/p/w500/".$valor->{'poster_path'}."'>".'<br>'); /* Concatena a imagem para ser mostrada na tela */
			print_r ('<br> <h1>'.$valor->{'original_title'}.'</h1>');
			print_r ('<p>'.$valor->{'overview'}.'</p>');	
			if ($contador >= 20){ /*Esse contador estipula quantos filmes serão mostrados na tela*/
				break;
			}
			$contador ++;
		}

	}
	
</body>
</html>



