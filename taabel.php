<?php


          //taabel.php
		  require_once("funktsioon6t.php");
          require_once("edit_function7t.php");

         //kasutaja tahab midagi muuta
		  if(isset($_POST["update"])){
			  
			  updateClothes($_POST["id"], $_POST["clothes"], $_POST["brand"], $_POST["size"], $_POST["color"]);
		  }		  
		  
		  //kasutaja tahab midagi kustutada
		  if(isset($_GET["delete"])){
			  
			  //saadan kaasa id, mida kustutada
			  deleteClothes($_GET["delete"]);
			  
		  }
		  
		  
         $clothes_list=getClothes();
		  
?>		  

<table border=1>
<tr>
    <th>id</th>
	<th>kasutaja id</th>
	<th>Clothes</th>
	<th>Brand</th>
	<th>Size</th>
	<th>Color</th>
	<th>X</th>
	
   <?php
	                   //iga massiivis olema elemendi kohta
					   //count($clothes_list) - massiiivi pikkus
			for($i = 0; $i < count($clothes_list); $i++){
						   
						if (isset($_GET["edit"]) && $clothes_list[$i]->id == $GET["edit"]){
							  //kasutajale muutmiseks
							 echo"<tr>";
							   echo "<form action='taabel.php' method='post'>";
							   echo"<form>";
							           echo "<td>". $clothes_list[$i]->id."</td>";
						               echo "<td>". $clothes_list[$i]->user_id."</td>";
									   echo "<td><input name='clothes' value='" . $clothes_list[$i]->clothes."'></td>";
									   echo "<td><input name='brand' value='" . $clothes_list[$i]->brand."'></td>";
                                       echo "<td><input name='size' value='" . $clothes_list[$i]->size."'></td>";
                                       echo "<td><input name='color' value='" . $clothes_list[$i]->color."'></td>";
                                       echo "<td><input type='submit', name='update'></td>";
                                       echo "<td><a href='taabel.php'>cancel</a></td>";									   
							   echo"</form>";
							   echo"<tr>Seda rida muudetakse</tr>";
							 echo"</tr>";
					}else{
						   echo"<tr>";
						   
						   echo "<td>". $clothes_list[$i]->id."</td>";
						   echo "<td>". $clothes_list[$i]->user_id."</td>";
						   echo "<td>". $clothes_list[$i]->clothes."</td>";
						   echo "<td>". $clothes_list[$i]->brand."</td>";
						   echo "<td>". $clothes_list[$i]->size."</td>";
						   echo "<td>". $clothes_list[$i]->color."</td>";
						   echo "<td><a href='?delete=". $clothes_list[$i]->id."'>X</a></td>";
						   echo "<td><a href='?edit=". $clothes_list[$i]->id."'>edit</a></td>";
			
				
						   echo"</tr>";
					}
			}		   
	
   ?>
</table>