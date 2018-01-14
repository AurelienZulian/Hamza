<?php 
function isRecaptchaValid($code, $ip = null)
{
    $key_secret = "6LcwfT0UAAAAAKUzDEXBuJkETzgfpMZMz5pfT1dN"; // recaptcha private key
	if (empty($code)) {
		return false; // Si aucun code n'est entré, on ne cherche pas plus loin
	}
	$params = [
		'secret'    => $key_secret,
		'response'  => $code
	];
	if( $ip ){
		$params['remoteip'] = $ip;
	}
	$url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
	if (function_exists('curl_version')) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
		$response = curl_exec($curl);
	} else {
		// Si curl n'est pas dispo, un bon vieux file_get_contents
		$response = file_get_contents($url);
	}
 
	if (empty($response) || is_null($response)) {
		return false;
	}
 
	$json = json_decode($response);
	return $json->success;
}

function secu($var, $mysqli)
{
    return $mysqli->real_escape_string(htmlspecialchars($var));
}

function generationOfKeyrandom($car) {
	$string = "";
	$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	srand((double)microtime()*1000000);
	for($i=0; $i<$car; $i++)
	{
		$string .= $chaine[rand()%strlen($chaine)];
	}
	return $string;
}

// APPEL
// Génère une chaine de longueur 20
//$chaine = random(20);


?>