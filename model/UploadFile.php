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

        $tmpString = substr($this->fileName, 0, strlen($this->fileName) - strlen($extension));
        $name = $conn->prepare($tmpString);
        $datetime = date("Y-m-d H:i:s");


        $stmt = $conn->prepare("INSERT INTO assets VALUES ('$uuid', '$owner', '$name', '$extension', 0, '$this->fileSecure', '$path', '$datetime')");

        if ($stmt->execute()) {
            echo "Successfully uploaded!";
        } else {
            echo "Nope";
        }

        $conn = null;
    }
}