<?php

class Controller_Action extends Lib_Controller {

    protected $actions = ["logout", "upload", "download", "delete", "rename", "sort", "search"];

    function __construct() {
        parent::__construct();

        $this->checkRequest();

    }

    function checkRequest() {
//        print_r($_POST);
        if (isset($_POST["action"]) && in_array($_POST["action"], $this->actions)) {
            $this->doAction($_POST["action"]);
        } else {
            echo "401: Denied";
        }
    }

    function doAction($action) {
        if ($action == "logout") {
            session_destroy();
            header("Location: /");
        } else if ($action == "upload") {
            $this->upload();
        } else if ($action == "download") {
            $this->download($_POST["fileId"]);
        } else if ($action == "delete") {
            $this->deleteFile($_POST["fileId"]);
        } else if ($action == "rename") {
            $this->renameFile($_POST["fileId"], $_POST["fileName"]);
        } else if ($action == "sort") {
            $this->sort($_POST["sortBy"]);
        } else if ($action == "search") {
            header("Location: /home?search=" . $_POST["phrase"]);
        }

    }


    function download($fileId) {
        $file = new Model_File($fileId);
        $path = $file->path;

        echo $path;
    }

    function renameFile($fileId, $fileName) {
        $file = new Model_File($fileId);

        if ($file->renameFile($fileName)) {
            $data = '{"success": true}';
            echo $data;
        } else {
            $data = '{"success": false}';
            echo $data;
        }
    }

    function deleteFile($fileId) {
        $file = new Model_File($fileId);

//        unlink

        $path = $file->path;
        if (unlink($path)) {


            if ($file->deleteFile($fileId)) {
                $data = '{"success": true}';
                echo $data;
            } else {
                $data = '{"success": false}';
                echo $data;
            }
        }
    }
}