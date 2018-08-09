<?php

?>

<html>
    <head>
        <title>This is HomePage!</title>
        <link rel="stylesheet" type="text/css" href="view/css/header.css">
    </head>
    <body>
        <?php include "Header.php"; ?>
        <div class="container">
            <h2>Welcome to FileVault!</h2>


            <h3>Hello, <?php echo $data["user"]["username"]; ?>!</h3>


            <p>My files:</p>
            <?php

            for ($i = 0; $i < count($data["files"]); $i++) {
                echo $data["files"][$i]["title"] . $data["files"][$i]["extension"];

                echo '<form method="POST">
                <input type="hidden" name="action" value="download">
                <input type="hidden" name="fileId" value="' . $data["files"][$i]["uuid"] . '">
                <input type="submit" value="Download" name="download">
            </form>';
            }


            ?>


            <br><br>
            <form method="post" class="uploadButton" enctype="multipart/form-data">
                <input type="hidden" name="action" value="upload">
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                Public: <input type="checkbox" name="secure"><br>
                <input type="submit" value="Upload file">
            </form>

        </div>

    </body>
</html>
