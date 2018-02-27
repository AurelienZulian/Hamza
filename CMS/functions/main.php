<?php 
include ("constants.php");

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

function generationOfKeyrandom($car) 
{
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

function generationOfPassword($mail, $sql)
{
	$generation = '';
	$nb_car = 12;
	$chaine = 'azertyuiopqsdfghjklmwxcvbn0123456789';
	$nb_lettres = strlen($chaine) - 1;

	for($i=0; $i < $nb_car; $i++)
	{
		$pos = mt_rand(0, $nb_lettres);
		$car = $chaine[$pos];
		$generation .= $car;
	}
	
    return $generation;
}

function sendMail($mail, $type, $mysqli) 
{
	$sendmail = true;
	switch($type)
	{
		case "pwd":
			$sql = "SELECT * FROM users WHERE email = '".$mail."';";
			$sql = $mysqli->query($sql);
			if ($sql->num_rows > 0)
			{
				$sql = $mysqli->fetch_array(MYSQLI_ASSOC);
				$newPwd = generationOfPassword($mail, $sql);
				$sqlUpdate = "UPDATE users SET `password` = '".sha1($newPwd)."';";
				$mysqli->query($sqlUpdate);
			}
			else
			{
				$sendmail = false;
			}
			$title = "Mot de passe oublié";
			$subject = "Mot de passe oublié";
			$corps = "<p>Bonjour,<br /><br />Vous recevez ce mail car vous venez de réinitialiser votre mot de passe.</p>
			<p>Votre nouveau mot de passe est <b>".$newPwd."</b>.<br /><br />Cordialement,<br />L'équipe ".$name_company.".</p>";
		break;
	}
	
     $message = "
     <html>
     	<head>
       		<title>".$title."</title>
      	</head>
      	<body>
       		".$corps."
      	</body>
     </html>
     ";

     // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

     // En-têtes additionnels
     $headers .= "To: ".$sql['firstname']." ".$sql['lastname']." <".$mail.">" . "\r\n";
     $headers .= "From: ".$name_application." <no-reply@".$name_application.".com>" . "\r\n";

     // Envoi

	if ($sendmail)
	{
		mail($mail, $subject, $message, $headers);
	}
}
?>