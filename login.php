<html>
    <head>
        <title>MC thing</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <section>
        <?php 
            include 'include/management.php';

            if (!empty($_GET["register"]) && $_GET["register"] == true) {
                echo "<p class='alert'> Now log in into your newly made account! </p>";
            }

            $read_query = "SELECT * FROM users";
            $result = mysqli_query($conn, $read_query);

            if (empty($_SESSION)) {
                $_SESSION = $_POST;
            }

            if (!empty($_POST["name"]) && !empty($_POST["pass"])) {

                $wrong = true;
    
                if( mysqli_num_rows($result) > 0 ){
                    while ($row = mysqli_fetch_assoc($result)) {
                        //echo json_encode($row);
                        if ($row["Name"] == $_POST['name']) {
                            $wrong = false;
                            if ($row["Password"] == $_POST['pass']) {
                                $_SESSION["user_info"] = $row;
                                header("Location: main.php");
                            } else {
                                echo "<p class='alert'> Wrong Pasword </p>";
                            }
                        }
                    }
                    if($wrong == true) {
                        echo "<p class='alert'> New User? </p>";
                    }
                }

            } elseif (empty($_POST["name"]) && !empty($_POST["pass"])) {
                echo "<p class='alert'> No name provided </p>";
    
            } elseif (!empty($_POST["name"]) && empty($_POST["pass"])) {
                echo "<p class='alert'> No password provided </p>";
            }
        ?>
            <form action="" method="post">
                <label >Name:</label><br>
                <input name="name"><br>
                <label >Pass:</label><br>
                <input name="pass"><br><br>
                <input type="submit">
            </form> 
            <div style="height: 100%;"></div>
        </section>
    </body>
</html>
