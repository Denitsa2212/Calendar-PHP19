<html>
    <?php
        //connecting to the database
        $conn = mysqli_connect('localhost', 'root', '', 'scheduler');

        //session
        session_start();

        //session defoult settings
        if (empty($_SESSION["settings"])) {
            $_SESSION["settings"] = ["main.css", "Title"];
        }
    ?>
    <head>
        <title><?= here("title") //dynamic title ?></title>
        <?php 
        // check folder so it can apply css aproprietly
        if (preg_match("/\/task\//", $_SERVER["REQUEST_URI"])){
            //if in folder this happens
            echo '<link rel="stylesheet" type="text/css" href="../css/'.$_SESSION["settings"][0].'">';
        } elseif (preg_match("/\/user\//", $_SERVER["REQUEST_URI"])){
            //if in folder this happens
            echo '<link rel="stylesheet" type="text/css" href="../css/'.$_SESSION["settings"][0].'">';
        } else {
            //if it aint in the folder this happnes
            echo '<link rel="stylesheet" type="text/css" href="./css/'.$_SESSION["settings"][0].'">';
        }
        ?>
    </head>
    <nav>
        <p> <?= here("nav") ?> </p>
        <?php 
        // dyncamic nav - not every page needs the same nav bar
        if (preg_match("/\/task\//", $_SERVER["REQUEST_URI"])){
            //if in folder "tasks" this happens
            echo '<a href="../user/user.php"> '. $_SESSION["user_info"]["Name"] .' </a>';
            echo '<a href="../main.php"> Tasks </a>';
        } elseif (preg_match("/\/user\//", $_SERVER["REQUEST_URI"])){
            //if in folder "user" this happens
            echo '<a href="../user/user.php"> '. $_SESSION["user_info"]["Name"] .' </a>';
            echo '<a href="../main.php"> Tasks </a>';
        } elseif (preg_match("/\/login.php/", $_SERVER["REQUEST_URI"])) {
            //if in login this happens
            echo '<a href="./login.php"> Login </a>';
            echo '<a href="./register.php"> Register </a>';
        } elseif (preg_match("/\/register.php/", $_SERVER["REQUEST_URI"])) {
            //if in register" this happens
            echo '<a href="./login.php"> Login </a>';
            echo '<a href="./register.php"> Register </a>';
        } else {
            //if in none of the above then they are in the main page so its cool
            echo '<a href="./user/user.php"> '. $_SESSION["user_info"]["Name"] .' </a>';
            echo '<a href="./main.php"> Tasks </a>';
        }
        ?>
    </nav>
    <body>