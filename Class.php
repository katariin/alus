<?php
class User {
	
	//privaatne muutuja, saan kasutada klassi sees
	private $connection;
	
	//funktsioon, mis k�ivitub siis kui
	// on ! NEW User();
	function __construct($mysqli){
		
		// selle klassi muutuja
		$this->connection = $mysqli;
	}
	
	function createUser($name, $lastname, $create_email, $password_hash, $age, $gender){
		
		//teen objekti, et saata tagasi kas errori (id, message) v�i successi (message) 
		$response = new StdClass();
		//kas selline email on juba olemas?
		$stmt = $this->connection->prepare("SELECT id, email FROM users WHERE id =? AND email = ?");
		$stmt->bind_param("is", $id, $create_email);
		$stmt->execute();
		
		//kas oli 1 rida andmeid
		if($stmt->fetch()){
			
			// saadan tagasi errori
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Sellise e-postiga kasutaja juba olemas!";
			
			//panen errori responsile k�lge
			$response->error = $error;
			
			// p�rast returni enam koodi edasi ei vaadata funktsioonis
			return $response;
			
		}
	
		//*************************
		//******* OLULINE *********
		//*************************
		//panen eelmise k�su kinni
		$stmt->close();
	
		$stmt = $this->connection->prepare("INSERT INTO users (name, lastname, email, password, age, gender) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssis", $name, $lastname, $create_email, $password_hash, $age, $gender);
		
		if($stmt->execute()){
			// edukalt salvestas
			$success = new StdClass();
			$success->message = "Kasutaja edukalt salvestatud";
			
			$response->success = $success;
			
		}else{
			// midagi l�ks katki
			$error = new StdClass();
			$error->id =1;
			$error->message = "Midagi l�ks katki!";
			
			//panen errori responsile k�lge
			$response->error = $error;
		}
		
		$stmt->close();
		
		//saada tagasi vastuse, kas success v�i error
		return $response;
	
	}
	
	function loginUser($email, $password_hash){
		
		$response = new StdClass();
		//kas selline email on juba olemas?
		$stmt = $this->connection->prepare("SELECT email FROM users WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		
		// ei ole sellist kasutajat - !
		if(!$stmt->fetch()){
			
			// saadan tagasi errori
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Sellise e-postiga kasutajat ei ole olemas!";
			
			//panen errori responsile k�lge
			$response->error = $error;
			
			// p�rast returni enam koodi edasi ei vaadata funktsioonis
			return $response;
			
		}
	
		$stmt->close();
		
		$stmt = $this->connection->prepare("SELECT id, email FROM users WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $password_hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			// edukalt sai k�tte
			$success = new StdClass();
			$success->message = "Kasutaja edukalt sisse logitud";
			
			$user = new StdClass();
			$user->id = $id_from_db;
			$user->email = $email_from_db;
			
			$success->user = $user;
			
			$response->success = $success;
			
		}else{
			// midagi l�ks katki
			$error = new StdClass();
			$error->id =1;
			$error->message = "Vale parool!";
			
			//panen errori responsile k�lge
			$response->error = $error;
		}
		
		$stmt->close();
		
		return $response;
	}
	
} ?>