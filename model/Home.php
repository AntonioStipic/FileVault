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
//        $stmt = $conn->prepare("SELECT * FROM assets WHERE owner=? ORDER BY " . $sortBy);

        $stmt = $conn->prepare("SELECT * FROM relations INNER JOIN assets ON relations.file_id=assets.uuid WHERE user_id=? ORDER BY " . $sortBy);
        $stmt->execute([$uuid]);


//        $fileList = $stmt->fetchAll();
//        print_r(json_encode($fileList));
        $files = $stmt->fetchAll();


        for ($i = 0; $i < count($files); $i++) {
            $files[$i]["size"] = filesize($files[$i]["path"]);
        }

//        print_r($files);

        return $files;
    }

    public function searchFiles($phrase, $sortBy) {
        $db = new DB_Connection();
        $conn = $db->conn;
        #echo "<br>";
        $uuid = $_SESSION["user"];
//        $stmt = $conn->prepare("SELECT *, LOCATE(?, title) FROM assets WHERE owner=? ORDER BY " . $sortBy);
        $stmt = $conn->prepare("SELECT * FROM assets WHERE ((LOCATE(?, title) > 0 OR LOCATE(?, extension) > 0) AND owner=?) ORDER BY " . $sortBy);
        $stmt->execute([$phrase, $phrase, $uuid]);


        $files = $stmt->fetchAll();



        for ($i = 0; $i < count($files); $i++) {
            $files[$i]["size"] = filesize($files[$i]["path"]);
        }

        return $files;
    }
}