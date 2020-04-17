<?php 
include '../include/management.php'; 
    function here($where) {
        if ($where == true) {
            return "Deleting Task № " . $_GET["task_id"];  
        }
    }
?>
<section>
    <form action="" method="post">
        <label >Type "delete" below to confirm</label><br>
        <input name="delete"><br>
        <input type="submit">
    </form> 
</section>
<?php

if (!empty($_POST["delete"]) && $_POST["delete"] == "delete") {
    //get task id, find and delete the task then redirect to main page
    $task = $_GET["task_id"];
    $conn->query("DELETE FROM tasks WHERE task_id=$task");

    //header("Location: task.php?task_id=$task");
    header("Location: ../main.php");
}
?>