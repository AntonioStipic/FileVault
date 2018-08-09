<?php

class Controller_ErrorPath extends Lib_Controller {
    function __construct() {
        parent::__construct();

        $uri = $_SERVER['REQUEST_URI'];


        $this->view->render("ErrorPath", $uri);
    }
}