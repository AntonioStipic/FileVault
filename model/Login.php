<?php

class Model_Login extends Lib_Model {
    function __construct() {
        parent::__construct();
    }

    function login($username, $password) {
        echo $username . " - " . $password;

        $user = new Model_User($username);
        $hashedPassword = hash('sha256', $password);

        if ($username == $user->username && $hashedPassword == $user->password) {
            $_SESSION["user"] = $user->uuid;
            header("Location: /home");
        } else {
            echo "Something is wrong!";
        }

    }

}