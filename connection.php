<?php
         // Sozdajem funkcqju dlja  $result_set = $mysqli->query("SELECT * FROM 'users'");
		 function printResult($result_set) {
			 echo "Kolichestvo zapisej ravno - ".$result_set->num_rows. "<br>";
			 //fetch_assoc() - berjot vse dannqe, parametrq pervoj zapisi. Vse oni budut peredanq v peremennuju 'row'. Toestj 'row' stanet massivom. ( V 'row' zapisqvajutsa vse znachenija polej- dannqh iz bazq dannqh)
			 // kak tolko budet 'false' eto oznachaet, chto vse dannqe uze (iz cqcla) vqvedenq. Poetomu proverjajem, ne ravno li ono 'false'
		      while (($row = result_set->fetch_assoc()) != false) {
			     echo $row;    
				 echo "<br>"
			  }
			  
		 }
		 
		 $mysqli = new mysqli("localhost", "if15", "ifikad15", "users");
		 // posqlaem zapros
		 $mysqli->query ("SET NAMES 'utf8'");
		 
		 $mysqli->query ("INSERT INTO 'users' ('fname', 'lname', 'email', 'password', 'age', 'gender') VALUES ('Katarina', 'Merr', 'katmerr@gmail.com', '"md5("123kat")"', 21, 'N')");
		 
		 
		 // chtobq dobavitj 10 polzovatelej
	//	 for ($i =1; $i < 10; $++) {
	//	      $mysqli->query ("INSERT INTO 'users' ('fname', 'lname', 'email', 'password', 'age', 'gender') VALUES ('$i', '$i', '$i', '"md5("$i")"', $i, '')");
	//	 }
		 
		 $result_set = $mysqli->query("SELECT * FROM 'users'");
		 printResult($result_set);
		 
		// $result_set = $mysqli->query("SELECT 'fname', 'email' FROM 'users' WHERE id>2");
		// printResult($result_set);
		 
         $mysqli->close();

?>