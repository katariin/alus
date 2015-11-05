<?php

   //laeme funktsiooni failis
   require_once("2function.php");
   
   // kas kasutaja on sisse loginud
   if(!isset($_SESSION["id_from_dbname"])) {
	   //suudan data lehel
	   header("Location: loginv.php");
   }
   //login v2lja
   if(isset($_GET["logout"])){
	   // kustutab k6ik sessiooni muutujad
	   session_destroy();
	   
	   
	   header("Location: loginv.php");
	   
   }
   
   $bookname = $authorname = $authorlastname = $year = $bookname_error = $authorname_error = $authorlastname_error = ;
   
   //kontrollime, kas on midagi tyhi
   
  if(isset($_POST["create"])){
		
		echo "vajutas create nuppu!";
		
		if ( empty($_POST["book_name"]) ) {
			$bookname_error = "See vali on kohustuslik";
		}else{
			$bookname= cleanInput($_POST["book_name"]);
		}
		
		if ( empty($_POST["author_name"]) ) {
			$authorname_error = "See vali on kohustuslik";
		}else{
			$authorname = cleanInput($_POST["author_name"]);
		}
		
		if ( empty($_POST["author_lastname"]) ) {
			$authorlastname_error = "See vali on kohustuslik";
		}else{
			$authorlastname = cleanInput($_POST["author_lastname"]);
		}
		
		if ( empty($_POST["year"]) ) {
			$year = "";
		}else{
			$year = cleanInput($_POST["year"]);
		}
		
		if($bookname_error == "" && $authorname == ""){
			
			// functions.php failis k3ivime funktsiooni
			//msg on message funktsioonist mis tagasi saadame
			$msg=createBooks($bookname, $authorname, $authorlastname, $year);
			
			if($msg != ""){
				//salvestamine
				//teen tyhjaks input value's
				$bookname="";
				$authorname="";
				
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

<h2>Lisa auto</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
   <label for="bookname" >Raamatu nimetus</label><br>
  <input id="bookname" name="book_name" type="text" value="<?=$bookname; ?>"> <?=$bookname_error; ?><br><br>
    <label>Autori nimi</label><br>
  <input name="author_name" type="text" value="<?=$authorname; ?>"> <?=$authorname_error; ?><br><br>
    <label>Autori perekonnanimi</label><br>
  <input name="author_lastname" type="text" value="<?=$authorlastname; ?>"> <?=$authorastname_error; ?><br><br>
    <label>Raamatu publitseerimise aasta</label><br>
  <input name="year" type="text" value="<?=$year; ?>"><br><br>
  <input type="submit" name="create" value="save">
  </form>
  
  
  