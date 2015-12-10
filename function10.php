<?php
	require_once("dbase.php");
	require_once("Class.php");
	
	$database = "if15_jekavor";
	
	session_start();
	
	//loome ab'i ühenduse
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	//Uus instants klassist User
	$User = new User($mysqli);
	
	//var_dump($User->connection);
	
	
?>