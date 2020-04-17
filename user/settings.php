<?php 
    include '../include/management.php';
    //dynamic title
    function here($where) {
        if ($where == "title") {
            return $_SESSION["user_info"]["Name"] . "'s Settings";
        } elseif ($where == "nav") {
            return "Settings";
        }
    }

    //prep for user edit
    $aidi = $_SESSION["user_info"]["user_id"];
    $query = "SELECT * FROM `users` WHERE user_id = $aidi";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user_info"] = $row;
    $txtname = $row["Name"];
    $txtmail = $row["Mail"];

    if (!empty($_POST["name"])) {
        $name = $_POST["name"];
        $conn->query("UPDATE `users` SET `Name`='$name' WHERE `user_id`='$aidi'");
    } 
    if (!empty($_POST["mail"])) {
        $mail = $_POST["mail"];
        $conn->query("UPDATE `users` SET`Mail`='$mail' WHERE `user_id`='$aidi'");
    }
    //when done with everything and some feild was edited go back to task page
    if (!empty($_POST["name"]) || !empty($_POST["mail"])) {
        header("Refresh:0");
    }

    if (!empty($_POST["old-pass"]) && !empty($_POST["new-pass"]) && !empty($_POST["new-pass-conf"])) {
        if ($_POST["old-pass"] == $_SESSION["user_info"]["Password"] && $_POST["new-pass"] == $_POST["new-pass-conf"]) {
            $pass = $_POST["new-pass"];
            $conn->query("UPDATE `users` SET`Password`='$pass' WHERE `user_id`='$aidi'");
        } else {
            echo "<p class='alert'> Passowrds dont match </p>";
        }
    }

    echo "<section>";
    echo "<h2>Settings page</h2>";
    echo "Current <br> Style: ". ucfirst(substr($_SESSION["settings"][0], 0, -4)) . "<br> Order: " . $_SESSION["settings"][1];
    
    echo "<form method='post'>";
    echo "<h3>Style and order</h3>";
    echo "<select name='style'>";
    foreach (array_slice(scandir("../css"), 2) as $value) {
        if ($once == false) {
            echo "<option value='none'> Select a style </option>";
            $once = true;
        }
        echo "<option value='$value'>". ucfirst(substr($value, 0, -4)) ."</option>";
    }
    echo "</select>";
    ?>
        <select name="order">
            <option value='none'> Select task order </option>
            <option value='Title'> Alphabetical </option>
            <option value='Created'> By Date created </option>
            <option value='Due'> By Date Due </option>
        </select>
        <br><input type='submit'>
    </form>
    <hr>
    <form method='post'>
        <h3>User info</h3>
        <label >Title:</label><br>
        <textarea name="name"><?php echo htmlspecialchars($txtname) ?></textarea><br>
        <label >Mail:</label><br>
        <textarea name="mail"><?php echo htmlspecialchars($txtmail) ?></textarea><br>
        <input type='submit'>
    </form>
        <hr>
    <form method='post'>
        <h3>Password</h3>
        <label >Old Password:</label><br>
        <input type='password' name="old-pass"></input><br>
        <label >New Password</label><br>
        <input name="new-pass"></input><br>
        <label >Confirm new Password:</label><br>
        <input name="new-pass-conf"></input><br>
        <br><input type='submit'>
    </form>
    <?php
    echo "</form>";
    echo "</section>";

    if (!empty($_POST["style"])) {
        if ($_POST["style"] != "none") {
            $_SESSION["settings"][0] = $_POST["style"];
            header("Refresh:0");
        }
    }
        
    if (!empty($_POST["order"])) {
        if ($_POST["order"] != "none") {
            $_SESSION["settings"][1] = $_POST["order"];
            header("Refresh:0");
        }
    }

    include '../include/footer.php';
?>