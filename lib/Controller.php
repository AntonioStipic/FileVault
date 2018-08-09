<?php

class Lib_Controller {
    function __construct() {
        #echo "This is Main Controller!<br>";


        $this->model = new Lib_Model();
        $this->view = new Lib_View();

        $this->checkLogin();
    }

    function checkLogin() {
        if (isset($_SESSION["user"])) {
            #echo "User is logged in!";
        } else {
            #echo "User is not logged in!";
        }
        #echo $_SESSION;
    }

}