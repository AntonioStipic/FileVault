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
        } else if ($action == "upload") {
            $this->upload();
        }
    }

    function upload() {


        $fileSecure = "";
        if (isset($_POST["secure"])) {
            $fileSecure = "true";
        } else {
            $fileSecure = "false";
        }

        $target_dir = "uploads/" . date("Y") . "/" . date("m") . "/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $fileName = $_FILES["fileToUpload"]["name"];
                echo "The file ". basename($fileName). " has been uploaded.";

                $fileUpload = new Model_UploadFile($fileName, $fileSecure);

                $fileUpload->uploadToDatabase($target_file);

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    function getUser() {
        $user = Model_Home::getUser();
        $this->data = $user;
    }
}