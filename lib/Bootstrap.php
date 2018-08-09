<?php

class Lib_Bootstrap {
    function __construct() {

        $url = "Home";

        if (isset($_GET["url"])) {
            $url = ucfirst($_GET["url"]);
        }
        $url = explode("/", $url);

        $controllerFile = "controller/" . $url[0] . ".php";
        if (file_exists($controllerFile)) {

            if ($this->checkLogin()) {
                require $controllerFile;
            } else {

                if (strtolower($url[0]) != "login") {
                    header("Location: /login");
                } else {
                    require "controller/Login.php";

                    $controller = new Controller_Login();
                    return false;
                }
            }
        } else {
            require "controller/ErrorPath.php";

            $controller = new Controller_ErrorPath();
            return false;
        }
        $ctrlTmp = "Controller_" . $url[0];

        $controller = new $ctrlTmp;

    }

    function checkLogin() {
        if (isset($_SESSION["user"])) return true;
        else return false;
    }
}