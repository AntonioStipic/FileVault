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
}