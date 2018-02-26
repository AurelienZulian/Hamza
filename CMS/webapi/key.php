<?php
include ("../functions/config.php");
include ("../functions/main.php");

$val = false;

if (isset($_GET["mac"]))
{
	if ($_GET["mac"] != NULL)
	{
		$sql = "SELECT * FROM licenses, historic WHERE key_use > 0 AND mac = '".secu($_GET["mac"], $mysqli)."';";
		$licenses = $mysqli->query($sql);
		
		while($row_licenses = $licenses->fetch_assoc())
		{
			if ($row_licenses["date_end"] > time())
			{
				$val = true;
			}
		}
		header('Content-Type: application/json');
		$arr = array('key' => $val);

		echo json_encode($arr);
	}	
}
?>