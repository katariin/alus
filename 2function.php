<?php

     // yhendamine serviga
	  require_once("dbase.php");
      $database="if15_jekavor";
	 session_start();
	 
	// loome uue funktsiooni
       function createUser($name, $lastname, $create_email, $create_password_hash, $age, $gender) {
			
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
			
		$stmt = $mysqli->prepare("INSERT INTO users (name, lastname, email, password, age, gender) VALUES (?,?,?,?,?,?)");
		echo $mysqli->error;
		$stmt->bind_param("ssssis", $name, $lastname, $create_email, $create_password_hash, $age, $gender);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close();		
	}
	
	//logime sisse
	function loginUser($email, $password_hash){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM users WHERE id=? AND email = ?");
		$stmt->bind_param("is", $id, $email);
		$stmt->bind_result($id, $email_from_dbname);
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
	
	
	function create($clothes, $brand, $size, $color){
		// globals on muutuja koigist php failidest mis on uhendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO fashion (id, clothes, brand, size, color) VALUES (?,?,?,?,?)");
		$stmt->bind_param("issis", $_SESSION["id_from_dbname"], $id, $clothes, $brand, $size, $color);
		
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

	    
		
		
		
?>