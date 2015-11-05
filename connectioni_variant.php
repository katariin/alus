<?php

         require_once("dbbase.php");
		 $dbname="users";
		 
		 //create connection_aborted
		 $conn = mysqli_connect($servername, $username, $password, $dbname);
		 
		 // check connection_aborted
		 if(!$conn) {
			 die ("Connection failed: ".mysqli_connect_error());
		 }
 
         //prepare and bind_textdomain_codeset
		 $stmt->$conn->prepare("INSERT INTO 'users' ('fname', 'lname', 'email', 'password', 'age', 'gender') VALUES ('Katarina', 'Merr', 'katmerr@gmail.com', '"md5("123kat")"', 21, 'N')");
         $stmt->bind_param("iss", $name, $lastname, $email, $password, $age, $gender);
		 $stmt->execute();
		 $stmt->close();
		 mysqli_close($conn);
?>