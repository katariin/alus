<?php

          require_once("config.php");
	      $database = "if15_jekavor";
	function getSingeClothesData($edit_id){
		
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT clothes, brand, size, color FROM faschion WHERE id=? AND deleted is NULL");

		$stmt->bind_param("$i", $edit_id);
		$stmt->bind_result($clothes, $brand, $size, $color);
		$stmt->execute();
		
		//tekitan objekti
		$mode= new Stdclass();
		
		//saime yhe rea andmeid
		if($stmt->fetch()){
			//saan siin alles kasutada bind_result muutujaid
			$mode->clothes = $clothes;
			$mode->brand = $brand;
			$mode->size = $size;
			$mode->color = $color;
			
		}else{
			header("Location: taabel.php");
				
		}
		return $mode;
		
		$stmt->close();
		$mysqli->close();
	}
	
	
	   function updateClothes($id, $clothes, $brand, $size, $color){
	   $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	   $stmt = $mysqli->prepare("UPDATE fashion SET clothes=?, brand=?, size=?, color=? WHERE id=?");
	   $stmt->bind_param("sssi", $clothes, $brand, $size, $color, $id);
	   
	    // kas 6nnestus salvestada
	   
	    if($stmt->execute()) {
		   // 6nnestus
		   echo "hurraa";
		  
	    }
	   
	   $stmt->close();
		$mysqli->close();
	   
	   }
?>
