<?php 
    include '../include/management.php';
    //dynamic title
    function here($where) {
        if ($where == "title") {
            return $_SESSION["user_info"]["Name"] . "'s Porfile";
        } elseif ($where == "nav") {
            return "Your Porfile";
        }
    }

    $aidi = $_SESSION["user_info"]["user_id"];
    //task read
    $read_query = ("SELECT * FROM tasks WHERE user_id = $aidi");
    $read_result = mysqli_query($conn, $read_query);

    echo "<section>";
    echo "<h2>" . $_SESSION["user_info"]["Name"] . "'s profile</h2>";                     
    echo "<p> Name: " . $_SESSION["user_info"]["Name"] . "</p>"; 
    echo "<p> E-mail: ". $_SESSION["user_info"]["Mail"]. "</p>"; 
    echo "<p> Date Created: ". $_SESSION["user_info"]["Created"] . "</p>";
    echo "<p>Total tasks: ". mysqli_num_rows($read_result) ."</p>";

    echo "<p><a href='./settings.php'> Settings </a></p>";
    echo '<a href="../login.php?logout=true"> LogOut </a>';
    echo "</section>";

    include '../include/footer.php';
?>