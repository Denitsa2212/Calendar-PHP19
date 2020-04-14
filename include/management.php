<html>
    <?php
        //connecting to the database
        $conn = mysqli_connect('localhost', 'root', '', 'scheduler');

        //session
        session_start();
    ?>
    <head>
        <title><?= here("title") //dynamic title ?></title>
        <?php 
        // check folder so it can apply css aproprietly
        if (preg_match("/\/task\//", $_SERVER["REQUEST_URI"])){
            //if in folder this happens
            echo '<link rel="stylesheet" type="text/css" href="../css/main.css">';
        } else {
            //if it aint in the folder this happnes
            echo '<link rel="stylesheet" type="text/css" href="./css/main.css">';
        }
        ?>
    </head>
    <nav>
        <p> <?= here("nav") ?> </p>
        <?php 
        // check folder so it can apply css aproprietly
        if (preg_match("/\/task\//", $_SERVER["REQUEST_URI"])){
            //if in folder this happens
            echo '<a href="../login.php?logout=true"> LogOut </a>';
            echo '<a href="../user.php"> User\'s Name </a>';
            echo '<a href="../main.php"> Tasks </a>';
        } else {
            //if it aint in the folder this happnes
            echo '<a href="./login.php?logout=true"> LogOut </a>';
            echo '<a href="./user.php"> User\'s Name </a>';
            echo '<a href="./main.php"> Tasks </a>';
        }
        ?>
    </nav>
    <body>