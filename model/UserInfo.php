<?php

class Model_UserInfo {

    protected $uuid;
    protected $username;

    function __construct($uuid) {
        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE uuid='$uuid'");
        $stmt->execute();

        $user = $stmt->fetch();

        $conn = null;

        $this->uuid = $user["uuid"];
        $this->username = $user["username"];
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}