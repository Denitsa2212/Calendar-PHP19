<html>
    <head>
        <title>MC thing</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <?php 
            // configuration
            $file = './testing_file.txt';

            // check if form has been submitted
            if (isset($_POST['text'])) {
                // save the text contents
                file_put_contents($file, $_POST['text']);
            }
            // read the textfile
            $text = file_get_contents($file);
        ?>
        <section>
            <form action="" method="post">
                <label>Input:</label><br>
                <textarea name="text"><?php echo htmlspecialchars($text) ?></textarea>
                <input type="submit">
            </form> 
            <div style="height: 100%;"></div>
        </section>
    </body>
</html>