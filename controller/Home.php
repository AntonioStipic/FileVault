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

    function checkRequest() {;
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
        } else if ($action == "rename") {
            $this->renameFile($_POST["fileId"], $_POST["fileName"]);
        } else if ($action == "sort") {
            $this->sort($_POST["sortBy"]);
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

        $target_dir = "uploads/" . $_SESSION["user"] . "/" . date("Y") . "/" . date("m") . "/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $fileNam;







        $extension = substr($fileName, strpos($fileName, "."));

        $name = substr($fileName, 0, strlen($fileName) - strlen($extension));

        if ($name == "") {
            $name = $extension;
            $extension = "";
        }

        $counter = 0;
        $checkFile = "";
        $newPath = $target_dir;
        while (file_exists($target_dir . $name . $checkFile . $extension)) {
            echo "Nope, file exists";
            $counter += 1;
            $checkFile = " (" . $counter . ")";

        }

        $name = $name . $checkFile;
        $newPath = $target_dir . $name . $extension;






        $uploadOk = 1;
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            echo "<script>console.log('file too big')</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            try {
                try {
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newPath);
                } catch (Exception $err) {
                    echo 'Caught exception: ',  $err->getMessage(), "\n";
                    echo "<script>console.log('" . $err->getMessage() . "')</script>";
                }

                $fileName = $name . $extension;

                $fileUpload = new Model_UploadFile($fileName, $fileSecure);
                $fileUpload->uploadToDatabase($newPath);
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

        header("Location: /");
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

    function renameFile($fileId, $fileName) {
        $file = new Model_File($fileId);

        if ($file->renameFile($fileName)) {
            header("Location: /");
        } else {
            header("Location: /error");
        }
    }

    function sort($sortBy) {
        $this->data["sortBy"] = $sortBy;
//        $this->view->render("Home", $this->data);

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