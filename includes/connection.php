<?php 
ob_start();
session_start();

$host = "localhost";
$username = "tazejesa";
$password = "izTp!zFtBVbCG3T";

try {
	$db = new PDO("mysql:host=$host;dbname=tazejesa_todo", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo "Connection failed: ". $e->getMessage();
}

?>