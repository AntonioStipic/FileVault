<?php

class Controller_Home extends Lib_Controller {

    public $data;

    function __construct() {
        parent::__construct();

        $this->checkRequest();
        $this->getUser();

        $this->view->render("Home", $this->data);
    }

    function checkRequest() {
        if (isset($_POST["action"])) {
            $this->doAction($_POST["action"]);
        }
    }

    function doAction($action) {
        if ($action == "logout") {
            session_destroy();
            header("Location: /");
        }
    }

    function getUser() {
        $user = Model_Home::getUser();
        $this->data = $user;
    }
}