<?php

?>

<html>
    <head>
        <title>This is LoginPage!</title>
        <style>
            body {
                background-color: green;
            }
        </style>
    </head>
    <body>
        <h2>Welcome to FileVault!</h2>
        <p>Login:</p>

        <form action="#" method="POST">
            <input type="hidden" name="action" value="login">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Login" name="loginButton">
        </form>

    </body>
</html>
