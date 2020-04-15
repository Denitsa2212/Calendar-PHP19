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

    //display said task
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            //echo json_encode($row) . "<br>";
            echo "<article>";
            echo "<h3>". $row["Title"] ."</h3>";
            //checking and giving a status to the task
            if (strtotime($row["Due"]) <= strtotime($row["Created"]) && $row["Done"] == 0) {
                $tag = "<p> Missing" ."</p>";
            } elseif (strtotime($row["Due"]) <= strtotime($row["Created"]) && $row["Done"] == 1) {
                $tag = "<p>Done Late" ."</p>";
            }else {
                if ($row["Done"] == 0) {
                    $tag = "<p> Not Done" ."</p>";
                } else {
                    $tag = "<p> Done" ."</p>";

                }
            }
            echo "<p> Created:". $row["Created"] . " - Due:" . $row["Due"] ."</p>". $tag;
            echo "<p>". $row["Description"] ."</p>";
            //task options
            if ($row["Done"] == 0) {
                echo "<p><a href='./done.php?task_id=". $row["task_id"] ."&done=".$row["Done"] ."'> Mark as Done </a></p>";
            } else {
                echo "<p><a href='./done.php?task_id=". $row["task_id"] ."&done=".$row["Done"] ."'> Mark as Undone </a></p>";
            }
            echo "<p><a href='./edit.php?task_id=". $row["task_id"] ."'> Edit </a></p>";
            echo "<p><a href='./delete.php?task_id=". $row["task_id"]."'> delete </a></p>";
            echo "</article>";
        }
    }
?>
</section>
<?php 
    include '../include/footer.php';
?>
