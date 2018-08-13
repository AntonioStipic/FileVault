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

    public function getFiles($sortBy) {
        $db = new DB_Connection();
        $conn = $db->conn;
        #echo "<br>";
        $uuid = $_SESSION["user"];
        $stmt = $conn->prepare("SELECT * FROM assets WHERE owner=? ORDER BY " . $sortBy);
        $stmt->execute([$uuid]);


        $files = $stmt->fetchAll();



        for ($i = 0; $i < count($files); $i++) {
            $files[$i]["size"] = filesize($files[$i]["path"]);
        }

//        print_r($files);

        return $files;
    }
}