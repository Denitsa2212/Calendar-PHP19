<?php 
    include '../include/management.php';
    //dynamic title
    function here($where) {
        if ($where == true) {
            return "Task № " . $_GET["task_id"]; 
        }
    }
?>
<section>
<?php    
    //get the selected task
    $task = $_GET["task_id"];
    $read_query = ("SELECT * FROM tasks WHERE task_id = $task");
    $result = mysqli_query($conn, $read_query);
    $row = mysqli_fetch_assoc($result);

    //display said task
    echo "<article>";
    echo "<h3>". $row["Title"] ."</h3>";
    echo "<p> Created:". $row["Created"] . " - Due:" . $row["Due"] . " " . taging($row) ."</p>";
    echo "<p>". nl2br($row["Description"]) ."</p>";

    function taging($row) {
        if (strtotime(date('Y-m-d')) > strtotime($row["Due"]) && $row["Done"] == 0) {
            return "Missing";
        } elseif (strtotime(date('Y-m-d')) > strtotime($row["Due"]) && $row["Done"] == 1) {
            return "Done Late";
        } else {
            if (strtotime(date('Y-m-d')) == strtotime($row["Due"]) && $row["Done"] == 0) {
                return "For Today";
            } elseif (strtotime($row["Due"]) - strtotime(date('Y-m-d')) < 604800 && $row["Done"] == 0) {
                return "Within A Week " . when($row);
            } elseif ($row["Done"] == 0) {
                return "Upcoming " . when($row);
            } else {
                return "Done";
            }
        }
    }

    function when($row) {
        return "(" . (strtotime($row["Due"]) - strtotime(date('Y-m-d'))) / 86400 . " Days)";
    }

    //task options
    if ($row["Done"] == 0) {
        echo "<p><a href='./done.php?task_id=". $row["task_id"] ."&done=".$row["Done"] ."'> Mark as Done </a></p>";
    } else {
        echo "<p><a href='./done.php?task_id=". $row["task_id"] ."&done=".$row["Done"] ."'> Mark as Undone </a></p>";
    }
    echo "<p><a href='./edit.php?task_id=". $row["task_id"] ."'> Edit </a></p>";
    echo "<p><a href='./delete.php?task_id=". $row["task_id"]."'> Delete </a></p>";
    echo "</article>";
?>
</section>
<?php 
    include '../include/footer.php';
?>
