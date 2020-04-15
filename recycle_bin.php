 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<?php 
 	include 'include/management.php';
    //dynamic title
 	function here($where) {
 		if ($where == "title") {
 			return $_SESSION["user_info"]["Name"] . "'s Porfile";
 		} elseif ($where == "nav") {
 			return "Your Porfile";
 		}
 	}
 	?>
 </head>
 <body>
 	<?php
 	$aidi = $_SESSION["user_info"]["user_id"];
 	$query = "SELECT * FROM `tasks` WHERE `Done` = 1 AND `user_id` = ". $aidi;
 	$result = mysqli_query($conn, $query);
 	if(mysqli_num_rows($result )){
 		$num = 1;	
 		while( $row = mysqli_fetch_assoc($result)){ 
 			?>
 			<section>
 			<?php
 			echo "<h4>".$row["Title"]."</h4>";
 			echo "<p>".mb_strimwidth($row["Description"], 0, 60, '...')."</p>";
			echo "</section>";

 		}
 	}
 	?>
 </body>
 </html>