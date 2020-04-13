<html>
    <head>
        <title>MC thing</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <section>
        <?php 
            include 'include/management.php';

            $read_query = "SELECT * FROM users";
            $result = mysqli_query($conn, $read_query);

            if (!empty($_POST["name"]) && !empty($_POST["mail"]) && !empty($_POST["pass"]) && !empty($_POST["pass-conf"])) {

				if ($_POST["pass"] == $_POST["pass-conf"]) {
					$name = $_POST["name"];
					$mail = $_POST["mail"];
					$pass = $_POST["pass"];
					$now = date('Y-m-d');
	
					$conn->query("INSERT INTO `users` (`Name`, `Mail`, `Password`, `Created`) VALUES ('$name', '$mail', '$pass', '$now')");

					header("Location: login.php?register=true");
				} else {
					echo "<p class='alert'> Pass dont match </p>";
				}

            }// elseif ($soon) {}
        ?>

			<form action="" method="post">
                <label >Name:</label><br>
                <input name="name"><br>
                <label >Mail:</label><br>
                <input name="mail"><br>
                <label >Password:</label><br>
				<input name="pass"><br>
				<label >Confirm password:</label><br>
                <input name="pass-conf"><br><br>
                <input type="submit">
            </form> 
            <div style="height: 100%;"></div>
        </section>
    </body>
</html>