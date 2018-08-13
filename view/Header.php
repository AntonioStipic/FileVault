<div class="header">
    <a href="/"><img src="view/asset/logo.png" class="logoImage"></a>

    <div class="width5vw notClickable"></div>

    <div class="headerButton" <?php echo (!isset($_SESSION["user"]))?"hidden":""; ?>>
        <form action="/home" method="post" class="headerButtonChild">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Logout" class="nakedButton">
        </form>
    </div>

    <div class="headerButton" <?php echo (isset($_SESSION["user"]))?"hidden":""; ?>>
        <form action="/login" method="post" class="headerButtonChild">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Login" class="nakedButton">
        </form>
    </div>

    <div class="headerButton">
        <form action="/" class="headerButtonChild">
            <input type="submit" value="Home" class="nakedButton">
        </form>
    </div>

    <!-- <div class="headerButton">
        <form method="post" class="">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Log out">
        </form>
    </div>

    <div class="headerButton">
        <form method="post" class="">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Log out">
        </form>
    </div> -->
</div>