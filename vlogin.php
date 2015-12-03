<?php

     // Teen errori muutujad
	      //siiselogimine
	$email_error = "";
	$password_error = "";
	      //create users
    $name_error="";
    $gender_error="";	
    $create_email_error = "";
	$create_password_error = "";		 
	
	//Teen vaartuse muutujad
	$age = "";
	$name ="";
	$lastname="";
	$email = "";
	$password="";
	$gender = "";
	$comment="";
	$create_email ="";
	$create_password="";
	
	
	
		if($_SERVER["REQUEST_METHOD"] == "POST") {
    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){
			
			echo "Vajutas log in nuppu!";
			
			if ( empty($_POST["email"]) ) {
				$email_error = "E-mail on kohustuslik";
			}else{
				$email = test_input($_POST["email"]);
			}
			
			if ( empty($_POST["password"]) ) {
				$password_error = "Parool on kohustuslik";
			}else{
				$password = test_input($_POST["password"]);
			}
      // Kui oleme siia joudnud, voime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Saab sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
			}
		}
    // *********************
    // ** LOO KASUTAJA *****
    // *********************
    if(isset($_POST["create"])){
		
		echo "vajutas create nuppu!";
		
		if (empty($_POST["name"]) ) {
			$name_error = "Nimi on kohustuslik";
		  }else{
			$name= test_input($_POST["name"]);
		}
		      //Kontrollime, kas nimi sisaldab ainult t2hed
			  
		if(!preg_match ("/^[a-zA-Z]*$/", $name)){
			$name_error = "Only letters allowed";
		}	  
			  
		
		if ( empty($_POST["lastname"]) ) {
			$lastname_error = "See vali on kohustuslik";
		  }else{
			$lastname = test_input($_POST["lastname"]);
		}
		
		if ( empty($_POST["create_email"]) ) {
			$create_email_error = "E-mail on kohustuslik";
		}else{
			$create_email = test_input($_POST["create_email"]);
		}
		
		if ( empty($_POST["create_password"]) ) {
			$create_password_error = "See vali on kohustuslik";
		}else{
			if(strlen($_POST["create_password"]) < 8) {
				$create_password_error = "Peab olema vahemalt 8 tahemarki pikk!";
			}else{
				$create_password = test_input($_POST["create_password"]);
			}
		}
		if (empty($_POST["age"])) {
			$age= " ";
		}else{
			$age = test_input($_POST["age"]);   
		}
		
		if ( empty($_POST["gender"]) ) {
			$gender_error = "See vali on kohustuslik";
		}else{
			$gender = test_input($_POST["gendrer"]);
		}
		
		if ( empty($_POST["comment"]) ) {
			$comment = " ";
		}else{
			$comment = test_input($_POST["commet"]);
		}
		
		
		if(	$create_email_error == "" && $create_password_error == ""){
			echo "Saab kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password;
			
			$password_hash = hash("sha512", $create_password);
			echo "<br>";
			echo $password_hash;
      }
    } // create if end
	}
	
  // funktsioon, mis eemaldab koikvoimaliku uleliigse tekstist
  function test_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }




    // siin kirjutame uut php koogdi  

    /*
	
	//(kehtestame) m22rame email'i vigu
	
	set_error_handler("email_error", E_USER_WARNING);
	
	// vigu k2imapanek
    $email != 0;
	if(isset($email == 0"]){
		
		trigger_error("Vaartus peab olema vahemalt uhest t2htest", E_USER_WARNING);	
	}
	
	*/
?>




<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	E-mail: <input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br><br>
  	Parool: <input name="password" type="password" placeholder="Parool" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br>
  	<input type="submit" name="login" value="Login">
  </form>

  <h2>Create user</h2>
  <p><span style ="color:red" class ="error"> * required field </span></p>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
             <label>Eesnimi</label>
  	Eesnimi: <input name="name" type="text" placeholder="Eesnimi"><span style ="color:red" class ="error">**<?php echo $name_error; ?></span><br><br>
	Perekonnanimi: <input name="lastname" type="text" placeholder="Perekonnanimi"><br><br>
	E-mail: <input name="create_email" type="email" placeholder="E-post"> <span style ="color:red" class ="error">*<?php echo $create_email_error; ?> </span> <br><br>
	Parool: <input name="create_password" type="password" placeholder="Parool"> <span style ="color:red" class ="error">*<?php echo $create_password_error; ?> </span> <br><br>
  	Vanus : <input name="age" type="text" placeholder="vanus" value="<?php echo $age; ?>"> <br><br>
	Sugu: <input name="gender" type="radio" value="Naine">Female
          <input name="gender" type="radio" value="Mees">Male <span style ="color:red" class ="error">*<?php echo $gender_error; ?></span> <br><br>
	Kommentaar: <textarea name="comment" rows="5" cols ="30"></textarea><br><br>
  	 Submit:   <input type="submit" name="create" value="Create">
  </form>
<body>
<html>