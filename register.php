<?php 
    include 'include/management.php';
    //dynamic title
    function here($where) {
        if ($where == true) {
            return "Registration";
        }
    }
?>
<section>
<?php
    $read_query = "SELECT * FROM users";
    $result = mysqli_query($conn, $read_query);
    //checking if form is empty
    if (!empty($_POST["name"]) && !empty($_POST["mail"]) && !empty($_POST["pass"]) && !empty($_POST["pass-conf"])) {
        //check if pass check checks chekcs out
        if ($_POST["pass"] == $_POST["pass-conf"]) {
            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $pass = $_POST["pass"];
            $now = date('Y-m-d');

            $conn->query("INSERT INTO `users` (`Name`, `Mail`, `Password`, `Created`) VALUES ('$name', '$mail', '$pass', '$now')");
            //once the account is created it redirects to the login page
            header("Location: login.php?register=true");
        } else {
            echo "<p class='alert'> Pass dont match </p>";
        }

    } else { 
        $numb = 0;
        if (empty($_POST["name"])) {
            $numb++;
        }
        if (empty($_POST["mail"])) {
            $numb++;
        }
        if (empty($_POST["pass"])) {
            $numb++;
        }
        if (empty($_POST["pass-config"])) {
            $numb++;
        }
        if ($numb < 4) {
            echo "<p class='alert'> You forgot something in the form!</p>";
        } 
    } 
?>

    <form action="" method="post">
        <label >Name:</label><br>
        <input name="name"><br>
        <label >Mail:</label><br>
        <input name="mail"><br>
        <label >Password:</label><br>
        <input name="pass" type="password"><br>
        <label >Confirm password:</label><br>
        <input name="pass-conf" type="password"><br><br>
        <input type="submit">
    </form> 
</section>
<?php 
    include 'include/footer.php';
?>