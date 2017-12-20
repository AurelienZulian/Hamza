<?php	

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "hamza");

$mysqli =  new mysqli(HOST, USER, PASSWORD, DATABASE);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$mysqli->query("SET NAMES UTF8");

?>