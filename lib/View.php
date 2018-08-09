<?php

class Lib_View {

    public $data;

    function __construct() {
        #echo "This is the Main View!<br>";
    }

    public function render($name, $data) {
        $this->data = $data;
        require "view/" . $name . ".php";
    }
}