<?php 
include '../include/management.php'; 

$task = $_GET["task_id"];

$conn->query("DELETE FROM tasks WHERE task_id=$task");

//header("Location: task.php?task_id=$task");
header("Location: ../main.php");