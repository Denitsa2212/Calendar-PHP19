<html>
    <head>
        <title>MC thing</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
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
            include 'include/management.php'; 

            $aidi = $_SESSION["user_info"]["user_id"];


            if (!empty($_POST["title"]) && !empty($_POST["due"]) && !empty($_POST["desc"])) {

                $title = $_POST["title"];
                $desc = $_POST["desc"];
                $due = $_POST["due"];
                $now = date('Y-m-d');

                $conn->query("INSERT INTO `tasks` (`user_id`, `Title`, `Description`, `Created`, `Due`, `Done`) VALUES ('$aidi', '$title', '$desc', '$now', '$due', '0')");
            } //elseif ($soon) { }

            // echo json_encode($_SESSION["user_info"]);
            // echo "<br> <br>";
            
            $read_query = ("SELECT * FROM tasks WHERE user_id = $aidi");
            $result = mysqli_query($conn, $read_query);

            echo "<br> <br>";
            if( mysqli_num_rows($result) > 0 ){
                while ($row = mysqli_fetch_assoc($result)) {
                    //echo json_encode($row) . "<br>";
                    echo "<article>";
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
    </body>
</html>