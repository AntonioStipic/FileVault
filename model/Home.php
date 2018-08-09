<?php

class Model_Home extends Lib_Model {
    function __construct() {
        parent::__construct();
    }

    public function Test() {
        echo "test";
    }

    public function getUser() {
        $db = new DB_Connection();
        $conn = $db->conn;

        #echo "<br>";
        $uuid = $_SESSION["user"];
        $stmt = $conn->prepare("SELECT * FROM users WHERE uuid='$uuid'");
        $stmt->execute();

        $user = $stmt->fetch();

        return $user;
    }

    public function getFiles() {
        $db = new DB_Connection();
        $conn = $db->conn;

        #echo "<br>";
        $uuid = $_SESSION["user"];
        $stmt = $conn->prepare("SELECT * FROM assets WHERE owner='$uuid'");
        $stmt->execute();

        $files = $stmt->fetchAll();

        return $files;
    }
}