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
    <form action="" method="post">
        <label >Title:</label><br>
        <input name="title"><br>
        <label >Due:</label><br>
        <input type="date" name="due"><br>
        <label >Description:</label><br>
        <input name="desc"><br><br>
        <input type="submit">
    </form> 

    <?php 
    //check form if empty
    if (!empty($_POST["title"]) && !empty($_POST["due"]) && !empty($_POST["desc"])) {

        $title = $_POST["title"];
        $desc = $_POST["desc"];
        $due = $_POST["due"];
        $now = date('Y-m-d');

        $conn->query("INSERT INTO `tasks` (`user_id`, `Title`, `Description`, `Created`, `Due`, `Done`) VALUES ('$aidi', '$title', '$desc', '$now', '$due', '0')");
    } //elseif ($soon) { }

    //prep for task display, getting user aidi and soritng
    $aidi = $_SESSION["user_info"]["user_id"];
    $read_query = ("SELECT * FROM tasks WHERE user_id = $aidi");
    $result = mysqli_query($conn, $read_query);

    //display of sorted tasks
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<article>";
            //make the title a link when clicked you can go to details about the task
            echo "<h3><a href='./task/task.php?task_id=". $row["task_id"] ."'>". $row["Title"] ."</a></h3>";
            echo "<p> Created:". $row["Created"] . " - Due:" . $row["Due"] ."</p>";
            echo "<p>". $row["Description"] ."</p>";
            echo "</article>";
            echo "<hr>";
        }
    }
    ?>
    <div style="height: 100%;"></div>
</section>
<?php 
    include 'include/footer.php';
?>