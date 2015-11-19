        <?php
        //edit.php
		require_once("edit_function7t.php");
		
		//kas kasutaja uundab andmeid
		if(isset($_POST["update"])){
			
			updateClothes($_POST["id"], $_POST["clothes"], $_POST["brand"], $_POST["size"], $_POST["color"]);
		}
		
		
		//id mida muudame
		if(!isset($_GET["edit"])){
		
	       //suudan table.php lehel
	       
		   header("Location: taabel.php");
		
		}else{	


          //saadan kaasa id
            $clothes_object = getSingeClothesData($_GET["edit"]);	
			var_dump($clothes_object);
		}	
		
?>
		
		
			<h2>Muuda faschion</h2>
	    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" ><br>
		<input type='hidden' name='id' value="<?=$_GET["edit"] ?>"><br>
		
			<label for="clothes" >clothes</label><br>
	    <input id="clothes" name="clothes" type="text" value="<?php echo $clothes_object->clothes;?>" ><br><br>
			<label for="brand" >brand</label><br>
	    <input id="brand" name="brand" type="text" value="<?php echo $clothes_object->brand;?>" ><br><br>
			<label for="size" >size</label><br>
	    <input id="size" name="size" type="text" value="<?php echo $clothes_object->size;?>" ><br><br>
			<label for="color" >color</label><br>
	    <input id="color" name="color" type="text" value="<?=$clothes_object->color;?>"><br><br>
  	
	    <input type="submit" name="update" value="Submit">
	    </form>
		
		
		
		
		
		
		