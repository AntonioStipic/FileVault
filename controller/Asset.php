<?php

class Controller_Asset extends Lib_Controller {

    public $data;


    function __construct() {
        parent::__construct();

        $this->getUser();



        if (isset($_GET["id"])) {
            $fileId = $_GET["id"];

            $this->checkOwnership($fileId);
        } else {

        }

        $this->view->render("Asset", $this->data);

    }

    function getUser() {
        $user = Model_Home::getUser();

        if ($user == "guest") {
            $this->data["user"]["username"] = "guest";
        } else {
            $this->data["user"] = $user;
        }
    }

    function checkOwnership($fileId) {
        $file = new Model_File($fileId);
//        echo $file->public;
        if ($file->public == "true") {
//            echo "it is public";

            $showFile = $file->getPublicFile();

            $this->data["file"] = $showFile;
        } else {
//            echo "it is not public";

            if (!isset($_SESSION["user"])) {
                $this->data["message"] = '{"success": false, "message": "You must sign in to access this file!"}';
            } else {
                $userUuid = $_SESSION["user"];

                $file = new Model_File("");

                $asset = $file->checkOwnership($fileId, $userUuid);



                if ($asset == "false") {
                    echo "<br>You don't have access to this file!";
                    $this->data["message"] = '{"success": false, "message": "You don\'t have access to this file!"}';
                } else {
                    $this->data["file"] = $asset;
                    $this->data["message"] = '{"success": true, "message": ""}';
                }
            }
        }
    }
}
