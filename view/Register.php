<?php

?>

<!--<html>
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

<form method="POST">
    <input type="hidden" name="action" value="register">
    E-mail <input type="text" name="email"><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register" name="registerButton">
</form>

<a href="/login"><input type="submit" value="Login"></a>

</body>
</html>-->



<html>
<head>
    <title>FileVault - Login</title>
    <link rel="stylesheet" type="text/css" href="view/css/header.css">
    <link rel="stylesheet" type="text/css" href="view/css/login.css">
</head>
<body>
<?php include "Header.php"; ?>
<div class="container">

    <!-- <h2>Welcome to FileVault!</h2>
    <p>Login:</p> -->

    <!-- <form method="POST">
        <input type="hidden" name="action" value="login">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login" name="loginButton">
    </form>

    <a href="/register"><input type="submit" value="Register"></a> -->

    <div class="loginForm">
        <h4 class="loginTitle">Sign Up</h4>
        <form method="POST">
            <input type="hidden" name="action" value="register">
            <label><i>Email: </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input type="text" name="email" class="loginInput">
            <br><br>
            <label><i>Username: </i> </label><input type="text" name="username" class="loginInput">
            <br><br>
            <label><i>Password: </i> </label><input type="password" name="password" class="loginInput">
            <br><br>
            <input type="submit" value="Sign Up" class="blueButton">
        </form>
        <a id="signup" href="/login">Sign In</a>
        <br>
    </div>

</div>

</body>
</html>


