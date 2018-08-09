<?php

class Model_Register extends Lib_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function register($email, $username, $password)
    {

        $db = new DB_Connection();
        $conn = $db->conn;

        $uuid = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        $hashedPassword = hash("sha256", $password);
        $active = "false";
        $confirmed = "false";

        $stmt = $conn->prepare("INSERT INTO users VALUES ('$uuid', '$username', '$hashedPassword', '$email', '$active', '$confirmed')");

        if ($stmt->execute()) {
            echo "Successfully registered!";
        } else {
            echo "Nope";
        }

        $conn = null;

    }

}