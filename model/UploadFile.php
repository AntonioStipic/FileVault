<?php

class Model_UploadFile {
    protected $fileName;
    protected $fileSecure;

    function __construct($fileName, $fileSecure) {
        $this->fileName = $fileName;
        $this->fileSecure = $fileSecure;
    }

    function uploadToDatabase($path) {
        $db = new DB_Connection();
        $conn = $db->conn;

        $uuid = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        $owner = $_SESSION["user"];
        $extension = substr($this->fileName, strpos($this->fileName, "."));

        $name = substr($this->fileName, 0, strlen($this->fileName) - strlen($extension));

        if ($name == "") {
            $name = $extension;
            $extension = "";
        }

        $datetime = date("Y-m-d H:i:s");


        $stmt = $conn->prepare("INSERT INTO assets VALUES (?, ?, ?, ?, 0, ?, ?, ?)");

        if ($stmt->execute([$uuid, $owner, $name, $extension, $this->fileSecure, $path, $datetime])) {
            echo "Successfully uploaded!";
        } else {
            echo "Nope";
        }

        $conn = null;
    }
}