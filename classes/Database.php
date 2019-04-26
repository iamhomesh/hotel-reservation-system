<?php
class Database {
    private const DB_HOST = "localhost";
    private const DB_USER = "homesh";
    private const DB_PASS = "homesh";
    private const DB_NAME = "hrs";
    private $conn;


    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . self::DB_HOST. ";dbname=". self::DB_NAME, self::DB_USER, self::DB_PASS);

        }catch(PDOException $pdoe) {
            echo "Error occured in " . $pdoe->getFile(). " at line number". $pdoe->getLine();
        }
    }

    public function getConnection()
    {
        if($this->conn instanceof PDO) {
            return $this->conn;
        }
    }
}