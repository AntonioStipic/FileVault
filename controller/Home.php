<?php

class Controller_Home extends Lib_Controller {

    public $data;

    function __construct() {
        parent::__construct();

        $this->checkRequest();
        $this->getUser();
        $this->getFiles();

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
        } else if ($action == "download") {
            $this->download($_POST["fileId"]);
        } else if ($action == "delete") {
            $this->deleteFile($_POST["fileId"]);
        }
    }

    function download($fileId) {
        $file = new Model_File($fileId);
        $path = $file->path;

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($path).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }

    function upload() {

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
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            echo "<script>console.log('file too big')</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            echo "";
            try {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

                $fileName = $_FILES["fileToUpload"]["name"];
                echo "The file ". basename($fileName). " has been uploaded.";

                $fileUpload = new Model_UploadFile($fileName, $fileSecure);

                $fileUpload->uploadToDatabase($target_file);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                echo "<script>console.log('" . $e->getMessage() . "')</script>";
            }
            /* if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $fileName = $_FILES["fileToUpload"]["name"];
                echo "The file ". basename($fileName). " has been uploaded.";

                $fileUpload = new Model_UploadFile($fileName, $fileSecure);

                $fileUpload->uploadToDatabase($target_file);

            } else {
                echo "Sorry, there was an error uploading your file.";
            } */
        }

//        header("Location: /");
    }

    function deleteFile($fileId) {
        $file = new Model_File($fileId);

//        unlink

        $path = $file->path;
        if (unlink($path)) {


            if ($file->deleteFile($fileId)) {
                header("Location: /");
            } else {
                header("Location: /error");
            }
        }
    }

    function getUser() {
        $user = Model_Home::getUser();
        $this->data["user"] = $user;
    }

    function getFiles() {
        $files = Model_Home::getFiles();
        $this->data["files"] = $files;
    }
}