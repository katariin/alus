<?php
	
	require_once("session.php");
	
	$_SESSION["name"] = "Katrin";
	
	echo($_SESSION["name"]);
?>