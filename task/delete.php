<?php 
include '../include/management.php'; 
    function here($where) {
        if ($where == true) {
            return "Deleting Task № " . $_GET["task_id"];  
        }
    }

//get task id, find and delete the task then redirect to main page
$task = $_GET["task_id"];
$conn->query("DELETE FROM tasks WHERE task_id=$task");

//header("Location: task.php?task_id=$task");
header("Location: ../main.php");
?>