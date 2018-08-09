<?php

class Controller_Login extends Lib_Controller {
    function __construct() {
        parent::__construct();

        $this->view->render("Login", []);

        $this->checkRequest();
    }

    public function login() {

        $username = $_POST["username"];
        $password = $_POST["password"];

        if(!is_null($username) AND !is_null($password)) {
            Model_Login::login($username, $password);
        }

    }

    function checkRequest() {
        if (isset($_POST["action"])) {
            $this->doAction($_POST["action"]);
            #echo $_POST["action"];
        }
    }

    function doAction($action) {
        if ($action == "login") {
            $this->login();
        }
    }
}
