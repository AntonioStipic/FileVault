<?php

?>

<html>
    <head>
        <title>This is HomePage!</title>
        <link rel="stylesheet" type="text/css" href="view/css/header.css">
    </head>
    <body>
        <h2>Welcome to FileVault!</h2>
        <form action="#" method="post" class="logoutButton">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Log out">
        </form>

        <h3>Hello, <?php echo $data["username"]; ?>!</h3>


        <p>My files:</p>
    </body>
</html>
