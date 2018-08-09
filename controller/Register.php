<?php

class Controller_Register extends Lib_Controller {

    function __construct() {
        parent::__construct();

        if (isset($_SESSION["user"])) {
            header("Location: /");
        }

        $this->view->render("Register", []);

        $this->checkRequest();
    }

    public function register() {

        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(!is_null($email) && !is_null($username) && !is_null($password)) {
            Model_Register::register($email, $username, $password);
        }

    }

    function checkRequest() {
        if (isset($_POST["action"])) {
            $this->doAction($_POST["action"]);
            #echo $_POST["action"];
        }
    }

    function doAction($action) {
        if ($action == "register") {
            $this->register();
        }
    }


}