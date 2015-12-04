<?php

   //laeme funktsiooni failis
   require_once("2function.php");
   
   // kas kasutaja on sisse loginud
   if(!isset($_SESSION["id_from_db"])) {
	   //suudan data lehel
	   header("Location: vlogin.php");
   }
   //login v2lja
   if(isset($_GET["logout"])){
	   // kustutab k6ik sessiooni muutujad
	   session_destroy();
	   
 
	   header("Location: vlogin.php");
	}   
   
	
   
   $clothes = $brand = $size = $color = $clotes_error = $brand_error = $size_error = $color_error = "";
   
   //kontrollime, kas on midagi tyhi
   
  if(isset($_POST["create"])){
		
		echo "vajutas create nuppu!";
		
		if ( empty($_POST["clothes"]) ) {
			$clothes_error = "See vali on kohustuslik";
		}else{
			$clothes= cleanInput($_POST["clothes"]);
		}
		
		if ( empty($_POST["brand"]) ) {
			$size_error = "See vali on kohustuslik";
		}else{
			$size = cleanInput($_POST["brand"]);
		}
		
		if ( empty($_POST["size"]) ) {
			$brand_error = "See vali on kohustuslik";
		}else{
			$brand = cleanInput($_POST["size"]);
		}
		
		if ( empty($_POST["color"]) ) {
			$color = "";
		}else{
			$color = cleanInput($_POST["color"]);
		}
		
		if($clothes_error == "" && $size_error == "" && $brand_error == "" ){
			
			// functions.php failis k3ivime funktsiooni
			//msg on message funktsioonist mis tagasi saadame
			$msg = createClothes ($clothes, $brand, $size);
			
			if($msg != ""){
				//salvestamine
				//teen tyhjaks input value's
				$clothes="";
				$size="";
				$brand = "";
				
				echo $msg;
			}
			
		}
 }  // create if end

   function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
   
  

?>

<p>
  Tere, <?php echo $_SESSION["email"];?>
  <a href= "?logout=1" >Logi valja</a>
</p>

<h2>Lisa riietus</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
   <label for="clothes" >Riietus</label><br>
  <input id="clothes" name="clothes" type="text" value="<?=$clothes; ?>"> <?=$clothes_error; ?><br><br>
    <label>Brand</label><br>
  <input name="brand" type="text" value="<?=$brand; ?>"> <?=$brand_error; ?><br><br>
    <label>Suurus</label><br>
  <input name="size" type="text" value="<?=$size; ?>"> <?=$size_error; ?><br><br>
    <label>Värv</label><br>
  <input name="color" type="text" value="<?=$color; ?>"><br><br>
  <input type="submit" name="create" value="save">
  </form>
  
  
  