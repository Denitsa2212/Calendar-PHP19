
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
    $query = "SELECT * FROM `users` WHERE user_id = $aidi";
    $result = mysqli_query($conn, $query);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            ?><br>
                    <br>
                    <br>
                <section id="user_profile"> 
                    
                    <h2><?= $row["Name"]?>'s profile</h2>               
                    <?php 
                    echo  "Name: " . $row["Name"]. "<br>". "E-mail: ". $row["Mail"]. "<br>". "Date Created: ". $row["Created"];
                    ?>
                </section>
            <?php
        }
    }
    ?>

<?php 
    include 'include/footer.php';
?>
</body>
</html>
