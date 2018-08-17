<?php

class Controller_Asset extends Lib_Controller {

    public $data;
    protected $actions = ["download"];

    function __construct() {
        parent::__construct();

        $this->getUser();

        $this->checkRequest();

        if (isset($_GET["id"])) {
            $fileId = $_GET["id"];

            $this->checkOwnership($fileId);
        } else {

        }

        $this->view->render("Asset", $this->data);

    }

    function checkRequest() {
        if (isset($_POST["action"]) && in_array($_POST["action"], $this->actions)) {
            $this->doAction($_POST["action"]);
        }
    }

    function doAction($action) {
        if ($action == "download") {
            $this->download($_POST["fileId"]);
        }
    }

    function download($fileId) {
        $file = new Model_File($fileId);
        $path = $file->path;

        $file->downloaded();
//        $this->__construct();

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($path).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
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
            $this->data["message"] = '{"success": true, "message": ""}';
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
