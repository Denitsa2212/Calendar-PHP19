<?php 
    include 'include/management.php';
    //dynamic title
    function here($where) {
        if ($where == "title") {
            return $_SESSION["user_info"]["Name"] . "'s Tasks";
        } elseif ($where == "nav") {
            return "All Tasks";
        }
    }
?>
<section>
    <?php
        //prep for task display, getting user aidi and soritng
        $aidi = $_SESSION["user_info"]["user_id"];
        $order = $_SESSION['settings'][1];
        $read_query = ("SELECT * FROM tasks WHERE user_id = $aidi ORDER BY $order");
        $result = mysqli_query($conn, $read_query);

        //check form if empty
        if (!empty($_POST["title"]) && !empty($_POST["due"]) && !empty($_POST["desc"])) {

            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $due = $_POST["due"];
            $now = date('Y-m-d');
    
            $conn->query("INSERT INTO `tasks` (`user_id`, `Title`, `Description`, `Created`, `Due`, `Done`) VALUES ('$aidi', '$title', '$desc', '$now', '$due', '0')");
        } else { 
            $numb = 0;
            if (empty($_POST["title"])) {
                $numb++;
            }
            if (empty($_POST["due"])) {
                $numb++;
            }
            if (empty($_POST["desc"])) {
                $numb++;
            }
            if ($numb < 3) {
                echo "<p class='alert'> You forgot something in the form!</p>";
            } 
        } 
    ?>
    <form action="" method="post">
        <label >Title:</label><br>
        <input name="title"><br>
        <label >Due:</label><br>
        <input type="date" name="due"><br>
        <label >Description:</label><br>
        <textarea name="desc"></textarea><br><br>
        <input type="submit">
    </form> 

    <div class="nav-2">
        <a href="./main.php">All</a>
        <a href="./main.php?type=done">Done</a>
        <a href="./main.php?type=missed">Missed</a>
        <a href="./main.php?type=upcoming">Upcoming</a>
    </div>

    <?php

    if (empty($_GET["type"])) {
        $_GET["type"] = "all";
    }

    switch ($_GET["type"]) {
        case 'done':
            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    if (taging($row) == "Done" || taging($row) == "Done Late") {
                        display($row);
                    }
                }
            }
            break;
        case 'missed':
            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    if (taging($row) == "Missing") {
                        display($row);
                    }
                }
            }
            break;
        case 'upcoming':
            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    if (taging($row) == "For Today" || taging($row) == "Within A Week" || taging($row) == "Upcoming") {
                        display($row);
                    }
                }
            }
            break;
        default:
            //display of sorted tasks
            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    display($row);
                }
            }
        break;
    }

    function display($row) {
        switch (taging($row)) {
            case taging($row) == "Done" || taging($row) == "Done Late":
                echo "<article class = 'done'>";
                break;
            case taging($row) == "Missing":
                echo "<article class = 'missing'>";
                break;
            case taging($row) == "For Today" || taging($row) == "Within A Week" || taging($row) == "Upcoming":
                echo "<article class = 'coming'>";
                break;
        }
        echo "<h3><a href='./task/task.php?task_id=". $row["task_id"] ."'>".mb_strimwidth($row["Title"], 0, 80, '...') ."</a></h3>";
        echo "<p> Created:". $row["Created"] . " - Due:" . $row["Due"] . " " . taging($row) ."</p>";
        //nl2br prints the linebreaks
        echo "<p>". nl2br(mb_strimwidth($row["Description"], 0, 300, '...')) ."</p>";
        echo "</article>";
        echo "<hr>";
    }

    function taging($row) {
        if (strtotime(date('Y-m-d')) > strtotime($row["Due"]) && $row["Done"] == 0) {
            return "Missing";
        } elseif (strtotime(date('Y-m-d')) > strtotime($row["Due"]) && $row["Done"] == 1) {
            return "Done Late";
        } else {
            if (strtotime(date('Y-m-d')) == strtotime($row["Due"]) && $row["Done"] == 0) {
                return "For Today";
            } elseif (strtotime($row["Due"]) - strtotime(date('Y-m-d')) < 604800 && $row["Done"] == 0) {
                return "Within A Week";
            } elseif ($row["Done"] == 0) {
                return "Upcoming";
            } else {
                return "Done";
            }
        }
    }

    ?>
</section>
<?php 
    include 'include/footer.php';
?>