<?php

     // yhendamine serviga
	  require_once("dbase.php");
      $database="if15_jekavor";
	 session_start();
	 
	// loome uue funktsiooni
        function createUser($name, $lastname, $create_email, $create_password_hash, $age, $gender, $comment){ {
			
			$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]);
			
			$stmt = $mysqli->prepare("INSERT INTO 'users' ('fname', 'lname', 'email', 'password', 'age', 'gender') VALUES ('Katarina', 'Merr', 'katmerr@gmail.com', '"md5("123kat")"', 21, 'N')");
		$stmt->bind_param("ss", $name, $lastname, $create_email, $create_password_hash, $age, $gender);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close();		
	}
	
	//logime sisse
	function loginUser($email, $password_hash){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM users WHERE email=?");
		$stmt->bind_param("ss", $email, $password_hash);
		$stmt->bind_result($id_from_dbname, $email_from_dbname);
		$stmt->execute();
		
		if($stmt->fetch()){
			echo "kasutaja id=".$id_from_dbname;
			
			$_SESSION["id_from_dbname"] = $id_from_dbname;
			$_SESSION["email"] = $email_from_dbname;
			
			//suunan kasutaja data.php lehele
			header("Location: 3data.php");
			
			
		}else{
			echo "Wrong password or email!";
		}
		$stmt->close();
		
		$mysqli->close();
	}
	
	
	function createBooks($bookname, $authorname, $authorlastname, $year){
		// globals on muutuja koigist php failidest mis on uhendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO books (id, bookname, authorname, authorlastname, year) VALUES (?, 'Vee peal', 'Olavi', 'Ruitlane', '1982')");
		$stmt->bind_param("iss", $_SESSION["id_from_dbname"], $bookname; $authorname; $authorlastname $year );
		
		$message = "";
		
		if($stmt->execute()){
			// see on toene siis kui sisestus ab'i onnestus
			$message = "Edukalt sisestatud andmebaasi";
			
		}else{
			// execute on false, miski laks katki
			echo $stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $message;
		
	}

	    }
		
		
		
?>