<?php

class Model_File {

    protected $uuid;
    protected $title;
    protected $extension;
    protected $path;
    protected $download;
    protected $size;
    protected $owner;
    protected $uploadTime;

    function __construct($fileId) {
        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("SELECT * FROM assets WHERE uuid='$fileId'");
        $stmt->execute();

        $file = $stmt->fetch();

        $conn = null;

        $this->uuid = $file["uuid"];
        $this->title = $file["title"];
        $this->extension = $file["extension"];
        $this->path = $file["path"];
        $this->download = $file["download"];
        $this->size = $this->formatSizeUnits($file["size"]);
        $this->owner = $file["owner"];
        $this->uploadTime = $file["upload_time"];
    }

    function deleteFile($fileId) {

        $success = false;
        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("DELETE FROM assets WHERE uuid=?");

        if ($stmt->execute([$fileId])) {

           $stmt2 = $conn->prepare("DELETE FROM relations WHERE file_id=?");

           if ($stmt2->execute([$fileId])) {
               $success = true;
           } else {
               $success = false;
           }


        }

        $conn = null;

        return $success;
    }

    function renameFile($fileName) {

        $extension = substr($fileName, strpos($fileName, "."));

        $name = substr($fileName, 0, strlen($fileName) - strlen($extension));

        if ($name == "") {
            $name = $extension;
            $extension = "";
        }


        $success = false;
        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("UPDATE assets SET title=?, extension=?, path=? WHERE uuid=?");

        $origPath = substr($this->path, 0, strlen($this->path) - strlen(strrchr($this->path, "/"))) . "/";

        $newPath = $origPath . $fileName;

        if ($stmt->execute([$name, $extension, $newPath, $this->uuid])) {


            if (rename($this->path, $newPath)) {
                $success = true;
            } else {
                $success = false;
            }
        }

        $conn = null;

        return $success;
    }

    public function createFolder($folderName) {


        $uuid = substr(md5(uniqid(mt_rand(), true)), 0, 8);

        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("INSERT INTO folders VALUES (?, ?, ?, ?)");

        if ($stmt->execute([$uuid, $folderName, "/uploads/" . $_SESSION["user"], $_SESSION["user"]])) {
            $success = true;
        } else {
            $success = false;
        }

        $conn = null;

        return $success;


    }

    public function downloaded() {

        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("UPDATE assets SET download=download + 1 WHERE uuid=?");

        if ($stmt->execute([$this->uuid])) {
            $success = true;
        } else {
            $success = false;
        }

        $conn = null;

        return $success;
    }

    function shareFile($fileId, $usernames) {

        $db = new DB_Connection();
        $conn = $db->conn;

        for ($i = 0; $i < count($usernames); $i++) {
            $tmpUser = new Model_User($usernames[$i]);

            $tmpUserUuid = $tmpUser->uuid;
            $stmtTmp = $conn->prepare("SELECT * FROM relations WHERE (user_id=? AND file_id=?)");
            $stmtTmp->execute([$tmpUserUuid, $fileId]);

            if ($stmtTmp->rowCount() == 0) {
                $stmt = $conn->prepare("INSERT INTO relations VALUES (NULL, ?, ?)");

                try {
                    $stmt->execute([$tmpUserUuid, $fileId]);
                } catch (Exception $e) {
                    echo "Err";
                }
            }
        }

    }

    function sharedTo($fileId) {

    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . " GB";
        }
        else if ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . " MB";
        }
        else if ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . " KB";
        }
        else if ($bytes > 1) {
            $bytes = $bytes . " bytes";
        }
        else if ($bytes == 1) {
            $bytes = $bytes . " byte";
        }
        else {
            $bytes = "0 bytes";
        }

        return $bytes;
    }
}