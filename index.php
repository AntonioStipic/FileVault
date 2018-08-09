<?php
session_start();

function __autoload($className) {

    /* $className = explode("_", $className);

    $path1 = strtolower($className[0]);
    $path2 = $className[1];
    echo $path1 . "/" . $path2 . "<br>";
    $path = $path1 . "/" . $path2;

    echo $path;
    #$path = $className[0] . "/" . $className[1];
    require_once $path . ".php"; */

    $files = explode("_", $className);
    $path = strtolower($files[0]) . "/" . $files[1] . ".php";
    require_once $path;
}

$app = new Lib_Bootstrap();