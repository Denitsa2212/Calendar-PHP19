<html>
    <head>
        <title>MC thing</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>
    <body>
        <section>
        <?php
            include '../include/management.php'; 

            echo "<a href='../main.php'>All tasks</a>";
            
            $task = $_GET["task_id"];
            $read_query = ("SELECT * FROM tasks WHERE task_id = $task");
            $result = mysqli_query($conn, $read_query);

            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    //echo json_encode($row) . "<br>";
                    echo "<article>";
                    echo "<h3>". $row["Title"] ."</h3>";
                    echo "<p> Created:". $row["Created"] . " - Due:" . $row["Due"] . " " . strtotime($row["Due"]) ."</p>";
                    echo "<p>". $row["Description"] ."</p>";

                    echo "<p><a href='./edit.php?task_id=". $row["task_id"] ."'> Edit </a></p> <br>";
                    echo "<p><a href='./delete.php?task_id=". $row["task_id"] ."'> delete </a></p>";
                    echo "</article>";
                }
            }

            if (!empty($_POST["title"])) {

                $title = $_POST["title"];

                //$conn->query("UPDATE `tasks` SET `Title`='$title', `Description`='$desc', `Due`=$due WHERE task_id='$task'");
                $conn->query("UPDATE `tasks` SET `Title`='$title' WHERE task_id='$task'");
            } 
            
            if ( !empty($_POST["due"])) {
                $due = $_POST["due"];

                $conn->query("UPDATE `tasks` SET `Due`='$due' WHERE task_id='$task'");
            } 
            
            if (!empty($_POST["desc"])) {
                $desc = $_POST["desc"];

                $conn->query("UPDATE `tasks` SET `Description`='$desc' WHERE task_id='$task'");
            }
            
        ?>
        </section>
    </body>
</html>
