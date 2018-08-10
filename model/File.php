<?php

class Model_File {

    protected $uuid;
    protected $title;
    protected $extension;
    protected $path;

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
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /* public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    } */

    public function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . " GB";
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . " MB";
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . " KB";
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . " bytes";
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . " byte";
        }
        else
        {
            $bytes = "0 bytes";
        }

        return $bytes;
    }
}