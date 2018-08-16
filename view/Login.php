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
        <h4 class="loginTitle">Sign In</h4>
        <form method="POST">
            <input type="hidden" name="action" value="login">
            <label><i>Username: </i> </label><input type="text" name="username" class="loginInput">
            <br><br>
            <label><i>Password: </i> </label><input type="password" name="password" class="loginInput">
            <br>
            <a id="forgot">Forgot password?</a>
            <br><br>
            <input type="submit" value="Sign In" class="blueButton">
        </form>

        <a id="signup" href="/register">Sign Up</a>
        <br>
    </div>

</div>

</body>
</html>

