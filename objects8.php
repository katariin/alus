<?php
	
	$user = new StdClass();
	
	$user->name = "Katrin";
	$user->gender = "female";
	
	
	var_dump($user);
	
	$user->name = "Ann";
	
	echo("<br>");
	echo($user->name);
	
	
	//error
	
	$error = new StdClass();
	
	
	$error->id = 0;
	$error->message("Unknown error");
	
	$error->id = 2;
	$error->message("Wrong password");	
	
?>