<?php

class Model_User {

    protected $uuid;
    protected $username;
    protected $password;

    function __construct($username) {
        $db = new DB_Connection();
        $conn = $db->conn;

        if (isset($username)) {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username='$username'");
            $stmt->execute();
        } else {
            $uuid = $_SESSION["user"];
            $stmt = $conn->prepare("SELECT * FROM users WHERE uuid='$uuid'");
            $stmt->execute();
        }



        $user = $stmt->fetch();

        $conn = null;

        $this->uuid = $user["uuid"];
        $this->username = $user["username"];
        $this->password = $user["password"];
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function findUser($name) {
        $db = new DB_Connection();
        $conn = $db->conn;

//        $stmt = $conn->prepare("SELECT *, LOCATE(?, title) FROM assets WHERE owner=? ORDER BY " . $sortBy);
        $stmt = $conn->prepare("SELECT uuid, username FROM users WHERE (LOCATE(?, username) > 0) LIMIT 10");
        $stmt->execute([$name]);


        $usernames = $stmt->fetchAll();


        return $usernames;
    }

    /* public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    } */
}