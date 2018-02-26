<?php
include ("http://hisocom.net/hamza/functions/config.php");

$val = false;

if (isset($_GET["k"]))
{
	if ($_GET["k"] != NULL)
	{
		$sql = "SELECT * FROM licenses, types_licenses WHERE key_use > 0";
		$licenses = $mysqli->query($sql);
		
		/*while($row_licenses = $licenses->fetch_assoc())
		{
			if (($row_licenses["time_suscribe"] + $row_licenses["date_activation"]) < time())
			{
				$val = true;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($val);*/
	}	
}
?>