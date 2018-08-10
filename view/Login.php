<html>
<head>
    <title>FileVault - Login</title>
    <link rel="stylesheet" type="text/css" href="view/css/header.css">
</head>
<body>
<?php include "Header.php"; ?>
<div class="container">

    <h2>Welcome to FileVault!</h2>
    <p>Login:</p>

    <form method="POST">
        <input type="hidden" name="action" value="login">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login" name="loginButton">
    </form>

    <a href="/register"><input type="submit" value="Register"></a>



</div>

</body>
</html>

