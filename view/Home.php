<?php

?>

<html>
    <head>
        <title>This is HomePage!</title>
        <style>
            body {
                background-color: yellow;
            }
        </style>
    </head>
    <body>
        <h2>Welcome to FileVault!</h2>
        <form action="#" method="post">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Log out">
        </form>

        <h3>Hello, <?php echo $data["username"]; ?>!</h3>
    </body>
</html>
