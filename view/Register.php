<?php

?>

<html>
<head>
    <title>This is RegisterPage!</title>
    <style>
        body {
            background-color: goldenrod;
        }
    </style>
</head>
<body>
<h2>Welcome to FileVault!</h2>
<p>Register:</p>

<form action="#" method="POST">
    <input type="hidden" name="action" value="register">
    E-mail <input type="text" name="email"><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register" name="registerButton">
</form>

<a href="/login"><input type="submit" value="Login"></a>

</body>
</html>
