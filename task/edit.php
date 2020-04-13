<html>
    <head>
        <title>MC thing</title>
        <link rel="stylesheet" type="text/css" href="../main.css">
    </head>
    <body>
        <section>
        <?php
            include '../include/management.php'; 
            
            $task = $_GET["task_id"];
            $read_query = ("SELECT * FROM tasks WHERE task_id = $task");
            $result = mysqli_query($conn, $read_query);

            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    //echo json_encode($row) . "<br>";
                    $txttitle = $row["Title"];
                    $txtdue = $row["Due"];
                    $txtdesc = $row["Description"];
                }
            }

            if (!empty($_POST["title"])) {

                $title = $_POST["title"];

                //$conn->query("UPDATE `tasks` SET `Title`='$title', `Description`='$desc', `Due`=$due WHERE task_id='$task'");
                $conn->query("UPDATE `tasks` SET `Title`='$title' WHERE task_id='$task'");
            }
            
            if (!empty($_POST["due"])) {
                $due = $_POST["due"];

                $conn->query("UPDATE `tasks` SET `Due`='$due' WHERE task_id='$task'");
            } 
            
            if (!empty($_POST["desc"])) {
                $desc = $_POST["desc"];

                $conn->query("UPDATE `tasks` SET `Description`='$desc' WHERE task_id='$task'");
            }

            if (!empty($_POST["title"]) || !empty($_POST["due"]) || !empty($_POST["desc"])) {
                header("Location: task.php?task_id=$task");
            }
            
        ?>

            <form action="" method="post">
                <label >Title:</label><br>
                <textarea name="title"><?php echo htmlspecialchars($txttitle) ?></textarea><br>
                <label >Due:</label><br>
                <input type="date" name="due" value=<?php echo $txtdue?>><br>
                <label >Description:</label><br>
                <textarea name="desc"><?php echo htmlspecialchars($txtdesc) ?></textarea><br>
                <input type="submit">
            </form> 
        </section>
    </body>
</html>
