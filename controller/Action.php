<?php

class Controller_Action extends Lib_Controller {

    protected $actions = ["logout", "upload", "download", "delete", "rename", "sort", "search", "shareRecommed", "share"];

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
        } else if ($action == "delete") {
            $this->deleteFile($_POST["fileId"]);
        } else if ($action == "rename") {
            $this->renameFile($_POST["fileId"], $_POST["fileName"]);
        } else if ($action == "sort") {
            $this->sort($_POST["sortBy"]);
        } else if ($action == "search") {
            header("Location: /home?search=" . $_POST["phrase"]);
        } else if ($action == "shareRecommed") {
            $this->findUser($_POST["name"]);
        } else if ($action == "share") {
            $this->shareFile($_POST["fileId"], $_POST["users"]);
        }

    }

    function findUser($name) {
        $user = new Model_User("");

        $users = $user->findUser($name);

        $users = json_encode($users);

        print_r($users);
    }

    function shareFile($fileId, $users) {
        echo $fileId;

//        print_r($users);

        $users = str_replace("<b>", "", $users);
        $users = str_replace("</b>", "", $users);

        $usernames = explode(", ", $users);

        $file = new Model_File("");

        if ($file->shareFile($fileId, $usernames)) {
            echo "Yes";
        } else {
            echo "No";
        }
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