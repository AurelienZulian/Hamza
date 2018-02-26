<?php
include ("../functions/config.php");
include ("../functions/main.php");

//add security system
$val = false;

if (isset($_GET["mac"]) && isset($_GET["key"]))
{
	if ($_GET["mac"] != NULL && $_GET["key"] != NULL)
	{
		$result_license = $mysqli->query("SELECT * FROM licenses WHERE activation_key = '".secu($_GET['key'], $mysqli)."' AND mac = '';");
		
		while($row_licenses = $result_license->fetch_assoc())
		{
			$mysqli->query("UPDATE licenses SET mac = '".secu($_GET['mac'], $mysqli)."';");
			$val = true;
		}
	}
	header('Content-Type: application/json');
	$arr = array('key' => $val);
	echo json_encode($arr);
}
?>