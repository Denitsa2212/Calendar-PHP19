<?php 
    include '../include/management.php';
    //dynamic title
    function here($where) {
        if ($where == true) {
            return "Task № " . $_GET["task_id"]; 
        }
    }
?>
<div style="height: 5%"> </div>
<section>
<?php    
    //get the selected task
    $task = $_GET["task_id"];
    $read_query = ("SELECT * FROM tasks WHERE task_id = $task");
    $result = mysqli_query($conn, $read_query);
    $row = mysqli_fetch_assoc($result);

    if (empty($_GET["type"])) {
        $_GET["type"] = "all";
    }

    switch ($_GET["type"]) {
        case 'done':
            if (taging($row) == "Done" || taging($row) == "Done Late") {
                display($row);
            }
            break;
        case 'missed':
            if (taging($row) == "Missing") {
                display($row);
            }
            break;
        case 'upcoming':
            if (taging($row) == "For Today" || taging($row) == "Within A Week" || taging($row) == "Upcoming") {
                display($row);
                $none++;
            }
            break;
        default:
            display($row);
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
        echo "<h3>". $row["Title"] ."</h3>";
        echo "<p class='tag'>". taging($row) ."</p>";
        echo "<p class='dates'> Created: ". $row["Created"] . " Due: " . $row["Due"] ."</p>";
        
        //nl2br prints the linebreaks
        echo "<p class='description'>". nl2br($row["Description"]) ."</p>";
        echo "</article>";
    }

    function taging($row) {
        if (strtotime(date('Y-m-d')) > strtotime($row["Due"]) && $row["Done"] == 0) {
            return "Missing";
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

    function missing($type) {
        echo "<article class='notasks'>";
        echo "<p> You dont have any $type tasks.</p>";
        echo "</article>";
    }


    //task options
    echo "<div class='options'>";
    if ($row["Done"] == 0) {
        echo "<p class='markdone'><a href='./done.php?task_id=". $row["task_id"] ."&done=".$row["Done"] ."'> Mark as Done </a></p>";
    } else {
        echo "<p class='markundone'><a href='./done.php?task_id=". $row["task_id"] ."&done=".$row["Done"] ."'> Mark as Undone </a></p>";
    }
    echo "<p class='edit'><a href='./edit.php?task_id=". $row["task_id"] ."'> Edit </a></p>";
    echo "<p class='delete'><a href='./delete.php?task_id=". $row["task_id"]."'> Delete </a></p>";
    echo "</div></article>";
?>
</section>
<div style="height: 5%"> </div>
<?php 
    include '../include/footer.php';
?>
