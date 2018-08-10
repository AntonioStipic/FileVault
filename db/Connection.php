<?php



class DB_Connection {

    function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "L172839417528639a";
        $this->dbname = "FileVault";

        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function prepare($string) {
        return $this->prepare($string);
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
